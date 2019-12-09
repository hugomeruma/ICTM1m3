$(document).ready(function () {
    // Crud overview checkboxes
    $('[name="select_all"]').on('click', function () {
        if ($('[name="select_all"]').prop('checked')) {
            $('.overview-checkbox').prop('checked', true);
            $('[name="select_all"]').prop('indeterminate', true);
        } else {
            $('.overview-checkbox').prop('checked', false);
        }
    });

    // Crud overview execute button on enter in input
    $("#crudSearch").on('keydown', function (e) {
        if (e.key === 'Enter') {
            var value = $('input[name=zoeken]').val();
            url = window.location.href;
            url = url.substring(0, url.indexOf('?'));
            var url = url + '?zoek-opdracht=' + value;
            window.location.href = url;
            return false;
        }
    });
});