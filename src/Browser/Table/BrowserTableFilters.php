<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
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
                'name' => [
                    'filter'      => 'input',
                    'placeholder' => 'Name',
                    'query'       => function (Builder $query, FilterInterface $filter) {
                        return $query->where('name', 'LIKE', '%' . $filter->getValue() . '%');
                    }
                ]
            ]
        );
    }
}
