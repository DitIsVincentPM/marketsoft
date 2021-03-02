$(document).ready(function () {
    refresh();
});

function getuser(id) {
    $('#content').html('<div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">' +
        '<div class="spinner-border" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>' +
        '</div>');

    $.ajax({
        type: "POST",
        url: "/api/user",
        dataType: 'json',
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (result) {
            $.ajax({
                type: "POST",
                url: "/api/roles",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function (roles) {
                    if (result['is_banned'] == 1) {
                        var ban_yes = "selected";
                        var ban_no = "";
                    } else {
                        var ban_yes = "";
                        var ban_no = "selected";
                    }
                    $('#content').html(
                        '<div class="modal-header">' +
                        '<h4 class="modal-title">User #' + result['id'] + '</h4>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        '<img class="center-image rounded-circle mb-3" src="' + result['profile_picture'] + '" alt="ProfilePicture" width="150" height="150" />' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text">First Name:</span>' +
                        '</div>' +
                        '<input id="firstname_edit" type="text" value="' + result['firstname'] + '" class="form-control">' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text">Last Name:</span>' +
                        '</div>' +
                        '<input id="lastname_edit" type="text" value="' + result['lastname'] + '" class="form-control">' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text">Name:</span>' +
                        '</div>' +
                        '<input id="name_edit" type="text" value="' + result['name'] + '" class="form-control">' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text">Email:</span>' +
                        '</div>' +
                        '<input id="email_edit" type="text" value="' + result['email'] + '" class="form-control">' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">Banned?</span>' +
                        '</div>' +
                        '<select id="ban_edit" class="form-select">' +
                        '<option ' + ban_no + ' value="0">No</option>' +
                        '<option ' + ban_yes + ' value="1">Yes</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">Role:</span>' +
                        '</div>' +
                        '<select id="role_edit" class="form-select">' +

                        '</select>' +
                        '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>' +
                        '<button type="submit" data-bs-dismiss="modal" onclick="user_edit(' + result['id'] + ')" class="btn btn-primary">Save changes</button>' +
                        '</div>'
                    );

                    $.each(roles, function (key, role) {
                        if (result['role_id'] == role['id']) {
                            $("#role_edit").append('<option selected value="' + role['id'] + '">' + role['name'] + "</option>");
                        } else {
                            $("#role_edit").append('<option value="' + role['id'] + '">' + role['name'] + "</option>");
                        }
                    });

                }
            });
        }
    });
}

function user_edit(id) {
    $.ajax({
        type: "POST",
        url: "/api/user/edit",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            name: document.getElementById('name_edit').value,
            firstname: document.getElementById('firstname_edit').value,
            lastname: document.getElementById('lastname_edit').value,
            email: document.getElementById('email_edit').value,
            ban: document.getElementById('ban_edit').value,
            role: document.getElementById('role_edit').value,
        },

        dataType: "json",
        success: function (result) {
            $('#alert').html(
                '<div class="col-12">' +
                '<div id="alert" class="mb-1 alert alert-success alert-dismissible text-center fade show mt-1" role="alert">' +
                "You updated <strong>" + document.getElementById('name_edit').value + "</strong>'s settings!" +
                '</div>' +
                '</div>' +
                '<br>');
            refresh();
        }
    });
}

function refresh() {
    $.ajax({
        type: "POST",
        url: "/api/user/all",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('search').value
        },
        dataType: "json",
        success: function (result) {
            $.ajax({
                type: "POST",
                url: "/api/roles",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function (roles) {
                    $('#table').html('');
                    $.each(result, function (key, item) {
                        $.each(roles, function (key, role) {
                            if (item['role_id'] == role['id']) {
                                $('#table').append(
                                    '<tr> <td class="text-center">' + item['id'] +
                                    '</td> <td class="text-center">' + item['name'] +
                                    '</td> <td class="text-center">' + item['email'] +
                                    '</td> <td class="text-center">' + role['name'] +
                                    '</td> <td><div class="pull-right"><button class="btn btn-sm btn-primary" onclick="getuser(' + item['id'] + ')" data-bs-toggle="modal" data-bs-target="#viewmore">View More</button></div></td> </tr>'
                                );
                            }
                        });
                    });
                }
            });
        }
    });
}

window.onload = function () {
    var search = document.getElementById("search");
    search.addEventListener("keydown", function (e) {
        if (e.keyCode === 13) {
            refresh();
        }
    });
}

