<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Multiple\MultipleTableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BrowserTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser
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
            'column' => 'Anomaly\FilesModule\Browser\Table\Column\PreviewColumn'
        ],
        [
            'heading' => 'anomaly.module.files::field.name.name',
            'column'  => 'Anomaly\FilesModule\Browser\Table\Column\NameColumn'
        ],
        [
            'heading' => 'anomaly.module.files::field.size.name',
            'column'  => 'Anomaly\FilesModule\Browser\Table\Column\SizeColumn'
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
        'attributes' => [
            'id' => 'browser'
        ]
    ];

    /**
     * @return array|string
     */
    public function getFilters()
    {
        if ($this->filters) {
            return $this->filters;
        }

        return [
            'name' => [
                'filter'      => 'input',
                'placeholder' => 'Name',
                'query'       => function (Builder $query, FilterInterface $filter) {
                    return $query->where('name', 'LIKE', '%' . $filter->getValue() . '%');
                }
            ]
        ];
    }
}
