$('.login-btn').click(function (e) {
    e.preventDefault();

    $('.log').addClass('none');
    $('.pass').addClass('none');
    $(`input`).removeClass('error');
    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: 'login/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success (data) {
            if (data.status) {
                document.location.href = 'profile.php';
            } else {
                data.fields.forEach(function (field) {
                    $(`input[name="${field}"]`).addClass('error');
                });
                switch (data.type) {
                    case 1:
                        $('.log').removeClass('none').text(data.message);
                        break;
                    case 2:
                        $('.pass').removeClass('none').text(data.message);
                        break;
                }
            }
        }
    });
});

$('.register-btn').click(function (e) {
    e.preventDefault();

    $('.log').addClass('none');
    $('.pass').addClass('none');
    $('.pass-con').addClass('none');
    $('.nam').addClass('none');
    $('.em').addClass('none');
    $(`input`).removeClass('error');

    let login = $('input[name="login"]').val(),
        email = $('input[name="email"]').val(),
        name = $('input[name="name"]').val(),
        password = $('input[name="password"]').val(),
        password_confirm = $('input[name="password_confirm"]').val();

    let formData = new FormData();
    formData.append('login', login);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);
    formData.append('email', email);
    formData.append('name', name);


    $.ajax({
        url: 'login/signup.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success (data) {
            console.log(data.status);
            console.log(data);
            if (data.status) {
                document.location.href = 'index.php';
            } else {
                data.fields.forEach(function (field) {
                    $(`input[name="${field}"]`).addClass('error');
                });
                switch (data.type) {
                    case 1:
                        $('.log').removeClass('none').text(data.message);
                        break;
                    case 2:
                        $('.pass').removeClass('none').text(data.message);
                        break;
                    case 3:
                        $('.em').removeClass('none').text(data.message);
                        break;
                    case 4:
                        $('.nam').removeClass('none').text(data.message);
                        break;
                    case 5:
                        $('.pass-con').removeClass('none').text(data.message);
                        break;
                }
            }
        }
    });

});
$('.logout').click(function (e) {
    console.log("Logout");
    e.preventDefault();
    $.ajax({
        url: 'login/logout.php',
        type: 'POST',
        dataType: 'json',
        data: {
            text: "some"
        },
        success (data) {
            console.log(data);
            document.location.href = 'index.php';
        }
    });
});
