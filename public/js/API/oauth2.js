function oauth2_status(oauth2) {
    $.ajax({
        type: "POST",
        url: "/api/oauth2/status",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            oauth2: oauth2,
        },
        error: function(error) {
            alert(["error", "Something went wrong!"]);
        },
        success: function(result) {
            alert(['success', "You successfully updated the status."]);
            oauth2_refresh();
        }
    });
}

window.onload = function() {
    oauth2_refresh();
}

function oauth2_refresh() {
    $.ajax({
        type: "POST",
        url: "/api/oauth2/refresh",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(error) {
            alert(["error", "Something went wrong!"]);
        },
        success: function(result) {;
            if (result[0]["status"] == 1) {
                $('#google').html(
                    '<div class="card mb-4">' +
                    '<div class="card-header">' +
                    '<h5 class="mb-0 mt-2 pull-left">' +
                    '<i class="fab fa-google icon-google" style="margin-right: 5px!important;"></i> Google OAuth2' +
                    '</h5>' +
                    '<button type="submit" onclick="oauth2_status(' + "'google'" + ')" class="btn btn-danger btn-sm pull-right">Disable</button>' +
                    '</div>' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-6">' +
                    '<div class="mb-3">' +
                    '<label class="form-label">Client ID:</label>' +
                    '<input type="text" id="google_client_id" class="form-control" value="' + result[0]["client_id"] + '">' +
                    '</div>' +
                    '</div>' +
                    '<input hidden name="oauth2" value="google">' +
                    '<div class="col-6">' +
                    '<div class="mb-3">' +
                    '<label class="form-label">Client Secret:</label>' +
                    '<input type="password" id="google_client_secret" class="form-control" value="' + result[0]["client_secret"] + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="card-footer">' +
                    '<button type="submit" onclick="oauth2_update(' + "'google'" + ')" class="btn btn-primary btn-sm pull-left">Submit</button>' +
                    '</div>' +
                    '</div>'
                );
            } else if (result[0]["status"] == 0) {
                $('#google').html(
                    '<div class="card mb-4">' +
                    '<div class="card-header">' +
                    '<h5 class="mb-0 mt-2 pull-left">' +
                    '<i class="fab fa-google icon-google" style="margin-right: 5px!important;"></i> Google OAuth2' +
                    '</h5>' +
                    '<button type="submit" onclick="oauth2_status(' + "'google'" + ')" class="btn btn-success btn-sm pull-right">Enable</button>' +
                    '</div>' +
                    '</div>'
                );
            }

            if (result[1]["status"] == 1) {
                $('#discord').html(
                    '<div class="card mb-4">' +
                    '<div class="card-header">' +
                    '<h5 class="mb-0 mt-2 pull-left">' +
                    '<i class="fab fa-discord icon-discord" style="margin-right: 5px!important;"></i> Discord OAuth2' +
                    '</h5>' +
                    '<button type="submit" onclick="oauth2_status(' + "'discord'" + ')" class="btn btn-danger btn-sm pull-right">Disable</button>' +
                    '</div>' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-6">' +
                    '<div class="mb-3">' +
                    '<label class="form-label">Client ID:</label>' +
                    '<input type="text" id="discord_client_id" class="form-control" value="' + result[1]["client_id"] + '">' +
                    '</div>' +
                    '</div>' +
                    '<input hidden name="oauth2" value="discord">' +
                    '<div class="col-6">' +
                    '<div class="mb-3">' +
                    '<label class="form-label">Client Secret:</label>' +
                    '<input type="password" id="discord_client_secret" class="form-control" value="' + result[1]["client_secret"] + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="card-footer">' +
                    '<button type="submit" onclick="oauth2_update(' + "'discord'" + ')" class="btn btn-primary btn-sm pull-left">Submit</button>' +
                    '</div>' +
                    '</div>'
                );
            } else if (result[1]["status"] == 0) {
                $('#discord').html(
                    '<div class="card mb-4">' +
                    '<div class="card-header">' +
                    '<h5 class="mb-0 mt-2 pull-left">' +
                    '<i class="fab fa-discord icon-discord" style="margin-right: 5px!important;"></i> Discord OAuth2' +
                    '</h5>' +
                    '<button type="submit" onclick="oauth2_status(' + "'discord'" + ')" class="btn btn-success btn-sm pull-right">Enable</button>' +
                    '</div>' +
                    '</div>'
                );
            }

            if (result[2]["status"] == 1) {
                $('#github').html(
                    '<div class="card mb-4">' +
                    '<div class="card-header">' +
                    '<h5 class="mb-0 mt-2 pull-left">' +
                    '<i class="fab fa-github icon-github" style="margin-right: 5px!important;"></i> Github OAuth2' +
                    '</h5>' +
                    '<button type="submit" onclick="oauth2_status(' + "'github'" + ')" class="btn btn-danger btn-sm pull-right">Disable</button>' +
                    '</div>' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-6">' +
                    '<div class="mb-3">' +
                    '<label class="form-label">Client ID:</label>' +
                    '<input type="text" id="github_client_id" class="form-control" value="' + result[2]["client_id"] + '">' +
                    '</div>' +
                    '</div>' +
                    '<input hidden name="oauth2" value="github">' +
                    '<div class="col-6">' +
                    '<div class="mb-3">' +
                    '<label class="form-label">Client Secret:</label>' +
                    '<input type="password" id="github_client_secret" class="form-control" value="' + result[2]["client_secret"] + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="card-footer">' +
                    '<button type="submit" onclick="oauth2_update(' + "'github'" + ')" class="btn btn-primary btn-sm pull-left">Submit</button>' +
                    '</div>' +
                    '</div>'
                );
            } else if (result[2]["status"] == 0) {
                $('#github').html(
                    '<div class="card mb-4">' +
                    '<div class="card-header">' +
                    '<h5 class="mb-0 mt-2 pull-left">' +
                    '<i class="fab fa-github icon-github" style="margin-right: 5px!important;"></i> Github OAuth2' +
                    '</h5>' +
                    '<button type="submit" onclick="oauth2_status(' + "'github'" + ')" class="btn btn-success btn-sm pull-right">Enable</button>' +
                    '</div>' +
                    '</div>'
                );
            }
        }
    });
}

function oauth2_update(oauth2) {
    if (oauth2 == "google") {
        clientid = document.getElementById('google_client_id').value;
        clientsecret = document.getElementById('google_client_secret').value;
    } else if (oauth2 == "discord") {
        clientid = document.getElementById('discord_client_id').value;
        clientsecret = document.getElementById('discord_client_secret').value;
    } else if (oauth2 == "github") {
        clientid = document.getElementById('github_client_id').value;
        clientsecret = document.getElementById('github_client_secret').value;
    }

    $.ajax({
        type: "POST",
        url: "/api/oauth2/update",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            oauth2: oauth2,
            clientid: clientid,
            clientsecret: clientsecret,
        },
        success: function(result) {
            alert(["success", "You have successfully update the OAuth2 information!"]);
            oauth2_refresh();
        }
    });
}