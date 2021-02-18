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
                '<input type="text" value="' + result['firstname'] + '" class="form-control" disabled>' +
                '</div>' +
                '<div class="input-group mb-3">' +
                '<div class="input-group-append">' +
                '<span class="input-group-text">Last Name:</span>' +
                '</div>' +
                '<input type="text" value="' + result['lastname'] + '" class="form-control" disabled>' +
                '</div>' +
                '<div class="input-group mb-3">' +
                '<div class="input-group-append">' +
                '<span class="input-group-text">Name:</span>' +
                '</div>' +
                '<input type="text" value="' + result['name'] + '" class="form-control" disabled>' +
                '</div>' +
                '<div class="input-group mb-3">' +
                '<div class="input-group-append">' +
                '<span class="input-group-text">Email:</span>' +
                '</div>' +
                '<input type="text" value="' + result['email'] + '" class="form-control" disabled>' +
                '</div>' +
                '<div class="input-group mb-3">' +
                '<div class="input-group-append">' +
                '<span class="input-group-text" id="basic-addon2">Banned?</span>' +
                '</div>' +
                '<select name="ban" class="form-select">' +
                '<option value="0">No</option>' +
                '<option value="1">Yes</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>' +
                '<button type="submit" class="btn btn-primary">Save changes</button>' +
                '</div>'
            );
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
        dataType: "json",
        success: function (result) {
            $('#table').html('');
            $.each(result, function (key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] +
                    '</td> <td class="text-center">' + item['email'] +
                    '</td> <td class="text-center">' + item['role_id'] +
                    '</td> <td><div class="pull-right"><button class="btn btn-sm btn-primary" onclick="getuser(' + item['id'] + ')" data-bs-toggle="modal" data-bs-target="#viewmore">View More</button></div></td> </tr>'
                );
            });
        }
    });
}

function some() {
    $.ajax({
        type: "POST",
        url: "/api/user/search",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('search').value
        },
        dataType: "json",
        success: function (result) {
            $('#table').html('');
            $.each(result, function (key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] +
                    '</td> <td class="text-center">' + item['email'] +
                    '</td> <td class="text-center">' + item['role_id'] +
                    '</td> <td><div class="pull-right"><button class="btn btn-sm btn-primary" onclick="getuser(' + item['id'] + ')" data-bs-toggle="modal" data-bs-target="#viewmore">View More</button></div></td> </tr>'
                );
            });
        }
    });
}

window.onload = function () {
    var search = document.getElementById("search");
    search.addEventListener("keydown", function (e) {
        if (e.keyCode === 13) {
            some();
        }
    });
}

