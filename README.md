# Files Module

*anomaly.module.files*

#### Powerful asset management made easy.

The Files Module provides comprehensive file and media management with multiple storage adapters and image manipulation capabilities.

## Features

- File management interface
- Folder organization
- Multiple storage adapters (local, S3, etc.)
- Image manipulation
- File uploads
- Access control
- Thumbnail generation
- Drag & drop interface

## Usage

### Uploading Files

```php
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;

$files = app(FileRepositoryInterface::class);

// Upload from request
$file = $files->upload(request()->file('upload'), $folder);

// Create from path
$file = $files->create([
    'name' => 'document.pdf',
    'folder_id' => $folderId,
    'disk_id' => $diskId,
    'path' => 'path/to/file.pdf'
]);
```

### Accessing Files

```php
// Get file by ID
$file = $files->find(1);

// Get file URL
$url = $file->path();

// Get thumbnail
$thumb = $file->thumbnail('small');

// Get image dimensions
$width = $file->width;
$height = $file->height;
```

### In Twig

```twig
{# Display image #}
<img src="{{ image(file).fit(800, 600) }}" alt="{{ file.name }}">

{# With image manipulation #}
<img src="{{ image(file).resize(300, 200).quality(90) }}">

{# File download link #}
<a href="{{ file.path() }}" download>{{ file.name }}</a>

{# Check file type #}
{% if file.isImage() %}
    <img src="{{ file.path() }}">
{% endif %}

{# File information #}
<p>Size: {{ file.size_human }}</p>
<p>Type: {{ file.mime_type }}</p>
<p>Uploaded: {{ file.created_at|date('F j, Y') }}</p>
```

### Image Manipulation

```twig
{# Resize #}
{{ image(file).resize(400, 300) }}

{# Fit within bounds #}
{{ image(file).fit(800, 600) }}

{# Crop #}
{{ image(file).crop(200, 200) }}

{# Quality #}
{{ image(file).quality(85) }}

{# Chain methods #}
{{ image(file).fit(600, 400).quality(90).blur(5) }}
```

## Requirements

- Streams Platform ^1.10
- PyroCMS 3.10+
- GD or Imagick PHP extension

## License

The Files Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
