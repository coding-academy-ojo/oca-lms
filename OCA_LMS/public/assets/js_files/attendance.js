$(document).ready(function() {
    $('.edit-btn').click(function() {
        var $row = $(this).closest('tr');
        $row.find('.status-text, .reason-text').addClass('d-none');
        $row.find('.status-select, .reason-input').removeClass('d-none');
        $(this).addClass('d-none');
        $row.find('.submit-btn, .cancel-btn').removeClass('d-none');
    });

    $('.cancel-btn').click(function() {
        var $row = $(this).closest('tr');
        $row.find('.status-text, .reason-text').removeClass('d-none');
        $row.find('.status-select, .reason-input').addClass('d-none');
        $row.find('.edit-btn').removeClass('d-none');
        $row.find('.submit-btn, .cancel-btn').addClass('d-none');
    });

    $('.submit-btn').click(function() {
        Swal.fire({
            title: 'Success!',
            text: 'Updated successfully',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {

            }
        });
    });
});