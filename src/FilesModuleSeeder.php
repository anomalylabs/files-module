<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\Seeder\DiskSeeder;
use Anomaly\FilesModule\Seeder\FolderSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class FilesModuleSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule
 */
class FilesModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(DiskSeeder::class);
        $this->call(FolderSeeder::class);
    }
}
