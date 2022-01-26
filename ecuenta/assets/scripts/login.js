$("#login-form").submit((e) => {
    e.preventDefault();
    
    let username = $("#username").val();
    let password = $("#password").val();
    let server = $("#server").val();

    
    if (username.trim().length <= 0 && password.trim().length <= 0) {
        console.log("Ingresa el usuario y contraseña");
        return false;
    }

    if (username.trim().length <= 0) {
        console.log('Ingresa el usuario');
        return false;
    }
    
    if (password.trim().length <= 0) {
        console.log('Ingresa la contraseña');
        return false;
    }

    let data = { username: username, password: password, server: server};

    $.ajax({
        type: "POST",
        url: "../src/ajax.php",
        data: {
            'action': 'login',
            'data': data
        },
        success: (data) => {
            console.log(data);
            window.location.href = '/ecuenta';
        }
    });

});

$("#logout").click((e) => {
    $.ajax({
        type: "POST",
        url: "../src/ajax.php",
        data: {'action': 'logout'},
        success: (data) => {
            console.log(data);
            window.location.href = '/ecuenta';
        }
    });
});