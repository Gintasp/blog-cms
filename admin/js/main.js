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

    const pusher = new Pusher('14e73c5000f44feb0214', {
        cluster: 'eu',
        forceTLS: true
    });

    const channel = pusher.subscribe('notifications');
    channel.bind('new-user', function (data) {
        toastr.success(data.message + ' has just registered!');
    });
});