
function change(name) {
    const list = $('[id=tab-content]');

    for (var i = 0; i < list.length; i++) {
        if (list[i].getAttribute("data-name") == name) {
            list[i].style.display = "block";
            window.location.hash = name;
        } else {
            list[i].style.display = "none";
        }
    }

    const listbuttons = $('[id=tab-button]');

    for (var i = 0; i < listbuttons.length; i++) {
        if (listbuttons[i].getAttribute("data-name") == name) {
            listbuttons[i].classList.add('active');
        } else {
            listbuttons[i].classList.remove('active');
        }
    }
}
window.addEventListener("load", function() { check();});

function check() {
    var location = window.location.hash;
    location = location.replace("#", "");

    const list = $('[id=tab-content]');
    for (var i = 0; i < list.length; i++) {
        if (list[i].getAttribute("data-name") == location) {
            change(list[i].getAttribute("data-name"));
        }
    }
}