<?php namespace Anomaly\FilesModule\Drive\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class DriveTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Ui\Table
 */
class DriveTableBuilder extends TableBuilder
{

    /**
     * The table model.
     *
     * @var string
     */
    protected $model = 'Anomaly\FilesModule\Drive\DriveModel';

    /**
     * The table columns.
     *
     * @var string
     */
    protected $columns = 'Anomaly\FilesModule\Drive\Ui\Table\Handler\ColumnsHandler@handle';

}
