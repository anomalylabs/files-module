## Usage[](#usage)

This section will show you how to use the addon via API and in the view layer.


### Files[](#usage/files)

Files are stream entries representing a physical file somewhere. Files must be unique per folder just as the physical file would have to be.


#### File Fields[](#usage/files/file-fields)

Below is a list of `fields` in the `files` stream. Fields are accessed as attributes:

    $file->name;

Same goes for decorated instances in Twig:

    {{ file.name }}

###### Fields

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Type</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

name

</td>

<td>

text

</td>

<td>

The name of the file.

</td>

</tr>

<tr>

<td>

disk

</td>

<td>

relationship

</td>

<td>

The disk the file is on.

</td>

</tr>

<tr>

<td>

folder

</td>

<td>

relationship

</td>

<td>

The folder the file is in.

</td>

</tr>

<tr>

<td>

extension

</td>

<td>

text

</td>

<td>

The file extension only.

</td>

</tr>

<tr>

<td>

size

</td>

<td>

integer

</td>

<td>

The size of the file in bytes.

</td>

</tr>

<tr>

<td>

mime_type

</td>

<td>

text

</td>

<td>

The MIME type of the file.

</td>

</tr>

<tr>

<td>

entry

</td>

<td>

polymorphic

</td>

<td>

The related entry with custom attributes.

</td>

</tr>

<tr>

<td>

keywords

</td>

<td>

tags

</td>

<td>

An array of organizational keywords.

</td>

</tr>

<tr>

<td>

height

</td>

<td>

integer

</td>

<td>

The height of the image file in pixels.

</td>

</tr>

<tr>

<td>

width

</td>

<td>

integer

</td>

<td>

The width of the image file in pixels.

</td>

</tr>

</tbody>

</table>


##### Custom File Fields[](#usage/files/file-fields/custom-file-fields)

Custom file fields associated with `folders` through the `control panel` can be accessed via the related `entry`. The `entry` is part of the `type pattern`.

    $file->entry->custom_field;

When working with custom fields it is a good idea to verify the existence of the related entry since it only exists after editing the file through a form:

    if ($entry = $file->getEntry()) {
        $entry->custom_field;
    }

The file presenter allows direct access in Twig:

    {{ file.custom_field }}


#### File Interface[](#usage/files/file-interface)

This section will go over the `\Anomaly\FilesModule\File\Contract\FileInterface` class.


##### FileInterface::type()[](#usage/files/file-interface/fileinterface-type)

The `type` method returns the file type based on the addon's configured MIMEs or `null` if not defined.

###### Returns: `string` or `null`

###### Example

    if ($file->type() == 'audio') {
        echo "I love this song!";
    }

###### Twig

    {% if file.type() == 'audio' %}
        I love this song!
    {% endif %]


##### FileInterface::path()[](#usage/files/file-interface/fileinterface-path)

The `path` method returns the `internal` file path like `folder/filename.ext`.

###### Returns: `string`

###### Example

    $file->path();

###### Twig

    {{ file.path() }}


##### FileInterface::location()[](#usage/files/file-interface/fileinterface-location)

The `location` method returns the `internal` file path and disk like `disk://folder/filename.ext`.

###### Returns: `string`

###### Example

    $file->location();

###### Twig

    {{ file.location() }}

##### Making an Image instance

// You can return an image instance with the file path {{ img("disk://folder/filename.ext").fit(100, 100)|raw }}

// Remember you can just use the file too {{ img(file).fit(100, 100)|raw }}

// And lastly the make / image method {{ file.image.fit(100, 100)|raw }} {{ file.make.fit(100, 100)|raw }}


##### FileInterface::image()[](#usage/files/file-interface/fileinterface-image)

The `image` method returns an image of the `\Anomaly\Streams\Platform\Image\Image` class with the file as the source.

For more information on using the image class check out the [Streams Platform documentation](/documentation/streams-platform/v1.1#services/image).

###### Returns: `\Anomaly\Streams\Platform\Image\Image`

###### Example

    $file->image()->fit(100, 100)->output(); // the image tag

###### Twig

    {{ file.image().fit(100, 100)|raw }} // the image tag


##### FileInterface::make()[](#usage/files/file-interface/fileinterface-make)

The `make` method is an alias for the `image` method above. This method reduces confusion when your object or file relation field is called `image`.

###### Returns: `\Anomaly\Streams\Platform\Image\Image`

###### Example

    $file->make()->fit(100, 100)->output(); // the image tag

###### Twig

    {{ file.make().fit(100, 100)|raw }} // the image tag


##### FileInterface::resource()[](#usage/files/file-interface/fileinterface-resource)

The `resource` method returns the file resource object.

###### Returns: `\League\Flysystem\File`

###### Example

    $resource = $file->resource();

###### Twig

    {% set resource = file.resource() %}


#### File Presenter[](#usage/files/file-presenter)

This section will go over the `\Anomaly\FilesModule\File\FilePresenter` class.


##### FilePresenter::dimensions()[](#usage/files/file-presenter/filepresenter-dimensions)

The `dimensions` method returns the `width` x `height` string.

###### Returns: `string`

###### Example

    $decorated->dimensions();

###### Twig

    {{ decorated.dimensions() }}


##### FilePresenter::size()[](#usage/files/file-presenter/filepresenter-size)

The `size` method returns the file size in human readable format.

###### Returns: `string`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$unit

</td>

<td>

false

</td>

<td>

string

</td>

<td>

Varies on size of file.

</td>

<td>

The unit of measurement to return. Valid options are `B`, `KB`, `MB`, and `GB`.

</td>

</tr>

<tr>

<td>

$decimals

</td>

<td>

false

</td>

<td>

integer

</td>

<td>

2

</td>

<td>

The decimal precision to show.

</td>

</tr>

</tbody>

</table>

###### Example

    $decorated->size(); // 2.5 MB

###### Twig

    {{ decorated.size() }} // 2.5 MB


##### FilePresenter::preview()[](#usage/files/file-presenter/filepresenter-preview)

The `preview` method returns an image thumbnail with preserved proportions.

If the file is not an image a file-type preview icon will be returned.

###### Returns: `string`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$width

</td>

<td>

false

</td>

<td>

integer

</td>

<td>

64

</td>

<td>

The maximum width constraint.

</td>

</tr>

<tr>

<td>

$height

</td>

<td>

false

</td>

<td>

integer

</td>

<td>

64

</td>

<td>

The maximum height constraint.

</td>

</tr>

</tbody>

</table>

###### Example

    $decorated->preview(100, 100);

###### Twig

    {{ decorated.preview(100, 100)|raw }}


##### FilePresenter::thumbnail()[](#usage/files/file-presenter/filepresenter-thumbnail)

The `thumbnail` method returns an image thumbnail with cropped proportions.

If the file is not an image a file-type preview icon will be returned.

###### Returns: `string`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$width

</td>

<td>

false

</td>

<td>

integer

</td>

<td>

64

</td>

<td>

The thumbnail width.

</td>

</tr>

<tr>

<td>

$height

</td>

<td>

false

</td>

<td>

integer

</td>

<td>

64

</td>

<td>

The thumbnail height.

</td>

</tr>

</tbody>

</table>

###### Example

    $decorated->thumbnail(100, 100);

###### Twig

    {{ decorated.thumbnail(100, 100)|raw }}


##### FilePresenter::viewPath()[](#usage/files/file-presenter/filepresenter-viewpath)

The `viewPath` method returns the public path to view the file.

###### Returns: `string`

###### Example

    $url->to($decorated->viewPath());

###### Twig

    {{ url_to(decorated.viewPath()) }}


##### FileInterface::streamPath()[](#usage/files/file-presenter/fileinterface-streampath)

The `streamPath` method returns the public path to stream the file.

###### Returns: `string`

###### Example

    $url->to($decorated->streamPath());

###### Twig

    {{ url_to(decorated.streamPath()) }}


##### FilePresenter::downloadPath()[](#usage/files/file-presenter/filepresenter-downloadpath)

The `downloadPath` method returns the public path to download the file.

###### Returns: `string`

###### Example

    $url->to($decorated->downloadPath());

###### Twig

    {{ url_to(decorated.downloadPath()) }}


##### FilePresenter::__get()[](#usage/files/file-presenter/filepresenter-get)

The `__get` magic method first checks for a custom entry field before native behavior.

###### Returns: `mixed`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$name

</td>

<td>

true

</td>

<td>

string

</td>

<td>

none

</td>

<td>

The name of the attribute to access.

</td>

</tr>

</tbody>

</table>

###### Example

    $decorated->my_custom_field;

###### Twig

    {{ decorated.my_custom_field }}


### Folders[](#usage/folders)

Folders are the basic containers that hold files. Folders have a flat structure (can not be nested).


#### Folder Fields[](#usage/folders/folder-fields)

Below is a list of `fields` in the `folders` stream. Fields are accessed as attributes:

    $folder->name;

Same goes for decorated instances in Twig:

    {{ folder.name }}


### Disks[](#usage/disks)

`Disks` are the top-most structural component for the Files module. Files reside in a folder. Folders reside on a disk. The `disk` determines "where" the files are stored like locally on the server or on Amazon S3.


#### Disk Interface[](#usage/disks/disk-interface)

This section will go over the features of the `\Anomaly\FilesModule\Disk\Contract\DiskInterface` class.


##### DiskInterface::filesystem()[](#usage/disks/disk-interface/diskinterface-filesystem)

The `filesystem` returns the disk adapter's filesystem.

###### Returns: `\Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem`

###### Example

    $disk->filesystem();


##### DiskInterface::getFolders()[](#usage/disks/disk-interface/diskinterface-getfolders)

The `getFolders` method returns a collection of related folders.

###### Returns: `\Anomaly\FilesModule\Folder\FolderCollection`

###### Example

    foreach ($disk->getFolders() as $folder) {
        echo $folder->getName();
    }


##### DiskInterface::folders()[](#usage/disks/disk-interface/diskinterface-folders)

The `folders` returns the folder relationship.

###### Returns: `\Illuminate\Database\Eloquent\Relations\HasMany`

###### Example

    $disk->folders()->where('name', 'LIKE', '%Gallery Images')->get();
