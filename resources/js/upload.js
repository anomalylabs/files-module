$(function () {

    var element = $('.dropzone');

    var dropzone = new Dropzone('.dropzone',
        {
            paramName: 'upload',
            url: '/admin/files/upload/handle',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            sending: function (file, xhr, formData) {
                formData.append('folder', element.data('folder'));
            },
            autoQueue: true,
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            acceptedFiles: element.data('allowed'),
            //maxFilesize: element.find('.files').data('max'),
            dictDefaultMessage: element.data('icon') + ' ' + element.data('message')
        }
    );

    // While file is in transit...
    dropzone.on('sending', function (file) {

        // Update the progress bar when sending.
        element.find('[data-progress="total"]').css('visibility', 'visible');

        // If a preview is not possible - use no-preview.
        var images = ['jpeg', 'jpg', 'png', 'bmp', 'gif'];
        var regex = /(?:\.([^.]+))?$/;
        var extension = regex.exec(file.name)[1];

        extension = extension.toLowerCase();

        // Reveal file upload progress.
        //file.previewElement.querySelector('[data-progress="file"]').setAttribute('style', 'visibility: visible;');
    });

    // When file successfully uploads.
    dropzone.on('success', function (file) {

        var response = JSON.parse(file.xhr.response);

        var uploaded = element.data('uploaded');

        if (uploaded == undefined) {
            uploaded = [];
        } else {
            uploaded = uploaded.split(',');
        }

        uploaded.push(response.id);

        element.data('uploaded', uploaded.join(','));

        $('#table').load('/streams/file-field_type/uploaded?uploaded=' + element.data('uploaded'));
    });

    // Hide the progress bar when done.
    dropzone.on('queuecomplete', function (progress) {
        element.find('[data-progress="total"]').css('visibility', 'hidden');
    });
});
