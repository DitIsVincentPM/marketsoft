var ArrayLength = -1;

window.onload = function () {
    active_users();

    setInterval(active_users, 10000);

    function active_users() {
        $('#loader').append(
            '<div class="overlay">' +
            '<i class="fas fa-2x fa-sync-alt fa-spin"></i>' +
            '</div>'
        );
        $.ajax({
            type: "POST",
            url: "/api/activeusers",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (result) {
                $('.overlay').remove();
                if (result == 1) {
                    $('#active_users').html(
                        '<p class="mb-0">Currently there is <strong>' + result + ' User</strong> on the site!</p>'
                    );
                } else {
                    $('#active_users').html(
                        '<p class="mb-0">Currently there are <strong>' + result + ' Users</strong> on the site!</p>'
                    );
                }
            }
        });
    }
}