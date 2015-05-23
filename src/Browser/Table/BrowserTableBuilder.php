<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Multiple\MultipleTableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BrowserTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table
 */
class BrowserTableBuilder extends MultipleTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => false,
            'value'   => 'entry.icon'
        ],
        [
            'heading' => 'Name',
            'value'   => 'entry.view_link'
        ]
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'limit' => 999
    ];

    /**
     * Fire when ready.
     *
     * @param DiskRepositoryInterface   $disks
     * @param FolderRepositoryInterface $folders
     */
    public function onReady(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        $this->setOption('disk', $disk = $disks->findBySlug($this->getOption('disk')));
        $this->setOption('folder', $folder = $folders->findByDiskAndPath($disk, $this->getOption('path')));

        $this->tables->get('folders')->on(
            'querying',
            function (Builder $query) use ($disk, $folder) {
                if ($folder) {
                    $query->where('parent_id', $folder->getId());
                } else {
                    $query->where('disk_id', $disk->getId())->whereIn('parent_id', [null, '']);
                }
            }
        );

        $this->tables->get('files')->on(
            'querying',
            function (Builder $query) use ($disk, $folder) {
                if ($folder) {
                    $query->where('folder_id', $folder->getId());
                } else {
                    $query->where('folder_id', null)->where('disk_id', $disk->getId());
                }
            }
        );
    }
}
