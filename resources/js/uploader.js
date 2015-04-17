$(function () {

    /**
     * When the upload button is clicked
     * simply display the uploader.
     */
    $('[data-toggle="uploader"]').click(function () {
        $('#uploader').closest('div').toggleClass('hidden');
    });

    // Configure Dropzone
    Dropzone.options.uploader = {
        paramName: 'upload',
        dictDefaultMessage: DROPZONE_MESSAGE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        sending: function (file, xhr, formData) {
            formData.append('disk', DROPZONE_DISK);
            formData.append('folder', DROPZONE_FOLDER);
        }
    };
});
