var ArrayLength = -1;

window.onload = function() {
    active_users();

    setInterval(active_users, 10000);

    function active_users() {
        $('#active_users').append('<div style="margin: 0; position: absolute; top: 50%; left: 98%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">' +
            '<div class="spinner-border" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' +
            '</div>');
        $.ajax({
            type: "POST",
            url: "/api/activeusers",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function(result) {
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