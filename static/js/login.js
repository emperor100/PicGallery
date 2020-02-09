$(document).ready(function () {
    $('#registration_form').submit(function() {
        var url = "/photogallery/login/register_user";
        var data = $('#registration_form').serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: registration_success
        });
        return false;
    });

    $('#loginform').submit(function() {
        var url = "/photogallery/login/login_authenticate";
        var data = $('#loginform').serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: login_success
        });
        return false;
    });
});

var registration_success = function (response) {
    response = JSON.parse(response);

    if (response.success) {
		alert(response.message);
        window.location.href = "/photogallery/login";
    } else {
        alert(response.message);
    }
};

var login_success = function (response) {
    response = JSON.parse(response);
    if (response.success) {
		 window.location.href = "/photogallery/home";
    } else {
        alert(response.message);
    }
};


