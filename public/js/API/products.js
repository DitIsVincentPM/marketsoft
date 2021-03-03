var append = 0;
var sections = {};

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
                        ' <div class="col-8">' +
                        'Sections' +
                        '</div>' +
                        '<div class="text-right col-4">' +
                        '<button onclick="create_section()" class="btn btn-sm btn-primary">Create</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div id="sections">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                        '<button onclick="save(' + item['id'] + ')" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>' +
                        '</div>' +
                        '</div>   '
                    );
                }
            });

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

            $("#sections").html(
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
                    $.each(result, function (key, section) {
                        if (section['product_id'] == id) {
                            $('#sections').html('');

                            var text;
                            var accordion;
                            if (section['type'] == 1) {
                                text = "selected";
                            } else if (section['type'] == 2) {
                                accordion = "selected";
                            }

                            $("#sections").append(
                                '<div id="section_' + append + '" style="box-shadow: 0px 0px 19px -8px rgba(0,0,0,0.3);" class="card mt-3 p-3">' +
                                '<div class="row card-body" style="display: flex;" id="edit_section_' + append + '">' +
                                '<div class="col-8">' +
                                '<label class="form-label">Name</label>' +
                                '<input id="name_' + append +
                                '" class="section_name form-control btn-block" value="' + section['name'] + '" placeholder="Cool Section"></input>' +
                                '</div>' +
                                '<div class="col-4">' +
                                '<label class="form-label">Type</label>' +
                                '<select id="type_' + append + '" class="pt-3 pb-3 section_type form-select">' +
                                '<option ' + text + ' value="1">Text</option>' +
                                '<option ' + accordion + ' value="2">Accordion</option>' +
                                '</select>' +
                                '</div>' +
                                '<div class="col-12 mt-2">' +
                                '<label class="form-label">Content</label>' +
                                '<textarea id="content_' + append +
                                '" class="section_content form-control btn-block" placeholder="Here you can put all the content that you want in the section.">' + section['content'] + '</textarea>' +
                                '</div>' +
                                '</div>' +
                                '<div id="preview-' + append + '" style="display: none;">' +
                                '</div>' +
                                '<input class="section_ids" hidden value="' + section['id'] + '"></input>' +
                                '<div class="col-12 mt-2 text-right">' +
                                '<button onclick="preview(' + append +
                                ')" class="mr-2 btn btn-sm btn-primary">Preview</button> <button onclick="remove(' + append +
                                ')" class="btn btn-sm btn-danger">Remove</button>' +
                                '</div>' +
                                '</div>'
                            );
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
        ' <div class="col-8">' +
        'Sections' +
        '</div>' +
        '<div class="text-right col-4">' +
        '<button onclick="create_section()" class="btn btn-sm btn-primary">Create</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div id="sections">' +
        '</div>' +
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

function create_section() {
    $("#sections").append(
        '<div id="section_' + append + '" style="box-shadow: 0px 0px 19px -8px rgba(0,0,0,0.3);" class="card mt-3 p-3">' +
        '<div class="row card-body" style="display: flex;" id="edit_section_' + append + '">' +
        '<div class="col-8">' +
        '<label class="form-label">Name</label>' +
        '<input id="name_' + append +
        '" class="section_name form-control btn-block" placeholder="Cool Section"></input>' +
        '</div>' +
        '<div class="col-4">' +
        '<label class="form-label">Type</label>' +
        '<select id="type_' + append + '" class="pt-3 pb-3 section_type form-select">' +
        '<option value="1">Text</option>' +
        '<option value="2">Accordion</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-12 mt-2">' +
        '<label class="form-label">Content</label>' +
        '<textarea id="content_' + append +
        '" class="section_content form-control btn-block" placeholder="Here you can put all the content that you want in the section."></textarea>' +
        '</div>' +
        '</div>' +
        '<div id="preview-' + append + '" style="display: none;">' +
        '</div>' +
        '<input class="section_ids" hidden value="null"></input>' +
        '<div class="col-12 mt-2 text-right">' +
        '<button onclick="preview(' + append +
        ')" class="mr-2 btn btn-sm btn-primary">Preview</button> <button onclick="remove(' + append +
        ')" class="btn btn-sm btn-danger">Remove</button>' +
        '</div>' +
        '</div>'
    );
    append = append + 1;
}

function preview(id) {
    var type = "#type_" + id;
    var name = "#name_" + id;
    var content = "#content_" + id;
    var edit = "edit_section_" + id;
    var second_preview = "preview-" + id;

    if (document.getElementById(second_preview).style.display == "block") {
        $(second_preview).hide();
        document.getElementById(edit).style.display = "flex";
    } else if ($(type).val() == 1) {
        document.getElementById(second_preview).style.display = "block";
        $(edit).hide();

        $("#preview-" + id).html(
            '<strong>' + $(name).val() + '</strong>' +
            '<p>' + $(content).val() + '</p>'
        );
    } else if ($(type).val() == 2) {
        document.getElementById(second_preview).style.display = "block";
        $(edit).hide();

        $("#preview-" + id).html(
            '<div class="accordion" id="accordionExample">' +
            '<div class="accordion-item">' +
            '<h2 class="accordion-header" id="headingOne">' +
            '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">' +
            $(name).val() + '</button>' +
            '</h2>' +
            '<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">' +
            '<div class="accordion-body">' +
            $(content).val() +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
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

    for (i = 0; i < section_name.length; i++) {
        sections[i] = {};
        sections[i]["name"] = section_name[i].value;
        sections[i]["type"] = section_type[i].value;
        sections[i]["content"] = section_content[i].value;
        sections[i]["id"] = section_ids[i].value;
    }

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
            $('#alert').html(
                '<div class="col-12">' +
                '<div id="alert" class="mb-1 alert alert-danger alert-dismissible text-center fade show mt-1" role="alert">' +
                "<strong>Error:</strong> Something went wrong!" +
                '</div>' +
                '</div>' +
                '<br>');
            refresh();
        },
        success: function () {
            $('#alert').html(
                '<div class="col-12">' +
                '<div id="alert" class="mb-1 alert alert-success alert-dismissible text-center fade show mt-1" role="alert">' +
                "<strong>Success:</strong> You updated <strong>" + document.getElementById('name').value + "</strong>'s settings!" +
                '</div>' +
                '</div>' +
                '<br>');
            refresh();
        },
    });
}