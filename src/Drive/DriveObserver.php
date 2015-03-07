<?php namespace Anomaly\FilesModule\Drive;

use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class DriveObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive
 */
class DriveObserver extends EntryObserver
{

    /**
     * Run before creating a record.
     *
     * @param EloquentModel $model
     */
    public function creating(EloquentModel $model)
    {
        $model->adapter = app('request')->segment(5);

        parent::creating($model);
    }
}
