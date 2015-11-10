<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\FilesModule\Container\Contract\ContainerInterface;
use Anomaly\FilesModule\Container\Contract\ContainerRepositoryInterface;

class FileTableViews
{

    public function handle(FileTableBuilder $builder, ContainerRepositoryInterface $containers)
    {
        $builder->setViews([]);

        $builder->setViews(
            array_map(
                function (ContainerInterface $container) {
                    return [
                        'text'      => $container->getName(),
                        'slug'      => $container->getSlug(),
                        'callbacks' => [
                            'querying' => [
                                function () {
                                    //die('Test');
                                }
                            ]
                        ]
                    ];
                },
                $containers->all()->all()
            )
        );
    }
}
