setInterval(function () {
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
            $('#comments').html('');

            $.each(result, function (key, item) {
                $('#comments').append(
                    '<div class="card shadow">' +
                        '<div class="card-header">' + 
                            '<div class="row">' +
                                '<div class="col-4">' +
                                    'Reply: #' +
                                '</div>' +
                                '<div class="col-4">' +
                                    'Sent By: ' + item["user_id"] +
                                '</div>' +
                                '<div class="col-4 text-right">' +
                                    'Sent:' + item["created_at"] +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="card-body">' + 
                            '<div class="col-2 text-center">' +
                                    '<img class="center-image rounded-circle" width="55px" src="">' +
                                        '<p class="pt-1">' +
                                            '<span style="color:  !important;"><i style="width: 15px;" data-feather=""></i> </span>' +
                                        '</p>' +
                                '</div>' +
                                    '<div class="col-10">' +
                                        '<p class="text-left" style="width: 87%;"></p>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>'
                );
            });
        }
    });
}, 1000);