function announcement_create() {
    $.ajax({
        type: "POST",
        url: "/api/announcements/create",
        data: {
            title: document.getElementById('name').value,
            description: document.getElementById('description').value,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(error) {
            alert(['error', "Oops, something went wrong! Please try again."]);
        },
        success: function(result) {
            alert(['success', "You have successfully created a new announcement!"]);
            announcement_refresh();
        }
    });
}

function announcement_modal() {
    $('#modaledit').html(
        '<div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">' +
        '<div class="spinner-border" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>' +
        '</div>'
    );

    $.ajax({
        type: "POST",
        url: "/api/announcements/edit",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            $('#modaledit').html(
                '<div class="modal-header">' +
                '<h5 class="modal-title">Modal title</h5>' +
                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                '</div>' +
                '<div class="modal-body">' +
                '<p>Modal body text goes here.</p>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                '<button type="button" class="btn btn-primary">Save changes</button>' +
                '</div>'
            );
        }
    });
}

window.onload = function() {
    announcement_refresh();
}

function announcement_refresh() {
    $.ajax({
        type: "POST",
        url: "/api/announcements/refresh",
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            $('#table').html('');
            $.each(result, function(key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] +
                    '</td> <td class="text-center">' + item['description'] +
                    '</td> <td class="text-center"> <button onclick="announcement_modal(' + item['id'] + ')" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editmodal">Edit</button>' +
                    '</td> <td>' +
                    '</tr>'
                );
            });
        }
    });
}