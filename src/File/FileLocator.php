<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class FileLocator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\File
 */
class FileLocator
{

    /**
     * The auth utility.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     * @param Guard                     $auth
     */
    function __construct(FileRepositoryInterface $files, FolderRepositoryInterface $folders, Guard $auth)
    {
        $this->auth    = $auth;
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Locate a file by disk and path.
     *
     * @param $folder
     * @param $path
     * @return FileInterface|null
     */
    public function locate($folder, $name)
    {
        $folder = $this->folders->findBySlug($folder);

        if (!$file = $this->files->findByNameAndFolder($name, $folder)) {
            return null;
        }

        $disk  = $file->getDisk();
        $roles = $disk->getAllowedRoles();

        /**
         * No role restriction means
         * it's public - go for it!
         */
        if ($roles->isEmpty()) {
            return $file;
        }

        /**
         * If we have a role restriction and
         * no user then we can not proceed.
         *
         * @var UserInterface $user
         */
        if (!$user = $this->auth->user()) {
            return null;
        }

        /**
         * If the user is an admin or has any
         * of the allowed roles then we're good.
         */
        if ($user->isAdmin() || $user->hasAnyRole($roles)) {
            return $file;
        }

        return null;
    }
}
