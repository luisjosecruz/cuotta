// agregar espacios en cada cantidad de caracteres espeficicado.
function space(element, character = '-', after = 4, e) {
    if (e.keyCode != "8") {
        let v = element.value.replace(/[^\d0-9]/g, ''),
        reg = new RegExp(".{" + after + "}","g")
        element.value = v.replace(reg, function (a, b, c) {
            return a + character;
        });
    }
}

// show modal
function createModal(type = 'default', title = "Test", content = "...", reload = false) {
    $(".modal").toggleClass("show-modal");
    $(".modal-title").text(title);
    $(".modal-items").html(content);

    if ( reload === true ) {
        $(".modal-btn-close").attr("reload", "true");
    }
}

function validateCard() {
    let regex1 = new RegExp("^[0-9]{14,18}$");
    let regex2 = new RegExp("^[0-9]{1,2}$");
    let regex3 = new RegExp("^[0-9]{4}$");
    let regex4 = new RegExp("^[0-9]{3,4}$");
    let emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    let number = document.getElementById("card_number").value;
    let mes = document.getElementById("card_month").value;
    let anio = document.getElementById("card_year").value;
    let name = document.getElementById("card_name").value;
    let email = document.getElementById("card_email").value;
    let cvv = document.getElementById("card_cvv").value;
    let html = ``;

    if (number.length === 0 || mes.length === 0 || anio.length === 0 || name.length === 0 || cvv.length === 0 || email.length === 0) {
        let card = (number.length === 0) ? 'color-error': 'color-success';
        let date = (mes == 0 || anio == 0) ? 'color-error': 'color-success';
        let nam = (name.length === 0) ? 'color-error': 'color-success';
        let cv = (cvv.length === 0) ? 'color-error': 'color-success';
        let em = undefined;
        let dataEmail = undefined;

        if (email.length === 0) {
            em = 'color-error';
            dataEmail = `<li class="${em}">Correo electrónico</li>`;
        } else {
            if (emailRegex.test(email)) {
                em = 'color-success';
                dataEmail = `<li class="${em}">Correo electrónico</li>`;
            } else {
                em = 'color-error';
                dataEmail = `<li class="${em}">Correo electrónico incorrecto</li>`; ;
            }
        }
        
        card = (number.length < 16) ? 'color-error': 'color-success';

        html +=`<li class="${nam}">Nombre</li>
                ${dataEmail}
                <li class="${date}">Fecha de expiración</li>
                <li class="${card} card">Número de tarjeta</li>
                <li class="${cv}">CVV</li>`;

        createModal("Error", "Datos Requeridos", html);
        
        return false;
    }

    // quitar espacios a los números de la tarjeta
    number = number.replace(/\D/g, '');
    
    if (regex1.test(number)) {
        if(luhnCheck(number) == 0) { 
            createModal("Error", "Datos Requeridos", "<li class='color-error'>Número de tarjeta incorrecto</li>");
            return false;
        } else {
            if (mes.length > 0 &&  anio.length > 0 && regex2.test(mes) && regex3.test(anio) ) { 
                if ( (mes >= 1) && (mes <= 12) && (anio >= 2022)) {
                    if (cvv.length > 0 && regex4.test(cvv) ) { 
                        if ((cvv >= 100)) {
                            createModal("Default", "Procesando información de pago", "<img src='assets/images/icons/loadhouse.gif'>");
                            return true;
                        } else {
                            createModal("Error", "Datos Requeridos", "<li class='color-error'>CVV Incorrecto</li>");
                            return false;
                        }
                    }
                } else {
                    createModal("Error", "Datos Requeridos", "<li class='color-error'>Fecha Incorrecta</li>");
                    return false;
                }
            }
        } 
    } else { 
        createModal("Error", "Datos Requeridos", "<li class='color-error'>Número de tarjeta incorrecto</li>");
        return false;
    }
}

// validar el número de tarjeta
function luhnCheck(val) {
    var sum = 0;
    for (var i = 0; i < val.length; i++) {
        var intVal = parseInt(val.substr(i, 1));
        if (i % 2 == 0) {
            intVal *= 2;
            if (intVal > 9) {
                intVal = 1 + (intVal % 10);
            }
        }
        sum += intVal;
    }
    return (sum % 10) == 0;
}


// pago con tarjeta
function payCardUSD () {
    let fecha = new Date();
    let options = { year: 'numeric', month: 'long', day: 'numeric' };
    let date = fecha.toLocaleDateString("es-ES", options);

    let card = $("#card_number").val().trim();
    let card_number = card.replace(/\D/g, '');
    let card_cvv = $("#card_cvv").val().trim();
    let card_month = $("#card_month").val().trim();
    let card_year = $("#card_year").val().trim();
    let monto = parseFloat($(".monto-total").text().replace('$', ''));
    // monto = 3;
    let card_name = $("#card_name").val().trim();
    let card_email = $("#card_email").val().trim();
    let mandamiento = $(".mandamiento").text().trim();

    let data = {
        "tarjetaCreditoDebido": {
            "numeroTarjeta": card_number,
            "cvv": card_cvv,
            "mesVencimiento": card_month,
            "anioVencimiento": card_year
        },
        "monto": monto,
        "emailCliente": card_email,
        "nombreCliente": card_name,
        "formaPago": "PagoNormal",
        "configuracion": {
            "emailsNotificacion": "luisjosecruzmart@gmail.com",
            "urlWebhook": "https://developer.cuotta.com/pay/webhook.php",
            "notificarTransaccionCliente": false
        },
        "datosAdicionales": {
            "Mandamiento" : mandamiento,
            "fecha": date
        }
    };

    $.ajax({
        type: "POST",
        url: "src/transactions.php",
        data: data,
        success: (response) => {
            console.dir(JSON.parse(response));
            let data = JSON.parse(response)
            createModal();
            if (data.esAprobada === true) {
                let html = `<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>`;
                createModal("Default", "Pago exitoso", html, true);
            } else {
                createModal("Default", "Error al procesar pago", "<img src='assets/images/icons/warning.gif'>", true);
            }   
        }
    });
}

function validateBTC() {
    let regex1 = new RegExp("^[0-9]{14,18}$");
    let regex2 = new RegExp("^[0-9]{1,2}$");
    let regex3 = new RegExp("^[0-9]{4}$");
    let regex4 = new RegExp("^[0-9]{3,4}$");
    let emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    let client_name = $("#client_name").val();
    let client_lastname = $("#client_lastname").val();
    let client_email = $("#client_email").val();
    let client_day = $("#client_day").val();
    let client_month = $("#client_month").val();
    let client_year = $("#client_year").val();
    let client_DUI = $("#client_DUI").val();
    let client_dir = $("#client_dir").val();
    let client_region = $("#client_region").val();
    let client_territorio = $("#client_territorio").val();

    let html = ``;

    if (client_name.length === 0 || client_lastname.length === 0 || client_email.length === 0 || client_day.length === 0 || 
        client_month === null || client_year.length === 0 || client_DUI.length === 0 || client_dir.length === 0 ||
        client_region === null || client_territorio === null ) 
    {
        let name = (client_name.length === 0) ? 'color-error': 'color-success';
        let last = (client_lastname.length === 0) ? 'color-error': 'color-success';
        let dat = (client_day.length === 0 || client_month === null || client_year.length < 4) ? 'color-error': 'color-success';
        let dui = (client_DUI.length < 10) ? 'color-error': 'color-success';
        let dir = (client_dir.length === 0) ? 'color-error': 'color-success';
        let reg = (client_region === null) ? 'color-error': 'color-success';
        let ter = (client_territorio === null) ? 'color-error': 'color-success';
        
        let em = undefined;
        let dataEmail = undefined;

        if (client_email.length === 0) {
            em = 'color-error';
            dataEmail = `<li class="${em}">Correo electrónico</li>`;
        } else {
            if (emailRegex.test(client_email)) {
                em = 'color-success';
                dataEmail = `<li class="${em}">Correo electrónico</li>`;
            } else {
                em = 'color-error';
                dataEmail = `<li class="${em}">Correo electrónico incorrecto</li>`; ;
            }
        }

        html +=`<li class="${name}">Nombre</li>
                <li class="${last}">Apellido</li>
                ${dataEmail}
                <li class="${dat}">Fecha de nacimiento</li>
                <li class="${dui}">Documento de identidad</li>
                <li class="${dir}">Dirección</li>
                <li class="${reg}">Región</li>
                <li class="${ter}">Territorio</li>`;

        createModal("Error", "Datos Requeridos", html);
        
        return false;
    }

    if ( (client_month >= 1) && (client_month <= 12) ) { 
        if ( regex3.test(client_year) && client_year < 2015) { 
            createModal("Default", "Procesando información de pago", "<img src='assets/images/icons/loadhouse.gif'>");
            return true;
        } else {
            createModal("Error", "Datos Requeridos", "<li class='color-error'>Año de nacimiento incorrecto</li>");
            return false;
        }
    } else {
        createModal("Error", "Datos Requeridos", "<li class='color-error'>Mes de nacimiento incorrecto</li>");
        return false;
    }
}

// pago con bitcoin
function payWithBTC () {
    let fecha = new Date();
    let options = { year: 'numeric', month: 'long', day: 'numeric' };
    let date = fecha.toLocaleDateString("es-ES", options);

    let client_name = $("#client_name").val().trim();
    let client_lastname = $("#client_lastname").val().trim();
    let client_email = $("#client_email").val().trim();
    let client_DUI = $("#client_DUI").val().trim();
    let client_dir = $("#client_dir").val().trim();
    let client_region = $("#client_region").val().trim();
    let client_territorio = $("#client_territorio").val().trim();

    let client_day = $("#client_day").val().trim();
    let client_month = $("#client_month").val().trim();
    let client_year = $("#client_year").val().trim();

    client_DUI = client_DUI.replace("-", "");
    client_day = (parseInt(client_day) < 10) ? '0' + parseInt(client_day) : parseInt(client_day);
    client_month = (parseInt(client_month) < 10) ? '0' + parseInt(client_month) : parseInt(client_month);

    let nacimiento = `${client_year}-${client_month}-${client_day} 00:00:00`;

    let mandamiento = $(".mandamiento").text().trim();
    let monto = parseFloat($(".monto-total").text().replace('$', ''));

    // monto = 5;

    let data = {
        "monto": monto,
        "emailCliente": client_email,
        "nombreCliente": client_name,
        "apellidoCliente": client_lastname,
        "fechaNacimientoCliente": nacimiento,
        "documentoIdentidadCliente": client_DUI,
        "direccionCliente": client_dir,
        "idRegion": client_region,
        "idTerritorio": client_territorio,
        "configuracion": {
            "emailsNotificacion": "luisjosecruzmart@gmail.com",
            "urlWebhook": "https://developer.cuotta.com/pay/webhook.php",
            "telefonosNotificacion": "61760155",
            "notificarTransaccionCliente": false
        },
        "datosAdicionales": {
            "Mandamiento" : mandamiento,
            "fecha": date
        }
    };

    $.ajax({
        type: "POST",
        url: "src/transactions_btc.php",
        data: data,
        success: (response) => {
            console.dir(JSON.parse(response));
            let data = JSON.parse(response);
            let datosBitcoin = data["datosBitcoin"];
            let qr = datosBitcoin["urlQR"];
            html =`<img src='${qr}' width="300px">`;
            createModal();
            createModal("Success", "Escanea el código QR con tu wallet", html, true);
        }
    });
}

$(document).ready(function() {

    const formPayCard = $("#formPayCard");
    const cardNumber = $("#card_number");
    const cardCVV = $("#card_cvv");
    const modalBtnClose = $(".modal-btn-close");
    const duiNumber = $("#client_DUI");
    const dayNumber = $("#client_day");
    const yearNumber = $("#client_year");

    // validar espacios cada 4 números de la tarjeta
    cardNumber.keyup(function(e) { space(this, '  ', 4, e) });

    // enviar datos del pago con tarjeta
    formPayCard.submit(e => {
        e.preventDefault(); 
        if (validateCard()) {
            
            setTimeout(() => payCardUSD(), 1500);
            
        }
    });
    
    // validar solo números
    cardCVV.keyup(function(){ $(this).val($(this).val().replace(/[^0-9]/g, '')) });
    dayNumber.keyup(function(){ $(this).val($(this).val().replace(/[^0-9]/g, '')) });
    yearNumber.keyup(function(){ $(this).val($(this).val().replace(/[^0-9]/g, '')) });
    
    // modal close btn
    modalBtnClose.click(function() {
        let reload = $(this).attr("reload");
        if (reload == "true") location.reload(); 
        $(".modal").removeClass("show-modal");
    });

    // validar el dui con el guión
    duiNumber.keyup(function(e) { space(this, '-', 8, e) });

    $("#payWithBTC").click((e) => {
        e.preventDefault(); 
        if (validateBTC()) {

            console.log("Everything is ok");
            setTimeout(() => payWithBTC(), 1500);            
        }
    });
});
