var ArrayLength = -1;

window.onload = function () {
    comments();

    setInterval(comments, 10000);

    function comments() {
        $.ajax({
            type: "POST",
            url: "/api/ticket/comments",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: document.getElementById('ticket_id').value,
            },
            dataType: "json",
            success: function (result) {
                if (ArrayLength == -1) {
                    ArrayLength = result.length;
                } else if(result.length == 0) {
                    return;
                } else if (result.length == ArrayLength) {
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "/api/user/all",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function (users) {
                        $.ajax({
                            type: "POST",
                            url: "/api/roles",
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "json",
                            success: function (roles) {
                                $('#comments').html('');
                                $.each(result, function (key, item) {
                                    $.each(users, function (key, user) {
                                        $.each(roles, function (key, role) {
                                            if (user["id"] == item["user_id"]) {
                                                if (user["role_id"] == role["id"]) {
                                                    $('#comments').append(
                                                        '<div class="card">' +
                                                        '<div class="card-header">' +
                                                        '<div class="row">' +
                                                        '<div class="col-6 text-left">' +
                                                        'Sent By: ' + user["firstname"] + " " + user["lastname"] +
                                                        '</div>' +
                                                        '<div class="col-6 text-right">' +
                                                        'Sent: ' + item["created_at"].split("T")[0]  +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '<div class="card-body">' +
                                                        '<div class="row">' +
                                                        '<div class="col-2 text-center">' +
                                                        '<img class="center-image rounded-circle" width="55px" src="' + user["profile_picture"] + '">' +
                                                        '<p class="pt-1">' +
                                                        '<span style="color: ' + role["color"] + ' !important;"><i style="width: 15px;" data-feather="' + role["icon"] + '"></i> ' + role["name"] + '</span>' +
                                                        '</p>' +
                                                        '</div>' +
                                                        '<div class="col-10">' +
                                                        '<p class="text-left" style="width: 87%;">' + item["message"] + '</p>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>'
                                                    );
                                                }
                                            }
                                        });
                                    });
                                });
                                ArrayLength = result.length;
                                feather.replace();
                            }
                        });
                    }
                });
            }
        });
    }
}
