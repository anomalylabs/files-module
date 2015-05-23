<?php namespace Anomaly\FilesModule\Disk\Form;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class DiskConfigurationFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Form
 */
class DiskConfigurationFormBuilder extends MultipleFormBuilder
{

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
