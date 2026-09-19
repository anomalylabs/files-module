<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Validation\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileUploader
{

    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The mount manager.
     *
     * @var FilesystemManager
     */
    protected $manager;

    /**
     * The file rotator.
     *
     * @var FileRotator
     */
    protected $rotator;

    /**
     * The validation factory.
     *
     * @var Factory
     */
    protected $validator;

    /**
     * Create a new FileUploader instance.
     *
     * @param Factory $validator
     * @param FileRotator $rotator
     * @param FilesystemManager $manager
     * @param FileRepositoryInterface $files
     */
    public function __construct(
        Factory $validator,
        FileRotator $rotator,
        FilesystemManager $manager,
        FileRepositoryInterface $files
    )
    {
        $this->files = $files;
        $this->manager = $manager;
        $this->rotator = $rotator;
        $this->validator = $validator;
    }

    /**
     * Upload a file.
     *
     * @param UploadedFile $file
     * @param FolderInterface $folder
     * @return bool|FileInterface
     */
    public function upload(UploadedFile $file, FolderInterface $folder)
    {
        $allowed = $this->allowedTypes($folder);

        if (!$allowed) {
            throw new \Exception('No allowed file types remain for this folder.');
        }

        /**
         * The name the file will be stored under decides the extension, not
         * the one the client claims, and the comparison is lowercase.
         */
        $extension = strtolower(
            pathinfo(FileSanitizer::clean($file->getClientOriginalName()), PATHINFO_EXTENSION)
        );

        if (!in_array($extension, $allowed)) {
            throw new \Exception('The uploaded file type is not allowed.');
        }

        /**
         * Run validation and check that it passed. The mimes rule reads the
         * file's contents, so the extension it is named with and the one its
         * contents imply must both be allowed before it is written.
         */
        $validation = $this->validator->make(
            ['file' => $file],
            ['file' => 'required|mimes:' . implode(',', $allowed)]
        );

        if (!$validation->passes()) {
            throw new \Exception($validation->messages()->first(), 1);
        }

        $disk = $folder->getDisk();

        /**
         * Rotate filename to unique-ify it.
         */
        $file = $this->rotator->rotate($file);

        /**
         * Get file extension
         */
        $type = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

        /**
         * Define path
         */
        $path = $folder->getSlug() . '/' . FileSanitizer::clean($file->getClientOriginalName());

        /**
         * Write the file to the filesystem.
         */
        $entry = $this->manager->disk($disk->getSlug())->write($path, file_get_contents($file->getRealPath()));

        /**
         * Generate and store extra details about image files.
         */
        if (in_array($type, config('anomaly.module.files::mimes.types.image'))) {

            $dimensions = getimagesize($file->getRealPath());

            $this->files->save(
                $entry
                    ->setAttribute('size', filesize($file->getRealPath()))
                    ->setAttribute('width', isset($dimensions[0]) ? $dimensions[0] : null)
                    ->setAttribute('height', isset($dimensions[1]) ? $dimensions[1] : null)
                    ->setAttribute('mime_type', $file->getMimetype())
            );
        }

        return $entry;
    }

    /**
     * Return the types the folder may accept.
     *
     * @param  FolderInterface $folder
     * @return array
     */
    protected function allowedTypes(FolderInterface $folder)
    {
        $allowed = array_map('strtolower', (array)config('anomaly.module.files::mimes.allowed', []));

        if ($types = $folder->getAllowedTypes()) {
            $allowed = array_intersect($allowed, array_map('strtolower', $types));
        }

        return array_values(array_unique($allowed));
    }
}
