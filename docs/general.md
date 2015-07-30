# Files Field Type

- [Introduction](#introduction)
- [Disks](#disks)
    - [Obtaining Disk Instances](#obtaining-disk-instances)
    - [Custom Storage Adapters](#custom-storage-adapters)


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

You may access a particular disk using the disk method on Laravel's Storage facade. Of course, you may continue to chain methods to execute methods on the disk:

    $disk = Storage::disk('my_s3');
    
    $contents = Storage::disk('public_uploads')->get('file.jpg')

We can also access our disks using Flysystem's `League\Flysystem\MountManager` instance:

    $contents = $manager->read('my_s3://some/file.txt');
    
    $manager->write('public_uploads://put/it/here.txt', $contents);

Refer to the documentation for [Laravel's filesystem and cloud storage](http://laravel.com/docs/5.1/filesystem) and the [Flysystem mount manager](http://flysystem.thephpleague.com/mount-manager/) to learn more.

<a name="custom-storage-adapters"></a>
### Custom Storage Adapters

**Provides:** `anomaly.module.files::adapter.*`

The Files module supports integration for storage "drivers" using Extensions. While many storage providers are available you may wish to create your own.

In order to create a custom storage adapter to use with a disk you will need to build an extension which extends the `\Anomaly\FilesModule\Adapter\AdapterExtension` and provides an instance of `Anomaly\FilesModule\Adapter\Contract\DiskLoaderInterface` through it's `newLoader()` method. By default your `CustomAdapterExtension` will be transformed to `CustomAdapterLoader`.

The disk loader is responsible for extending Laravel and Flysystem with an instance of `Anomaly\FilesModule\Adapter\AdapterFilesystem`.

For more information on [extending Laravel's filesystem](http://laravel.com/docs/5.1/filesystem#custom-filesystems) and [mounting Flysystem filesystems](http://flysystem.thephpleague.com/mount-manager/) see the documentation.

**NOTE:** Any `Filesystem` class reference you see in Laravel or Flysystem documentation should be `Anomaly\FilesModule\Adapter\AdapterFilesystem` when using the Files module.

For an example of a custom adapter extension check out the [Local Storage Adapter](https://github.com/anomalylabs/local_storage_adapter-extension) and it's [loader](https://github.com/anomalylabs/local_storage_adapter-extension/blob/1.0/master/src/LocalStorageAdapterLoader.php).
