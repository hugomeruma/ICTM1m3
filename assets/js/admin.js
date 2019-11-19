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

});