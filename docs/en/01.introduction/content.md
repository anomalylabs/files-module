## Introduction[](#introduction)

The Files module is a powerful, easy-to-use, and driver-based asset management system.


### Features[](#introduction/features)

The Files module comes with everything you need to manage your assets with any storage provider.

*   Folders
*   Storage Disks
*   File Management
*   Simple Structure
*   File Synchronization
*   Extension-based Storage
*   Folder MIME Restrictions
*   File Reading/Downloading/Streaming
*   Integration with `Image` service.
*   Integration with Laravel Filesystem.
*   Integration with Flysystem package.
*   Multiple file/drag 'n drop uploading.
*   Integration with File/Files field types.


### Installation[](#introduction/installation)

You can install the Files module with the `addon:install` command:

    php artisan addon:install anomaly.module.files

<div class="alert alert-warning">**Notice:** The Files module comes installed with PyroCMS out of the box.</div>


### Configuration[](#introduction/configuration)

You can override Files module configuration by publishing the addon and modifying the resulting configuration file:

    php artisan addon:publish anomaly.module.files

The addon will be published to `/resources/{application}/addons/anomaly/files-module`.


#### MIME Types[](#introduction/configuration/mime-types)

The `anomaly.module.files::mimes.types` value tells the files module what `type` of file is associated with a given file extension.

If your project deals with strange file types feel free to add them here under the appropriate type.

<div class="alert alert-success">**Contribute:** If you think an extension should be included in configuration please [submit a pull request](https://github.com/anomalylabs/files-module)!</div>
