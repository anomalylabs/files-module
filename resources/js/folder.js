$(function () {

    /**
     * When the new folder button is clicked
     * simply display the form.
     */
    $('[data-toggle="folder"]').click(function (e) {

        e.preventDefault();

        $('#folder').toggleClass('hidden');
    });
});
