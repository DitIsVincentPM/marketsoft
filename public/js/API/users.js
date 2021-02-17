$(document).ready(function () {
    refresh();
});

function getuser(id) {
    $.ajax({
        type: "POST",
        url: "/api/user",
        dataType: 'json',
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function(result) {
            document.getElementById('firstname').value = result["firstname"];
            document.getElementById('lastname').value = result["lastname"];
            document.getElementById('name').value = result["name"];
            document.getElementById('email').value = result["email"];
            document.getElementById('user_id').innerHTML = "User #" + result["id"];
            document.getElementById('profile').src = result["profile_picture"];
        }
    });
}

function refresh() {
    $.ajax({
        type: "POST",
        url: "/api/user/all",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function(result) {
            $('#table').html('');
            $.each(result, function(key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] + 
                    '</td> <td class="text-center">' + item['name'] + 
                    '</td> <td class="text-center">' + item['email'] + 
                    '</td> <td class="text-center">' + item['role_id'] + 
                    '</td> <td><div class="pull-right"><button class="btn btn-sm btn-primary" onclick="getuser(' + item['id'] + ')" data-bs-toggle="modal" data-bs-target="#viewmore">View More</button></div></td> </tr>'
                );
            });
        }
    });
}

function some() {
    $.ajax({
        type: "POST",
        url: "/api/user/search",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            query: document.getElementById('search').value
        },
        dataType: "json",
        success: function(result) {
            $('#table').html('');
            $.each(result, function(key, item) {
                $('#table').append(
                    '<tr> <td class="text-center">' + item['id'] + 
                    '</td> <td class="text-center">' + item['name'] + 
                    '</td> <td class="text-center">' + item['email'] + 
                    '</td> <td class="text-center">' + item['role_id'] + 
                    '</td> <td><div class="pull-right"><button class="btn btn-sm btn-primary" onclick="getuser(' + item['id'] + ')" data-bs-toggle="modal" data-bs-target="#viewmore">View More</button></div></td> </tr>'
                );
            });
        }
    });
}

window.onload = function () {
var search = document.getElementById("search");
search.addEventListener("keydown", function(e) {
    if (e.keyCode === 13) {
        some();
    }
});
}