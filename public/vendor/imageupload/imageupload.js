$(document).on('change', '.up', function() {
    var names = [];
    var length = $(this).get(0).files.length;
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
        names.push($(this).get(0).files[i].name);
    }
    if (length > 2) {
        var fileName = names.join(', ');
        $(this).closest('.form-group').find('.form-control').attr("value", length + " files selected");
    } else {
        $(this).closest('.form-group').find('.form-control').attr("value", names);
    }
});

$("#up").click(function(event) {
    if (!valid) {
        event.preventDefault();
    }
});