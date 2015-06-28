<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Browser\Command\AddDiskBreadcrumb;
use Anomaly\FilesModule\Browser\Command\AddFolderBreadcrumbs;
use Anomaly\FilesModule\Browser\Table\BrowserTableBuilder;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\Table\DiskTableBuilder;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Folder\Table\FolderTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Routing\Redirector;

/**
 * Class BrowserController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class BrowserController extends AdminController
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new BrowserController instance.
     *
     * @param DiskRepositoryInterface   $disks
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    function __construct(
        DiskRepositoryInterface $disks,
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders
    ) {
        parent::__construct();

        $this->disks   = $disks;
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Return the browser index.
     *
     * @param BrowserTableBuilder $browser
     * @param DiskTableBuilder    $disks
     * @param FolderTableBuilder  $folders
     * @param FileTableBuilder    $files
     * @param null                $disk
     * @param null                $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        BrowserTableBuilder $browser,
        DiskTableBuilder $disks,
        FolderTableBuilder $folders,
        FileTableBuilder $files,
        $disk = null,
        $path = null
    ) {

        /**
         * If a disk is selected then don't include them
         * but add them to the file and folder tables.
         */
        if ($disk && $disk = $this->disks->findBySlug($disk)) {

            $this->dispatch(new AddDiskBreadcrumb($disk));

            $browser->addTable('folders', $folders->setDisk($disk));
            $browser->addTable('files', $files->setDisk($disk));
        } else {
            $browser->addTable('disks', $disks);
        }

        /**
         * If we have a path available then find the folder
         * and add it to the folder and file tables.
         */
        if ($disk && $path && $folder = $this->folders->findByPath($path, $disk)) {

            $this->dispatch(new AddFolderBreadcrumbs($folder));

            $files->setFolder($folder);
            $folders->setParent($folder);
        }

        return $browser->render();
    }

    /**
     * Return the details of a file or folder.
     *
     * @param $disk
     * @param $path
     * @return string
     */
    public function view($disk, $path)
    {
        $disk = $this->disks->findBySlug($disk);

        $folder = $this->folders->findByPath(dirname($path), $disk);
        $file   = $this->files->findByName(basename($path), $folder, $disk);

        if (!$disk || (!$folder && !$file)) {
            abort(404);
        }

        if ($file) {
            return json_encode($file);
        }

        if ($folder) {
            return json_encode($folder);
        }
    }
}
