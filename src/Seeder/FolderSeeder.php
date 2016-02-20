<?php namespace Anomaly\FilesModule\Seeder;

use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class FolderSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Seeder
 */
class FolderSeeder extends Seeder
{

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FolderSeeder instance.
     *
     * @param $folders
     */
    public function __construct(FolderRepositoryInterface $folders)
    {
        $this->folders = $folders;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->folders->truncate();

        $this->folders->create(
            [
                'en'            => [
                    'name'        => 'Images',
                    'description' => 'A folder for images.'
                ],
                'slug'          => 'images',
                'disk'          => 1,
                'allowed_types' => [
                    'png',
                    'jpeg',
                    'jpg'
                ]
            ]
        );

        $this->folders->create(
            [
                'en'            => [
                    'name'        => 'Documents',
                    'description' => 'A folder for documents.'
                ],
                'slug'          => 'documents',
                'disk'          => 1,
                'allowed_types' => [
                    'pdf',
                    'docx'
                ]
            ]
        );
    }
}
