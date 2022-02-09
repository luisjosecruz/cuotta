<main>
    <section class="container">
        <header class="pay-header">
            <p class="mandamiento"> --- </p>
            <input type="hidden" id="route" value="<?=$route?>">
            <article class="info">
                <div class="info-text">
                    <p class="info-casa"> . . . </p>
                    <p class="info-cliente">Nombre: <span> . . . </span></p>
                    <p class="info-direccion">Dirección: <span> . . . </span></p>
                    <div class="fechas">
                        <p class="fecha-pago">Fecha máxima de pago: <span> . . . </span></p>
                    </div>
                </div>
                <div class="monto">
                    <p class="monto-total">...</p>
                </div>
            </article>
            <article class="img-container">
                <img src="https://developer.cuotta.com/imagenes/pagado.png" alt="Pagado">
            </article>
        </header>

        <div class="secure">

        </div>

        <article class="pay">
            <h6 class="pay-method">Metodo de pago</h6>
            <div class="tab">
                <div class="tab-buttons">
                    <button class="btn btn-tab tab1" tab="card"><span>Pago con tarjeta</span></button>
                    <button style="display:none;" class="btn btn-tab tab2" tab="btc"><span>Pago con bitcoin</span></button>
                </div>
                <p class="line line-left"></p>
                <div class="tab-container">
                    <div class="tab-content panel1">
                        <form id="formPayCard">
                            <div class="form-group">
                                <span>Nombre</span>
                                <input id="card_name" type="text" maxlength="100" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <span>Correo electrónico</span>
                                <input id="card_email" type="text" maxlength="150" autocomplete="off">
                            </div>
                            <div class="form-content">
                                <div class="form-group cliname">
                                    <span>Número de tarjeta</span>
                                    <input id="card_number" type="text" maxlength="22">
                                </div>
                                <div class="form-group cvv">
                                    <span>CVV</span>
                                    <input id="card_cvv" type="tel" maxlength="3">
                                </div>
                            </div>
                            <div class="form-group expiration">
                                <span>Fecha de expiración</span>
                                <div class="expiration-date">
                                    <select name="card_month" id="card_month">
                                        <option value="0" selected disabled>Mes</option>
                                        <option value="1">01 - Enero</option>
                                        <option value="2">02 - Febrero</option>
                                        <option value="3">03 - Marzo</option>
                                        <option value="4">04 - Abril</option>
                                        <option value="5">05 - Mayo</option>
                                        <option value="6">06 - Junio</option>
                                        <option value="7">07 - Julio</option>
                                        <option value="8">08 - Agosto</option>
                                        <option value="9">09 - Septiembre</option>
                                        <option value="10">1 0 - Octubre</option>
                                        <option value="11">1 1 - Noviembre</option>
                                        <option value="12">1 2 - Diciembre</option>
                                    </select>
                                    <select name="card_year" id="card_year">
                                        <option value="0" selected disabled>Año</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn" id="test_transactions">Proceder a pagar</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="tab-content panel2">
                        <form>
                            <div class="form-content">
                                <div class="form-group">
                                    <span>Nombre</span>
                                    <input id="client_name" type="text" autocomplete="off" maxlength="50">                                    
                                </div>
                                <div class="form-group">
                                    <span>Apellido</span>
                                    <input id="client_lastname" type="text" autocomplete="off" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <span>Correo electrónico</span>
                                <input id="client_email" type="text" autocomplete="off" maxlength="150">
                            </div>
                            <div class="form-group">
                                <span>Fecha de nacimiento</span>
                                <div class="expiration-date born-date">
                                    <input id="client_day" type="text" placeholder="Día" autocomplete="off" maxlength="2">
                                    <select name="client_month" id="client_month">
                                        <option value="0" selected disabled>Mes</option>
                                        <option value="1">01 - Enero</option>
                                        <option value="2">02 - Febrero</option>
                                        <option value="3">03 - Marzo</option>
                                        <option value="4">04 - Abril</option>
                                        <option value="5">05 - Mayo</option>
                                        <option value="6">06 - Junio</option>
                                        <option value="7">07 - Julio</option>
                                        <option value="8">08 - Agosto</option>
                                        <option value="9">09 - Septiembre</option>
                                        <option value="10">1 0 - Octubre</option>
                                        <option value="11">1 1 - Noviembre</option>
                                        <option value="12">1 12 - Diciembre</option>
                                    </select>
                                    <input id="client_year" type="text" placeholder="Año" autocomplete="off" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group">
                                <span>Documento de identidad</span>
                                <input id="client_DUI" type="text" maxlength="10">
                            </div>
                            <div class="form-group">
                                <span>Dirección</span>
                                <input id="client_dir" type="text"  autocomplete="off" maxlength="200">
                            </div>
                            <div class="form-content">
                                <div class="form-group">
                                    <span>País</span>
                                    <select name="client_region" id="client_region">
                                        <option value="0" disabled>Seleccionar</option>
                                        <option value="SV" selected>El Salvador</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span>Departamento</span>
                                    <select name="client_territorio" id="client_territorio">
                                        <option value="0" disabled>Seleccionar</option>
                                        <option value="SV-AH">Ahuachapán</option>
                                        <option value="SV-CA">Cabañas</option>
                                        <option value="SV-CH">Chalatenango</option>
                                        <option value="SV-CU">Cuscatlán</option>
                                        <option value="SV-LI">La Libertad</option>
                                        <option value="SV-MO">Morazán</option>
                                        <option value="SV-PA">La Paz</option>
                                        <option value="SV-SA">Santa Ana</option>
                                        <option value="SV-SM">San Miguel</option>
                                        <option value="SV-SO">Sonsonate</option>
                                        <option value="SV-SS" selected>San Salvador</option>
                                        <option value="SV-SV">San Vicente</option>
                                        <option value="SV-UN">La Unión</option>
                                        <option value="SV-US">Usulután</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn" id="payWithBTC">Continuar</button>
                            </div>
                        </form>
                    </div>
                </div> -->
                <a class="xtab">X</a>
            </div>
        </article>
    </section>
</main>