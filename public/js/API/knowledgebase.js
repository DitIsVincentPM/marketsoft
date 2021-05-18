$(document).ready(function () {
    refresh();
});


function refresh() {
    $('#loader').append(
        '<div class="overlay">' +
        '<i class="fas fa-2x fa-sync-alt fa-spin"></i>' +
        '</div>'
    );

    $('#loader2').append(
        '<div class="overlay">' +
        '<i class="fas fa-2x fa-sync-alt fa-spin"></i>' +
        '</div>'
    );

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/articles",
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
            $("#footer").html('<p class="mb-0">Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            $.each(result, function (key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + item["created_at"] +
                    '<td><button onclick="articleget(' + item['id'] + ')" class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editarticle">' +
                    '<i data-feather="edit-3"></i></button></td> </tr>'
                );
            });

            $('.overlay').remove();
            feather.replace();
        }
    });


    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/categories",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('search').value,
        },
        dataType: "json",
        success: function (result) {
            $('#category-table').html('');
            $("#c-footer").html('<p class="mb-0">Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            $.each(result, function (key, item) {
                $('#category-table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + item["description"] +
                    '<td><button onclick="categoryget(' + item['id'] + ')" class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editcategory">' +
                    '<i data-feather="edit-3"></i></button></td> </tr>'
                );
            });

            $('.overlay').remove();
            feather.replace();
        }
    });
}

function some() {
    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/articles",
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
            $("#footer").html('<p class="mb-0">Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            $.each(result, function (key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + item["created_at"] +
                    '<td><button onclick="articleget(' + item['id'] + ')" class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editarticle">' +
                    '<i data-feather="edit-3"></i></button></td> </tr>'
                );
            });

            $('.overlay').remove();
            feather.replace();
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/categories",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('search').value,
        },
        dataType: "json",
        success: function (result) {
            $('#category-table').html('');
            $("#c-footer").html('<p class="mb-0">Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            $.each(result, function (key, item) {
                $('#category-table').append(
                    '<tr> <td class="text-center">' + item['id'] +
                    '</td> <td class="text-center">' + item['name'] + '</td> <td class="text-center">' + item["description"] +
                    '<td><button onclick="categoryget(' + item['id'] + ')" class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editcategory">' +
                    '<i data-feather="edit-3"></i></button></td> </tr>'
                );
            });

            $('.overlay').remove();
            feather.replace();
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

function articleget(id) {
    $('#editarticle').append(
        '<div class="overlay">' +
        '<i class="fas fa-2x fa-sync-alt fa-spin"></i>' +
        '</div>'
    );

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/article/get",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
        dataType: "json",
        success: function (result) {
            $('.overlay').remove();
            $('#a-category').html('');

            document.getElementById('a-id').innerText = result["id"];
            document.getElementById('a-ids').value = result["id"];
            document.getElementById('a-name').value = result["name"];
            document.getElementById('a-description').value = result["description"];

            $.ajax({
                type: "POST",
                url: "/api/knowledgebase/categories",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function (categorys) {
                    $.each(categorys, function (key, category) {
                        if(category['id'] == result['category_id']) {
                            $('#a-category').append(
                                '<option selected value="' + category['id'] + '">' + category['name'] + '</option>'
                            ); 
                        } else {
                            $('#a-category').append(
                                '<option value="' + category['id'] + '">' + category['name'] + '</option>'
                            );
                        }
                    });
                }
            });
        }
    });
}

function categoryget(id) {
    $('#editcategory').append(
        '<div class="overlay">' +
        '<i class="fas fa-2x fa-sync-alt fa-spin"></i>' +
        '</div>'
    );

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/category/get",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
        dataType: "json",
        success: function (result) {
            $('.overlay').remove();
            document.getElementById('category_name').value = result["name"];
            document.getElementById('category_description').value = result["description"];
            document.getElementById('category_id').innerText = result["id"];
            document.getElementById('categorys_id').value = result["id"];
        }
    });
}

function categoryupdate() {
    var name = document.getElementById('category_name').value;
    var description = document.getElementById('category_description').value;

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/categories/update",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: document.getElementById('categorys_id').value,
            name: name,
            description: description
        },
        dataType: "json",
        success: function (result) {
            refresh();
            alert(["success", "You updated " + name + "'s settings!"]);
        },
        error: function (error) {
            refresh();
            alert(["error", "Something went wrong!"]);
        },
    });
}

function articleupdate() {
    var name = document.getElementById('a-name').value;
    var description = document.getElementById('a-description').value;
    var category = document.getElementById('a-category').value;

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/article/update",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: document.getElementById('a-ids').value,
            name: name,
            description: description,
            category: category
        },
        dataType: "json",
        success: function (result) {
            refresh();
            alert(["success", "You updated Article #" + document.getElementById('a-ids').value + " settings!"]);
        },
        error: function (error) {
            refresh();
            alert(["error", "Something went wrong!"]);
        },
    });
}

function articlecreate() {
    var name = document.getElementById('ac-title').value;
    var description = document.getElementById('ac-description').value;
    var category = document.getElementById('ac-category').value;

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/article/create",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: name,
            description: description,
            category: category
        },
        dataType: "json",
        success: function (result) {
            refresh();
            alert(["success", "You created " + name + "!"]);
        },
        error: function (error) {
            refresh();
            alert(["error", "Something went wrong!"]);
        },
    });
}

function categorycreate() {
    var name = document.getElementById('ca_name').value;
    var description = document.getElementById('ca_description').value;

    $.ajax({
        type: "POST",
        url: "/api/knowledgebase/categories/create",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: name,
            description: description
        },
        dataType: "json",
        success: function (result) {
            refresh();
            alert(["success", "You created " + name + "!"]);
        },
        error: function (error) {
            refresh();
            alert(["error", "Something went wrong!"]);
        },
    });
}