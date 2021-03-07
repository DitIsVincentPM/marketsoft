var append = 0;

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
