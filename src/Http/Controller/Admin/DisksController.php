<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\Form\DiskConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Form\DiskFormBuilder;
use Anomaly\FilesModule\Disk\Grid\DiskGridBuilder;
use Anomaly\FilesModule\Disk\Table\DiskTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class DisksController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\DisksModule\Http\Controller\Admin
 */
class DisksController extends AdminController
{

    /**
     * Return an index of existing disks.
     *
     * @param DiskTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(DiskTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a grid index of of existing disks.
     *
     * @param DiskGridBuilder $grid
     * @return \Illuminate\Http\Response
     */
    public function choose(DiskGridBuilder $grid)
    {
        app('filesystem')->disk('test_s3')->write('test/balls/test.txt', 'Test!');
        return $grid->render();
    }

    /**
     * Return a form to create a new disk
     * and it's configuration.
     *
     * @param DiskFormBuilder     $form
     * @param ExtensionCollection $adapters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        DiskFormBuilder $disk,
        ExtensionCollection $adapters,
        ConfigurationFormBuilder $configuration,
        DiskConfigurationFormBuilder $form
    ) {
        $adapter = $adapter = $adapters->get($_GET['adapter']);

        $form->addForm('disk', $disk->setAdapter($adapter));
        $form->addForm('configuration', $configuration->setEntry($adapter->getNamespace()));

        return $form->render();
    }

    /**
     * Return a form to edit an existing disk
     * and it's configuration.
     *
     * @param DiskFormBuilder              $disk
     * @param ConfigurationFormBuilder     $configuration
     * @param DiskConfigurationFormBuilder $form
     * @param DiskRepositoryInterface      $disks
     * @param                              $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        DiskFormBuilder $disk,
        ConfigurationFormBuilder $configuration,
        DiskConfigurationFormBuilder $form,
        DiskRepositoryInterface $disks,
        $id
    ) {
        $entry = $disks->find($id);

        $adapter = $entry->getAdapter();

        $form->addForm('disk', $disk->setEntry($id)->setAdapter($adapter));
        $form->addForm(
            'configuration',
            $configuration->setEntry($adapter->getNamespace())->setScope($entry->getSlug())
        );

        return $form->render();
    }
}
