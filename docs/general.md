# Files Field Type

- [Introduction](#introduction)
- [Disks](#disks)
    - [Obtaining Disk Instances](#obtaining-disk-instances)


<a name="introduction"></a>
## Introduction

`anomaly.module.files`

The Files module is a powerful multi-provider file manager that helps you easily manage files across file systems and providers. It is built over the [Flysystem](http://flysystem.thephpleague.com/) package and integrates seamlessly into Laravel's filesystem too.

Simply use the `MountManager` from Flysystem or `Filesystem` from Laravel natively and everything else is kept in sync for you. 


<a name="disks"></a>
## Disks

Disks represent filesystems you have available to work with and use the `StorageAdapterExtension` described further below. 

<a name="obtaining-disk-instances"></a>
### Obtaining Disk Instances

After creating a disk it is automatically loaded into Laravel's collection of Storage disks and Flysystem's mount manager.

Laravel's Storage facade may be used to interact with any of the disks created in the Files module. You may access a particular disk using the disk method on the Storage facade. Of course, you may continue to chain methods to execute methods on the disk:

    $disk = Storage::disk('my_s3');
    
    $contents = Storage::disk('public_uploads')->get('file.jpg')

We can also access our disks using Flysystem's `League\Flysystem\MountManager` instance.

    $contents = $manager->read('my_s3://some/file.txt');
    
    $manager->write('public_uploads://put/it/here.txt', $contents);

Refer to the documentation for [Laravel's filesystem and cloud storage](http://laravel.com/docs/5.1/filesystem) and the [Flysystem mount manager](http://flysystem.thephpleague.com/mount-manager/) to learn more.