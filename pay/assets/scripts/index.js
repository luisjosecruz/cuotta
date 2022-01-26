


// let show_data = $("#result");


/*

$('#payment_link').click(() => {
    $.ajax({
        type: "POST",
        url: "src/payment_link.php",
        data: {"access_token": access_token} ,
        success: (response) => {
            showPaidLinks(response);
        }
    });
});

const showPaidLinks = json => {
    show_data.html(json);
}
*/
/*
// test transactions
$("#test_transactions").click((e) => {
    e.preventDefault();

    let fecha = new Date();
    let options = { year: 'numeric', month: 'long', day: 'numeric' };
    let date = fecha.toLocaleDateString("es-ES", options);

    let data = {
        "tarjetaCreditoDebido": {
            "numeroTarjeta": $("#card_number").val(),
            "cvv": $("#card_cvv").val(),
            "mesVencimiento": $("#card_month").val(),
            "anioVencimiento": $("#card_year").val()
        },
        "monto": 5,
        "emailCliente": 'lcruz@elmundo.sv',
        "nombreCliente": 'Luis Cruz',
        "formaPago": "PagoNormal",
        "configuracion": {
            "emailsNotificacion": "luisjosecruzmart@gmail.com",
            "urlWebhook": "https://developer.cuotta.com/wompi/webhook.php",
            "notificarTransaccionCliente": true
        },
        "datosAdicionales": {
            "Test": "Test 01",
            "fecha": date
        },
        "access_token": access_token
    };

    $.ajax({
        type: "POST",
        url: "src/transactions.php",
        data: data ,
        success: (response) => {
            console.log(response);
            console.dir(JSON.parse(response));
        }
    });
});

$("#payWithBTC").click((e) => {
    e.preventDefault();

    let monto = parseFloat($(".monto-total").text().replace('$', ''));

    let data = {
        "monto": 5,
        "emailCliente": $("#client_email").val(),
        "nombreCliente": $("#client_name").val(),
        "apellidoCliente": $("#client_lastname").val(),
        "fechaNacimientoCliente": "1974-07-25 12:18:00",
        "documentoIdentidadCliente": $("#client_DUI").val(),
        "direccionCliente": $("#client_dir").val(),
        "idRegion": $("#client_region").val(),
        "idTerritorio": $("#client_territorio").val(),
        "configuracion": {
            "emailsNotificacion": "luisjosecruzmart@gmail.com",
            "urlWebhook": "https://developer.cuotta.com/wompi/webhook.php",
            "telefonosNotificacion": "61760155",
            "notificarTransaccionCliente": true
        },
        "access_token": access_token
    };

    $.ajax({
        type: "POST",
        url: "src/transactions_btc.php",
        data: data ,
        success: (response) => {
            //showPaidLinks(response);
            console.log(response);
            console.dir(JSON.parse(response));
            let data = JSON.parse(response);
            let datos = data["datosBitcoin"];
            let qr = datos["urlQR"];
            html =`<img src='${qr}' width="300px">`;
            
            createModal("Success", "BTC PAY", html);
        }
    });
});*/