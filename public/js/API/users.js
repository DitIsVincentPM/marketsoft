$(document).ready(function() {
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
        success: function(result) {
            $.ajax({
                type: "POST",
                url: "/api/roles",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(roles) {
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
                        '<select id="ban_edit" class="custom-select">' +
                        '<option ' + ban_no + ' value="0">No</option>' +
                        '<option ' + ban_yes + ' value="1">Yes</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">Role:</span>' +
                        '</div>' +
                        '<select id="role_edit" class="custom-select">' +
                        '</select>' +
                        '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>' +
                        '<button type="submit" data-bs-dismiss="modal" onclick="user_edit(' + result['id'] + ')" class="btn btn-primary">Save changes</button>' +
                        '</div>'
                    );

                    $('.select2').select2()

                    $.each(roles, function(key, role) {
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
        success: function(result) {
            alert(["success", "You updated " + document.getElementById('name_edit').value + "'s settings!"]);
            refresh();
        },
        error: function(error) {
            alert(["error", "Something went wrong!"]);
            refresh();
        },
    });
}

function createusermodal() {
    $.ajax({
        type: "POST",
        url: "/api/roles",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function(roles) {
            $('#createmodal').html(
                '<div class="modal-header">' +
                '<h5 class="modal-title" id="createuserLabel">Create User</h5>' +
                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                '</div>' +
                '<div class="modal-body">' +
                '<div class="row">' +
                '<div class="col-6">' +
                '<div class="mb-3">' +
                '<label class="form-label">Firstname:</label>' +
                '<input type="text" class="form-control" id="firstname">' +
                '</div>' +
                '</div>' +
                '<div class="col-6">' +
                '<div class="mb-3">' +
                '<label class="form-label">Lastname:</label>' +
                '<input type="text" class="form-control" id="lastname">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-6">' +
                '<div class="mb-3">' +
                '<label class="form-label">Username:</label>' +
                '<input type="text" class="form-control" id="name">' +
                '</div>' +
                '</div>' +
                '<div class="col-6">' +
                '<div class="mb-3">' +
                '<label class="form-label">Role:</label>' +
                '<select id="roles" class="custom-select">' +
                '</select>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-12">' +
                '<div class="mb-3">' +
                '<label class="form-label">Email Address:</label>' +
                '<input type="email" class="form-control" id="email">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-6">' +
                '<div class="mb-3">' +
                '<label class="form-label">Password:</label>' +
                '<input type="password" class="form-control" id="password1">' +
                '</div>' +
                '</div>' +
                '<div class="col-6">' +
                '<div class="mb-3">' +
                '<label class="form-label">Confirm Password:</label>' +
                '<input type="password" class="form-control" id="password2">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>' +
                '<button onclick="createuser()" type="submit" class="btn btn-success">Save changes</button>' +
                '</div>'
            );

            $.each(roles, function(key, role) {
                $("#roles").append('<option value="' + role['id'] + '">' + role['name'] + "</option>");
            });
        }
    });
}

function createuser() {
    $.ajax({
        type: "POST",
        url: "/api/user/create",
        data: {
            firstname: document.getElementById('firstname').value,
            lastname: document.getElementById('lastname').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            role: document.getElementById('roles').value,
            password1: document.getElementById('password1').value,
            password2: document.getElementById('password2').value,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(error) {
            alert(['error', "Oops, something went wrong! Please try again."]);
        },
        success: function(result) {
            alert(['success', "You have successfully created a new user!"]);
            refresh();
        }
    });
}

function refresh() {
    $('#loader').append(
        '<div class="overlay">' +
        '<i class="fas fa-2x fa-sync-alt fa-spin"></i>' +
        '</div>'
    );

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
        success: function(result) {
            $.ajax({
                type: "POST",
                url: "/api/roles",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(roles) {
                    $('#table').html('');
                    $("#footer").html('<p class="mb-0">Showing ' + result.length + ' of ' + result.length + ' Results</p>');
                    document.getElementById('refresh').classList.toggle('animate-refresh-rotate');
                    $('.overlay').remove();

                    $.each(result, function(key, item) {
                        $.each(roles, function(key, role) {
                            if (item['role_id'] == role['id']) {
                                if (item["status"] == 1) {
                                    var status = '<span class="badge badge-success btn-sm">ACTIVE</span>';
                                } else {
                                    var status = '<span class="badge badge-secondary btn-sm">INACTIVE</span>';
                                }

                                $('#table').append(
                                    '<tr> <td class="text-center">' + item['id'] +
                                    '</td> <td class="text-center">' + item['name'] +
                                    '</td> <td class="text-center">' + item['email'] +
                                    '</td> <td class="text-center">' + role['name'] +
                                    '</td> <td class="text-center">' + status +
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

window.onload = function() {
    var search = document.getElementById("search");
    search.addEventListener("keydown", function(e) {
        if (e.keyCode === 13) {
            refresh();
        }
    });
}