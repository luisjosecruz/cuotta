const route = $("#route");
let access_token = undefined;

// get access token
$.ajax({
    type: "POST",
    url: "src/get_token.php",
    success: (response) => {
        access_token = response;
    }
});

// reload if access token is empty
setTimeout(() => {
    if (access_token === undefined) {
        $.ajax({ type: "POST", url: "src/get_token.php", success: (response) => access_token = response});
    }
    console.log(access_token);
}, 2000);

// load info to pay
$.ajax({
    type: "POST",
    url: "src/ajax_interface.php",
    data: { requestType : "get-info-to-pay", route : route.val() },
    success: (response) => {
        showInfo(JSON.parse(response));
        console.dir(JSON.parse(response));
    }
});

function showInfo(json) {
    $(".mandamiento").text(json.mandCorrelativo);
    $(".info-casa").text(json.comNombre);
    setTimeout(() => $(".info-cliente span").text(json.contNombre + " " + json.contApellido), 100);
    setTimeout(() => $(".info-direccion span").text(json.propDireccion1), 150);
    setTimeout(() => $(".fecha-pago span").text(json.mandFechaFin), 200);
    setTimeout(() => $(".monto-total").text('$'+json.mandSaldoFinal), 250);

    $('.loader').fadeOut();
}

setTimeout(() => {
    if ($(".info-cliente span").text() === " . . . ") location.reload();
}, 5500);

