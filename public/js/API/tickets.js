$(document).ready(function () {
    refresh();
    categoryrefresh();
});

function refresh() {
    $.ajax({
        type: "POST",
        url: "/api/ticket",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (result) {
            $('#table').html('');
            $("#footer").html('<p>Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            if (result.length == 0) {
                $("#table").html(
                    '<tr>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td class="text-center">' +
                    '<td></td>' +
                    '<td class="text-right"></td>' +
                    '</tr>' +
                    '<tr class="table-info">' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td class="text-center">There a currently <strong>0 tickets</strong> found.</td>' +
                    '<td></td>' +
                    '<td class="text-right"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td class="text-center">' +
                    '<td></td>' +
                    '<td class="text-right"></td>' +
                    '</tr>'
                );
                return;
            }


            $.each(result, function (key, item) {
                if (item['status'] == 0) {
                    status = "Waiting Reply";
                } else if (item['status'] == 1) {
                    status = "Replied";
                } else if (item['status'] == 2) {
                    status = "Complete";
                } else if (item['status'] == 3) {
                    status = "Closed";
                }

                if (item['priority'] == 0) {
                    priority = "Low Priority";
                } else if (item['priority'] == 1) {
                    priority = "Medium Priority";
                } else if (item['priority'] == 2) {
                    priority = "High Priority";
                }

                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] + '</td> <td class="text-center">' + item['name'] +
                    '</td> <td class="text-center">' + priority + '</td> <td class="text-center">' + status +
                    '</td> <td class="text-center">' + item['created_at'] +
                    '</td> <td><div class="pull-right"><a class="btn btn-sm btn-primary" href="/admin/tickets/' + item['id'] +
                    '">View More</a></div></td> </tr>'
                );
            });
        }
    });
}

function some() {
    $.ajax({
        type: "POST",
        url: "/api/ticket/search",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('search').value,
        },
        dataType: "json",
        success: function (result) {
            $('#table').html('');
            $("#footer").html('<p>Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            $.each(result, function (key, item) {
                if (item['status'] == 0) {
                    status = "Waiting Reply";
                } else if (item['status'] == 1) {
                    status = "Replied";
                } else if (item['status'] == 2) {
                    status = "Complete";
                } else if (item['status'] == 3) {
                    status = "Closed";
                }

                if (item['priority'] == 0) {
                    priority = "Low Priority";
                } else if (item['priority'] == 1) {
                    priority = "Medium Priority";
                } else if (item['priority'] == 2) {
                    priority = "High Priority";
                }

                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + priority +
                    '</td> <td class="text-center">' + status + '</td> <td class="text-center">' + item['created_at'] +
                    '</td> <td><div class="pull-right"><a class="btn btn-sm btn-primary" href="/admin/tickets/' + item['id'] +
                    '">View More</a></div></td> </tr>'
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

    var search = document.getElementById("category-search");
    search.addEventListener("keydown", function (e) {
        if (e.keyCode === 13) {
            categorysome();
        }
    });
}

function categoryrefresh() {
    $.ajax({
        type: "POST",
        url: "/api/ticket/categorys",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (result) {
            $('#category-table').html('');
            $("#c-footer").html('<p>Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            $.each(result, function (key, item) {
                $('#category-table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + item["description"] +
                    '<td><button onclick="categoryget(' + item['id'] + ')" class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editcategory">' +
                    '<i data-feather="edit-3"></i></button></td> </tr>'
                );
            });

            
            feather.replace();
        }
    });
}

function categorysome() {
    $.ajax({
        type: "POST",
        url: "/api/ticket/categorys/search",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('category-search').value,
        },
        dataType: "json",
        success: function (result) {
            $('#category-table').html('');

            $.each(result, function (key, item) {
                $('#category-table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + item["description"] +
                    '<td><button onclick="categoryget(' + item['id'] + ')" class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editcategory">' +
                    '<i data-feather="edit-3"></i></button></td> </tr>'
                );
            });
            feather.replace();
        }
    });
}

function categoryget(id) {
    $.ajax({
        type: "POST",
        url: "/api/ticket/categorys/get",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
        dataType: "json",
        success: function (result) {
            document.getElementById('name').value = result["name"];
            document.getElementById('description').value = result["description"];
            document.getElementById('id').value = result["id"];
        }
    });
}

function categoryupdate() {
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;

    $.ajax({
        type: "POST",
        url: "/api/ticket/categorys/update",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            name: name,
            description: description
        },
        dataType: "json",
        success: function (result) {
            alert(["success", "You updated " + name + "'s settings!"]);
            categoryrefresh();
        }
    });
}