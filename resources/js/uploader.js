$(function () {

    // Configure Dropzone
    $('#uploader').dropzone({
        paramName: 'upload',
        dictDefaultMessage: DROPZONE_MESSAGE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        sending: function (file, xhr, formData) {
            formData.append('disk', DROPZONE_DISK);
            formData.append('folder', DROPZONE_FOLDER);
        }
    });
});
