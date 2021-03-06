var append = 0;

function edit_product(id) {

    $('#product_model').html(
        '<div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">' +
        '<div class="spinner-border" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>' +
        '</div>'
    );

    $.ajax({
        type: "POST",
        url: "/api/products",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (result) {
            $.each(result, function (key, item) {
                if (item['id'] == id) {
                    $('#product_model').html(
                        '<div class="modal-header">' +
                        '<h4 class="modal-title" id="viewmoreLabel">Product #' + item['id'] + '</h4>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        '<div class="row">' +
                        ' <div class="col-8">' +
                        '<div class="input-group mb-3">' +
                        '<div style="height: 55px;" class="input-group-append">' +
                        '<span class="input-group-text">Name:</span>' +
                        '</div>' +
                        '<input type="text" id="name" class="form-control" value="' + item['name'] + '">' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-4">' +
                        '<div class="input-group mb-3">' +
                        '<div style="height: 55px;" class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">Price:</span>' +
                        '</div>' +
                        '<input type="text" id="price" class="form-control" value="' + item['price'] + '">' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-12">' +
                        '<div style="height: 55px;" class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text">Description (Short):</span>' +
                        '</div>' +
                        '<input type="text" id="description" class="form-control" value="' + item['description'] + '">' +
                        '</div>' +
                        '</div>' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text">Category:</span>' +
                        '</div>' +
                        '<select class="form-select" id="category" name="category">' +
                        '</select>' +
                        '</div>' +
                        '<hr>' +
                        '<div class="card">' +
                        '<div class="card-header">' +
                        '<div class="row">' +
                        ' <div class="col-8 mt-1">' +
                        'Sections' +
                        '</div>' +
                        '<div class="text-right col-4">' +
                        '<button onclick="create_section()" class="btn btn-sm btn-primary">Create</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<ul id="sortable">' +
                        '</ul>' +
                        '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                        '<button onclick="save(' + item['id'] + ')" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>' +
                        '</div>' +
                        '</div>   '
                    );

                    $("#category").html(
                        '<option>' +
                        '<span class="sr-only">Loading...</span>' +
                        '</option>'
                    );

                    $.ajax({
                        type: "POST",
                        url: "/api/products/categorys",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (result) {
                            $("#category").html('');

                            $.each(result, function (key, category) {
                                if (item['category'] == category['id']) {
                                    $("#category").append('<option selected value="' + category['id'] + '">' + category['name'] + "</option>");
                                } else {
                                    $("#category").append('<option value="' + category['id'] + '">' + category['name'] + "</option>");
                                }
                            });
                        }
                    });
                }
            });

            $("#sortable").html(
                '<div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">' +
                '<div class="spinner-border" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>' +
                '</div>'
            );

            $.ajax({
                type: "POST",
                url: "/api/products/sections",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function (result) {
                    $('#sortable').html('');

                    $.each(result, function (key, section) {
                        if (section['product_id'] == id) {
                            var text;
                            var accordion;
                            if (section['type'] == 1) {
                                text = "selected";
                            } else if (section['type'] == 2) {
                                accordion = "selected";
                            }

                            $("#sortable").append(
                                '<li id="section_' + append + '"><div style="box-shadow: 0px 0px 19px -8px rgba(0,0,0,0.3);" class="card mt-2 mb-2 p-1">' +
                                '<div class="card-body" style="background-color: #2e3145 !important;">' +
                                '<span class="pull-left" style="cursor: all-scroll;" id="handle" data-feather="more-vertical"></span>' +
                                '<h5 style="width: 400px; margin-left: 32%; height: 18px; overflow: hidden; white-space: nowrap;" class="v-center text-left" id="title-' + append + '">' + section['name'] + '</h5>' +
                                '<div class="row right v-center">' +
                                '<div class="col-12">' +
                                '<button id="edit-button-' + append + '" onclick="edit_section(' + append + ')" class="ml-2 btn btn-sm btn-primary">Edit</button> ' +
                                '<button onclick="remove(' + append + ')" class="btn btn-sm btn-danger">Remove</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div style="display: none;" id="edit-' + append + '">' +
                                '<div style="background-color: #2e3145 !important;" class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-md-8">' +
                                '<label class="text-center form-label">Title</label>' +
                                '<input class="form-control section_name" placeholder="Put the section name here." value="' + section['name'] + '" id="name_' + append + '"></input>' +
                                '</div>' +
                                '<div class="col-md-4">' +
                                '<label class="text-center form-label">Type</label>' +
                                '<select id="type_' + append + '" class="pt-3 pb-3 section_type form-select">' +
                                '<option ' + text + ' value="1">Text</option>' +
                                '<option ' + accordion + ' value="2">Accordion</option>' +
                                '</select>' +
                                '</div>' +
                                '<div class="col-md-12 mt-2">' +
                                '<label class="text-center form-label">Content</label>' +
                                '<textarea id="content_' + append +
                                '" class="section_content form-control btn-block" placeholder="Here you can put all the content that you want in the section.">' + section['content'] + '</textarea>' +
                                '</div>' +
                                '<input class="section_ids" hidden value="' + section['id'] + '"></input>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                            ).sortable({
                                opacity: 0.6,
                                cursor: 'move',
                                handle: '#handle',
                                placeholder: 'border-dotted',
                            });
                            feather.replace();

                            append = append + 1;
                        }
                    });
                }
            });
        }
    });
}

function create() {
    $('#product_model').html(
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="viewmoreLabel">Create Product</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        ' <div class="col-8">' +
        '<div class="input-group mb-3">' +
        '<div style="height: 55px;" class="input-group-append">' +
        '<span class="input-group-text">Name:</span>' +
        '</div>' +
        '<input type="text" id="name" class="form-control" placeholder="John doe">' +
        '</div>' +
        '</div>' +
        '<div class="col-4">' +
        '<div class="input-group mb-3">' +
        '<div style="height: 55px;" class="input-group-append">' +
        '<span class="input-group-text">Price:</span>' +
        '</div>' +
        '<input type="text" id="price" class="form-control" placeholder="19.99">' +
        '</div>' +
        '</div>' +
        '<div class="col-12">' +
        '<div style="height: 55px;" class="input-group mb-3">' +
        '<div class="input-group-append">' +
        '<span class="input-group-text">Description (Short):</span>' +
        '</div>' +
        '<input type="text" id="description" class="form-control" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur.">' +
        '</div>' +
        '</div>' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-append">' +
        '<span class="input-group-text">Category:</span>' +
        '</div>' +
        '<select class="form-select" id="category" name="category">' +
        '</select>' +
        '</div>' +
        '<hr>' +
        '<div class="card">' +
        '<div class="card-header">' +
        '<div class="row">' +
        ' <div class="col-8 mt-1">' +
        'Sections' +
        '</div>' +
        '<div class="text-right col-4">' +
        '<button onclick="create_section()" class="btn btn-sm btn-primary">Create</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<ul id="sortable">' +
        '</ul>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
        '<button onclick="save(' + "'create'" + ')" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>' +
        '</div>' +
        '</div>   '
    );

    $("#category").html(
        '<option>' +
        '<span class="sr-only">Loading...</span>' +
        '</option>'
    );

    $.ajax({
        type: "POST",
        url: "/api/products/categorys",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (result) {
            $("#category").html('');

            $.each(result, function (key, category) {
                $("#category").append('<option value="' + category['id'] + '">' + category['name'] + "</option>");
            });
        }
    });
}

function refresh() {
    $.ajax({
        type: "POST",
        url: "/api/products",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        error: function (error) {
            refresh();
        },
        success: function (result) {
            $("#products_table").html('');
            $("#footer").html('<p>Showing ' + result.length + ' of ' + result.length + ' Results</p>');

            if (result.length == 0) {
                $("#products_table").html(
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
                    '<td class="text-center">There a currently <strong>0 Products</strong> found.</td>' +
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
                $("#products_table").append(
                    '<tr>' +
                    '<td>' + item['id'] + '</td>' +
                    '<td>' + item['name'] + '</td>' +
                    '<td>' + item['description'] + '</td>' +
                    '<td>' + item['price'] + '</td>' +
                    '<td class="text-right"><button onclick="edit_product(' + item['id'] + ')" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewmore">View More</button></td>' +
                    '</tr>'
                );
            });
        }
    });
}

window.onload = function () {
    refresh();
}


$(function () {
    $("#sortable").sortable({
        opacity: 0.6,
        cursor: 'move',
        handle: '#handle',
        placeholder: 'border-dotted',
    });
});

function create_section() {
    $("#sortable").append(
        '<li id="section_' + append + '"><div style="box-shadow: 0px 0px 19px -8px rgba(0,0,0,0.3);" class="card mt-2 mb-2 p-1">' +
        '<div class="card-body" style="background-color: #2e3145 !important;">' +
        '<span class="pull-left" style="cursor: all-scroll;" id="handle" data-feather="more-vertical"></span>' +
        '<h5 style="margin-left: 32%; width: 400px; " class="v-center text-left" id="title-' + append + '">New Section</h5>' +
        '<div class="row right v-center">' +
        '<div class="col-12">' +
        '<button id="edit-button-' + append + '" onclick="edit_section(' + append + ')" class="ml-2 btn btn-sm btn-primary">Edit</button> ' +
        '<button onclick="remove(' + append + ')" class="btn btn-sm btn-danger">Remove</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div style="display: none;" id="edit-' + append + '">' +
        '<div style="background-color: #2e3145 !important;" class="card-body">' +
        '<div class="row">' +
        '<div class="col-md-8">' +
        '<label class="text-center form-label">Title</label>' +
        '<input class="form-control section_name" placeholder="Put the section name here." id="name_' + append + '"></input>' +
        '</div>' +
        '<div class="col-md-4">' +
        '<label class="text-center form-label">Type</label>' +
        '<select id="type_' + append + '" class="pt-3 pb-3 section_type form-select">' +
        '<option value="1">Text</option>' +
        '<option value="2">Accordion</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-md-12 mt-2">' +
        '<label class="text-center form-label">Content</label>' +
        '<textarea id="content_' + append +
        '" class="section_content form-control btn-block" placeholder="Here you can put all the content that you want in the section."></textarea>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<input class="section_ids" hidden value="null"></input>' +
        '</div>' +
        '</div>' +
        '</li>'
    ).sortable({
        opacity: 0.6,
        cursor: 'move',
        handle: '#handle',
        placeholder: 'border-dotted',
    });

    feather.replace();
    append = append + 1;
}


function edit_section(id) {
    var edit_section = '#edit-' + id;
    var edit_section_button = 'edit-button-' + id;

    if (document.getElementById(edit_section_button).innerHTML == "Edit") {
        $(edit_section).show();
        document.getElementById(edit_section_button).innerHTML = 'Save';
        document.getElementById(edit_section_button).classList.remove('btn-primary');
        document.getElementById(edit_section_button).classList.add('btn-success');
    } else if (document.getElementById(edit_section_button).innerHTML == "Save") {
        $(edit_section).hide();
        var name = 'name_' + id;
        var title = 'title-' + id;

        document.getElementById(title).innerHTML = document.getElementById(name).value;
        document.getElementById(edit_section_button).innerHTML = 'Edit';
        document.getElementById(edit_section_button).classList.remove('btn-success');
        document.getElementById(edit_section_button).classList.add('btn-primary');
    }
}

function remove(id) {
    $('#section_' + id).hide();
    $('#name_' + id).attr("value", "del");
}

function save(id) {
    const section_name = document.getElementsByClassName('section_name');
    const section_type = document.getElementsByClassName('section_type');
    const section_content = document.getElementsByClassName('section_content');
    const section_ids = document.getElementsByClassName('section_ids');
    var sections = {};

    for (i = 0; i < section_name.length; i++) {
        sections[i] = {};
        sections[i]["name"] = section_name[i].value;
        sections[i]["type"] = section_type[i].value;
        sections[i]["content"] = section_content[i].value;
        sections[i]["id"] = section_ids[i].value;
    }

    console.log(sections);


    $.ajax({
        type: "POST",
        url: "/api/products/edit",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            price: document.getElementById('price').value,
            category: document.getElementById('category').value,
            sections: sections,
        },
        error: function (error) {
            alert(["error", "Something went wrong!"]);
            refresh();
        },
        success: function () {
            alert(["success", "You updated " + document.getElementById('name').value + "'s settings!"]);

            refresh();
        },
    });
}