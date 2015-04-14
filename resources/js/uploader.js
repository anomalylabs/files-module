$(function () {

    /**
     * When the upload button is clicked
     * simply display the uploader.
     */
    $('[data-toggle="uploader"]').click(function () {
        $('#uploader').closest('div').toggleClass('hidden');
    });
});
