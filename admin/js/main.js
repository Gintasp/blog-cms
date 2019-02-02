$(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });

    $('#select-all').on('click', function () {
        if (this.checked) {
            $('.option-box').each(function () {
                this.checked = true;
            });
        } else {
            $('.option-box').each(function () {
                this.checked = false;
            });
        }
    });

    function loadUsersOnline() {
        $.get("inc/functions.php?online=result", function (data) {
            $('.online').text(data);
        });
    }

    setInterval(function () {
        loadUsersOnline();
    }, 500);
});