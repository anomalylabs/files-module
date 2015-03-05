$(document).ready(function () {

    /**
     * When the upload button is clicked
     * simply display the uploader.
     */
    $('[data-toggle-uploader]').click(function () {

        var uploader = $(this).data('toggle-uploader');

        $('#' + uploader).closest('.row').toggleClass('hidden');
    });
});