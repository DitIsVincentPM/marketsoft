var append = 0;

window.onload = function() {
    refresh_sections();
}

$(function() {
    $("#sortable").sortable({
        opacity: 0.6,
        cursor: 'move',
        handle: '#handle',
        placeholder: 'border-dotted',
    });
});

function create_section() {
    $("#sortable").append(
        '<li style="list-style: none;" id="section_' + append + '"><div class="card mt-2 mb-2 p-1">' +
        '<div class="card-body">' +
        '<span class="pull-left" style="cursor: all-scroll;" id="handle" data-feather="more-vertical"></span>' +
        '<h5  class="v-center text-left float-left" id="title-' + append + '">New Section</h5>' +
        '<div class="row right v-center float-right">' +
        '<div class="col-12">' +
        '<button id="edit-button-' + append + '" onclick="edit_section(' + append + ')" class="ml-2 btn btn-sm btn-primary">Edit</button> ' +
        '<button onclick="remove(' + append + ')" class="btn btn-sm btn-danger">Remove</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div style="display: none;" id="edit-' + append + '">' +
        '<div class="card-body">' +
        '<div class="row">' +
        '<div class="col-md-8">' +
        '<label class="text-center form-label">Title</label>' +
        '<input class="form-control section_name" placeholder="Put the section name here." value="New Section" id="name_' + append + '"></input>' +
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

    $.ajax({
        type: "POST",
        url: "/api/products/sections",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            sections: sections,
        },
        error: function(error) {
            alert(["error", "Something went wrong!"]);
            refresh();
        },
        success: function() {
            alert(["success", "You updated " + config.name + "'s settings!"]);
            refresh_sections();
        },
    });
}

function refresh_sections() {
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
        success: function(result) {
            $('#sortable').html('');

            $.each(result, function(key, section) {
                if (section['product_id'] == config.id) {
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