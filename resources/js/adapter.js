$(function () {

    // When adapter is changed, redirect for config.
    $('select[name="adapter"]').on('change', function () {

        $(this).attr('disabled', 'disabled');

        var path = window.location.pathname.split('/');

        if (path.pop() == 'create') {
            path.push('create');
        }

        path.push($(this).val());

        window.location.pathname = path.join('/');
    });
});
