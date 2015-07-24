<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BrowserTableFilters
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table
 */
class BrowserTableFilters
{

    /**
     * Handle the filters.
     *
     * @param BrowserTableBuilder $builder
     */
    public function handle(BrowserTableBuilder $builder)
    {
        $builder->setFilters(
            [
                'name'      => [
                    'filter'      => 'input',
                    'placeholder' => 'Name',
                    'query'       => function (Builder $query, FilterInterface $filter) {
                        $query->where('name', 'LIKE', '%' . $filter->getValue() . '%');
                    }
                ],
                'keywords'  => [
                    'filter'      => 'input',
                    'placeholder' => 'Keywords',
                    'query'       => function (Builder $query, FilterInterface $filter, TableBuilder $builder) {
                        if ($builder instanceof FileTableBuilder) {
                            $query->where('keywords', 'LIKE', '%"' . $filter->getValue() . '"%');
                        } else {
                            $query->where('id', 0);
                        }
                    }
                ],
                'mime_type' => [
                    'filter'      => 'input',
                    'placeholder' => 'Mime Type',
                    'query'       => function (Builder $query, FilterInterface $filter, TableBuilder $builder) {
                        if ($builder instanceof FileTableBuilder) {
                            $query->where('mime_type', 'LIKE', '%' . $filter->getValue() . '%');
                        } else {
                            $query->where('id', 0);
                        }
                    }
                ]
            ]
        );
    }
}
