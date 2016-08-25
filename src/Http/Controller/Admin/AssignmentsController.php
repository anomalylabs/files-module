<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class AssignmentsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentsController extends AdminController
{

    /**
     * @param  AssignmentTableBuilder                     $table
     * @param  StreamRepositoryInterface                  $streams
     * @param  DiskRepositoryInterface                    $disks
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        AssignmentTableBuilder $table,
        StreamRepositoryInterface $streams,
        DiskRepositoryInterface $disks,
        $id
    ) {
        /* @var DiskInterface $disk */
        $disk = $disks->find($id);

        return $table->setStream($streams->findBySlugAndNamespace($disk->getSlug(), 'files'))->render();
    }

    /**
     * Return the modal for choosing a field to assign.
     *
     * @param  FieldRepositoryInterface  $fields
     * @param  StreamRepositoryInterface $streams
     * @param  DiskRepositoryInterface   $disks
     * @param                            $id
     * @return \Illuminate\View\View
     */
    public function choose(
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        DiskRepositoryInterface $disks,
        $id
    ) {
        /* @var DiskInterface $disk */
        /* @var StreamInterface $group */
        $disk   = $disks->find($id);
        $stream = $streams->findBySlugAndNamespace($disk->getSlug(), 'files');

        return view(
            'module::ajax/choose_field',
            [
                'fields' => $fields->findAllByNamespace('files')->notAssignedTo($stream)->unlocked(),
                'id'     => $id,
            ]
        );
    }

    /**
     * Create a new field assignment.
     *
     * @param  AssignmentFormBuilder                      $builder
     * @param  DiskRepositoryInterface                    $disks
     * @param  FieldRepositoryInterface                   $fields
     * @param  StreamRepositoryInterface                  $streams
     * @param                                             $id
     * @param                                             $field
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        AssignmentFormBuilder $builder,
        DiskRepositoryInterface $disks,
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        $id,
        $field
    ) {
        /* @var DiskInterface $disk */
        $disk   = $disks->find($id);
        $stream = $streams->findBySlugAndNamespace($disk->getSlug(), 'files');

        return $builder
            ->setOption('redirect', 'admin/files/disks/assignments/' . $id)
            ->setField($fields->find($field))
            ->setStream($stream)
            ->render();
    }
}
