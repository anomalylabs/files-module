## Integration[](#integration)

The Files module integrates tightly with Laravel's `filesystem` and the [Flysystem package](https://flysystem.thephpleague.com/) from [The PHP League](https://thephpleague.com/).


### Laravel Filesystem[](#integration/laravel-filesystem)

This section will go over how the Files module integrates with [Laravel's filesystem](https://laravel.com/docs/5.3/filesystem).


#### Storage Disks[](#integration/laravel-filesystem/storage-disks)

Disks in the Files module are automatically configured as [Laravel storage disks](https://laravel.com/docs/5.3/filesystem#obtaining-disk-instances).

You may use the disk method on the Storage facade to work with files on a particular disk using the disk's `slug`:

    Storage::disk('local')->put('avatars/me.jpg', $fileContents);

<div class="alert alert-info">**Note:** You don't HAVE to use disks from the Files module. If the disk does not exist in the Files module Laravel's filesystem will work just as it would natively.</div>


#### Retrieving Files[](#integration/laravel-filesystem/retrieving-files)

Accessing files on a disk from the Files module works just the same as native behavior. Note, however, that you must include a folder reference since all files in the Files module belong to a folder:

    $contents = Storage::disk('local')->get('example_folder/file.jpg');

    $exists = Storage::disk('local')->exists('example_folder/file.jpg');


#### Storing Files[](#integration/laravel-filesystem/storing-files)

When you store files on a disk from the Files module the file entry will be automatically synced into the database:

    Storage::disk('local')->put('example_folder/file.jpg', $contents);

    Storage::disk('local')->put('example_folder/file.jpg', $resource);


#### Directories[](#integration/laravel-filesystem/directories)

Folders in the Files module act just like directories. Being that a file in the Files module **requires** a folder you must always define the folder path if using the Laravel filesystem with files from the Files module.

    foreach ($file in Storage::disk('local')->files('example_folder')) {
        echo $file->name;
    }


##### Creating Directories[](#integration/laravel-filesystem/directories/creating-directories)

When you create a directory in Laravel on a disk from the Files module the resulting folder will be added automatically to the Files module:

    Storage::makeDirectory('My Folder'); // Makes a folder like my_folder named "My Folder"

<div class="alert alert-danger">**Heads Up:** Folders are always referred to by their slugs in the Files module. Even though they have a name field.</div>


##### Deleting Directories[](#integration/laravel-filesystem/directories/deleting-directories)

When you delete a directory in Laravel on a disk from the Files module the resulting folder and files will be deleted automatically in the Files module:

    Storage::deleteDirectory('my_folder');


### Flysystem Package[](#integration/flysystem-package)

This section will go over how the Files module integrates with [The PHP League's filesystem](https://flysystem.thephpleague.com/).


#### Mount Manager[](#integration/flysystem-package/mount-manager)

Disks created in the Files module are automatically configured as [mounted file systems](https://flysystem.thephpleague.com/mount-manager/). You can access the mounted file system using the disk's `slug`:

    $contents = $manager->read('local://example_folder/file.jpg');


#### Retrieving Files[](#integration/flysystem-package/retrieving-files)

Retrieving files through the mount manager works just the same. Simply use your disk slug and folder:

    $contents = $manager->read('local://example_folder/file.jpg');

Check if a file exists:

    $exists = $manager->has('local://example_folder/file.jpg');


#### Storing Files[](#integration/flysystem-package/storing-files)

Writing files to a disk from the Files module works just the same using the mount manager:

    $manager->write('local://example_folder/file.text', 'contents');

Updating files:

    $manager->update('local://example_folder/file.text', 'new contents');


#### Directories[](#integration/flysystem-package/directories)

Working with directories on a disk from the Files module works just the same using the mount manager too:

    foreach ($file in $manager->listContents('local://example_folder')) {
        echo $file->name;
    }


##### Creating Directories[](#integration/flysystem-package/directories/creating-directories)

When you create a directory with Flysystem on a disk from the Files module the resulting folder will be added automatically to the Files module:

    $manager->createDir('My Folder'); // Makes a folder like my_folder named "My Folder"

<div class="alert alert-danger">**Heads Up:** Folders are always referred to by their slugs in the Files module. Even though they have a name field.</div>


##### Deleting Directories[](#integration/flysystem-package/directories/deleting-directories)

When you delete a directory using the Flysystem from a disk from the Files module the resulting folder and files will be deleted automatically in the Files module:

    $manager-> deleteDir('my_folder');
