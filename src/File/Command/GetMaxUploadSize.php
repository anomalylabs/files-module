<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;

/**
 * Class GetMaxUploadSize
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetMaxUploadSize
{
    /**
     * Handle the command.
     *
     * @param  SettingRepositoryInterface $settings
     * @return int
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        $setting = $settings->value('anomaly.module.files::max_upload_size', 100);

        $system = dispatch_sync(new GetSystemMaxUploadSize());

        return $system < $setting ? $system : $setting;
    }
}
