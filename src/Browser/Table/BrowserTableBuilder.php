<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface;
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
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'test' => [
            'filter'      => 'input',
            'placeholder' => 'Search...'
        ]
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => false,
            'value'   => 'test'
        ],
        [
            'heading' => 'Name',
            'value'   => 'name'
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        [
            'button' => 'view',
            'href'   => 'admin/files/browser/{entry.slug}'
        ]
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'module::js/dropzone.js',
            'module::js/uploader.js'
        ],
        'styles.css' => [
            'module::less/dropzone.less',
            'module::less/browser.less',
            'module::less/uploader.less'
        ]
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'wrapper_view' => 'module::admin/browser/wrapper'
    ];

    /**
     * Fire when ready.
     *
     * @param DriveRepositoryInterface  $drives
     * @param FolderRepositoryInterface $folders
     */
    public function onReady(DriveRepositoryInterface $drives, FolderRepositoryInterface $folders)
    {
        $this->setOption('drive', $drive = $drives->findBySlug($this->getOption('drive')));
        $this->setOption('folder', $folder = $folders->findByDriveAndPath($drive, $this->getOption('path')));

        $this->tables->get('folders')->on(
            'querying',
            function (Builder $query) use ($drive, $folder) {
                if ($folder) {
                    $query->where('parent_id', $folder->getId());
                } else {
                    $query->where('drive_id', $drive->getId())->whereIn('parent_id', [null, '']);
                }
            }
        );

        $this->tables->get('files')->on(
            'querying',
            function (Builder $query) use ($drive, $folder) {
                if ($folder) {
                    $query->where('folder_id', $folder->getId());
                } else {
                    $query->where('folder_id', 0);
                }
            }
        );
    }
}
