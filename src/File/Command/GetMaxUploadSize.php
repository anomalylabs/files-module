<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetMaxUploadSize
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\File\Command
 */
class GetMaxUploadSize implements SelfHandling
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @return int
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        $setting = $settings->value('anomaly.module.files::max_upload_size', 100);

        $system = $this->dispatch(new GetSystemMaxUploadSize());

        return $system < $setting ? $system : $setting;
    }
}
