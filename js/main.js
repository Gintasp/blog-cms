$(document).ready(function () {
    $('#comment_submit').on('click', function (e) {
        if (!$('#author').val() || !$('#email').val() || !$('#comment').val()) {
            alert('Fields cannot be empty!');
            e.preventDefault();
        }
    })
});