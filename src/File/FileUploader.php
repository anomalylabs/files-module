<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Factory;
use League\Flysystem\MountManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
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
     * @var MountManager
     */
    protected $manager;

    /**
     * The validation factory.
     *
     * @var Factory
     */
    protected $validator;

    /**
     * Create a new FileUploader instance.
     *
     * @param Factory                 $validator
     * @param MountManager            $manager
     * @param Repository              $config
     * @param FileRepositoryInterface $files
     */
    public function __construct(
        Factory $validator,
        MountManager $manager,
        Repository $config,
        FileRepositoryInterface $files
    ) {
        $this->files     = $files;
        $this->config    = $config;
        $this->manager   = $manager;
        $this->validator = $validator;
    }

    /**
     * Upload a file.
     *
     * @param UploadedFile    $file
     * @param FolderInterface $folder
     * @return bool|FileInterface
     */
    public function upload(UploadedFile $file, FolderInterface $folder)
    {
        $rules = 'required';

        if ($allowed = $folder->getAllowedTypes()) {
            $rules .= '|mimes:' . implode(',', $allowed);
        }

        $validation = $this->validator->make(['file' => $file], ['file' => $rules]);

        if (!$validation->passes()) {
            throw new \Exception($validation->messages()->first(), 1);
        }

        $disk = $folder->getDisk();

        /* @var FileInterface|EloquentModel $entry */
        $entry = $this->manager->put(
            $disk->getSlug() . '://' . $folder->getSlug() . '/' . $file->getClientOriginalName(),
            file_get_contents($file->getRealPath())
        );

        if (in_array($entry->getExtension(), $this->config->get('anomaly.module.files::mimes.types.image'))) {

            $size = getimagesize($file->getRealPath());

            $this->files->save($entry->setAttribute('width', $size[0])->setAttribute('height', $size[1]));
        }

        return $entry;
    }
}
