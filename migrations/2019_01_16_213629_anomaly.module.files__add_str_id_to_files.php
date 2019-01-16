<?php

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class AnomalyModuleFilesAddStrIdToFiles
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleFilesAddStrIdToFiles extends Migration
{

    /**
     * Don't delete the stream.
     * Used for reference only.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id' => 'anomaly.field_type.text',
    ];

    /**
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'files',
    ];

    /**
     * @var array
     */
    protected $assignments = [
        'str_id' => [
            'required' => true,
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up()
    {
        /* @var FileRepositoryInterface $files */
        $files = app(FileRepositoryInterface::class);

        /* @var FileInterface|EloquentModel $file */
        foreach ($files->allWithTrashed() as $file) {
            if (!$files->save($file->setRawAttribute('str_id', str_random(24)))) {
                throw new Exception('Please run: php artisan files:clean --force');
            }
        }

        $field      = $this->fields()->findBySlugAndNamespace('str_id', 'files');
        $stream     = $this->streams()->findBySlugAndNamespace('files', 'files');
        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('unique', true));
    }

}
