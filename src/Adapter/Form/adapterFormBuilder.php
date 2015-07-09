<?php namespace Anomaly\FilesModule\Adapter\Form;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Routing\Redirector;
use League\Flysystem\MountManager;

/**
 * Class AdapterFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Form
 */
class AdapterFormBuilder extends MultipleFormBuilder
{

    /**
     * Fired just after
     * saving the form entry.
     *
     * This is basically a validator
     * but I am putting it here because
     * it's far easier to test being that
     * the disk is being loaded already.
     *
     * @param MountManager $manager
     * @param MessageBag   $messages
     * @param Redirector   $redirector
     */
    public function onSaved(MountManager $manager, MessageBag $messages, Redirector $redirector)
    {
        /* @var DiskFormBuilder $builder */
        $builder = $this->forms->get('disk');

        /* @var DiskInterface $entry */
        $entry = $builder->getFormEntry();

        app()->call('Anomaly\FilesModule\Disk\Listener\RegisterDisks@handle');

        try {
            $manager->has($entry->path('test.me'));
        } catch (\Exception $e) {

            $messages->error($e->getMessage());

            $this->setFormResponse($redirector->to('admin/files/disks/edit/' . $entry->getId()));
        }
    }

    /**
     * Fired just before saving the configuration.
     */
    public function onSavingConfiguration()
    {
        /* @var DiskFormBuilder $disk */
        $disk = $this->forms->get('disk');

        /* @var DiskInterface $entry */
        $entry = $disk->getFormEntry();

        /* @var ConfigurationFormBuilder $configuration */
        $configuration = $this->forms->get('configuration');

        if (!$configuration->getScope()) {
            $configuration->setScope($entry->getSlug());
        }
    }
}
