var append = 0;

function remove(id) {
    var remove = '#section_' + id;
    $(remove).remove();
}

$("#create-section").click(function(e) {
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
        '<div class="col-12 mt-2 text-right">' +
        '<button onclick="preview(' + append +
        ')" class="mr-2 btn btn-sm btn-primary">Preview</button> <button onclick="remove(' + append +
        ')" class="btn btn-sm btn-danger">Remove</button>' +
        '</div>' +
        '</div>'
    );
    append = append + 1;
});

function preview(id) {
    var type = "#type_" + id;
    var name = "#name_" + id;
    var content = "#content_" + id;
    var edit = "edit_section_" + id;
    var second_preview = "preview-" + id;

    if (document.getElementById(second_preview).style.display == "block") {
        document.getElementById(second_preview).style.display = "none";
        document.getElementById(edit).style.display = "flex";
    } else if ($(type).val() == 1) {
        document.getElementById(second_preview).style.display = "block";
        document.getElementById(edit).style.display = "none";

        $("#preview-" + id).html(
            '<strong>' + $(name).val() + '</strong>' +
            '<p>' + $(content).val() + '</p>'
        );
    } else if ($(type).val() == 2) {
        document.getElementById(second_preview).style.display = "block";
        document.getElementById(edit).style.display = "none";

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

$("#save").click(function(e) {
    const section_name = document.getElementsByClassName('section_name');
    const names = [...section_name].map(input => input.value);

    const section_type = document.getElementsByClassName('section_type');
    const types = [...section_type].map(input => input.value);

    const section_content = document.getElementsByClassName('section_content');
    const content = [...section_content].map(input => input.value);

    console.log(names, types, content);
});