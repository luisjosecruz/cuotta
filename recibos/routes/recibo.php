<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
    <script>
    window.googletag = window.googletag || {cmd: []};
    googletag.cmd.push(function() {
        googletag.defineSlot('/12206962/dem_rect1', [[320, 100], [320, 50]], 'div-gpt-ad-1641416523864-0').addService(googletag.pubads());
        googletag.defineSlot('/12206962/dem_rect3', [[320, 100], [320, 50], [300, 600], [300, 250]], 'div-gpt-ad-1642027276963-0').addService(googletag.pubads());
        googletag.pubads().enableSingleRequest();
        googletag.enableServices();
    });
    </script>
</head>
<body>
    <header>
        <div class="header-img">
            <img class="logo-cuotta" src="<?=$URLSERVER?>assets/images/logo-cuotta.png" alt="logo-cuotta">
        </div>
        <h1 class="header-title">Recibos</h1>
    </header>
    <div class="container">
        <aside>
            <div class="aside-content">
                <p class="text-mobile">Puede imprimir una copia del recibo.</p>
                <p class="text-desktop">Puede imprimir o descargar una copia(PDF) del recibo.</p>
                <div class="btns">
                    <?php 
                        $randomText = "";
                        $datos = getData($pdo, $route);
                        $resultado = $datos->fetchAll(PDO::FETCH_OBJ);
                        if($datos->rowCount() > 0){
                            foreach($resultado as $row){
                                $randomText = $row->reciboLink;
                            }
                        }
                    ?>
                    <a href="#" class="download-cert btn" onclick="printing();">Imprimir</a>
                    <a href="<?=$URLSERVER?>download/<?=$randomText?>" class="download-cert btn text-desktop">Descargar</a>
                </div>
            </div>
        </aside>
        <div class="content">
            <div id="first"></div>
            <div class="bloques">
                <div class="b1">
                    <div class="ticket">
                        <div class="ticket-head">
                            <table width="100%" class="ticket-table">
                                <tr>
                                    <td width="20%">
                                        <img class="logo-tt" src="<?=$URLSERVER?>assets/images/logo-tt.svg" alt="logo-tt">
                                    </td>
                                    <td width="40%">
                                        <img class="logo-cuotta" src="<?=$URLSERVER?>assets/images/logo-cuotta.svg" alt="logo-cuotta"> 
                                    </td>
                                    <td width="40%" rowspan="2" class="align-right">
                                        <?php 
                                            $imagenRes = "";
                                            $comunidadNombre = "";
                                            $queryLogo = getLogo($pdo, $route);
                                            $resultLogo = $queryLogo->fetchAll(PDO::FETCH_OBJ);
                                            if ($queryLogo->rowCount() > 0) {
                                                foreach($resultLogo as $logo) {
                                                    $imagenRes = $logo->comLogo;
                                                    $comunidadNombre = $logo->comNombre;
                                                }
                                            }
                                            $imagenRes = ($imagenRes == "") ? "/imagenes/logos/default.jpg" : $imagenRes;
                                        ?>
                                        <!-- <img class="logo-poligono" src="<?=$URLSERVER?>assets/images/asturias.jpg" alt="logo-asturias"> -->
                                        <img class="logo-cuotta logoRes" src="<?=$URLORIGIN.$imagenRes?>" alt="logo-comunidad"> 
                                    </td>
                                </tr>
                                <tr class="tr-head">
                                    <td colspan="2">
                                        <p class="text-bold ">RECIBO A CUENTA DE: </p>
                                        <p class="text-general residencial">
                                            ASOCIACIÓN DE VECINOS DEL RESIDENCIAL 
                                            <?=$comunidadNombre?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="ticket-body">
                            <?php 
                                // $route = "3d04cca0"; // 949d8b16
                                $query = getData($pdo, $route);
                                $result = $query->fetchAll(PDO::FETCH_OBJ);

                                if($query->rowCount() > 0){
                                    foreach($result as $r){
                                        $ref = $r->abonoRef;
                            ?>
                                <table width="100%" class="ticket-table">
                                    <tr>
                                        <td class="text-bold"></td>
                                        <td class="text-general"></td>
                                        <td width="40%" rowspan="3" class="align-right">
                                            <table class="table-monto">
                                                <tr><th>MONTO</th></tr>
                                                <tr><td>$ <?=$r->reciboMonto?></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="text-bold nopad">RECIBO: </td>
                                        <td width="40%" class="text-general nopad"><?=$r->reciboNumero?></td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="text-bold nopad">SERIE: </td>                           
                                        <td class="text-general nopad"><?=$r->reciboSerie?></td>
                                    </tr>
                                    <tr><td class="text-bold"></td><td class="text-general"></td></tr>
                                    <tr><td class="text-bold"></td><td class="text-general"></td></tr>
                                    <tr>
                                        <td class="text-bold">NOMBRE: </td>
                                        <td class="text-general" colspan="2"><?=$r->contNombre?> <?=$r->contApellido?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">CASA: </td>
                                        <td class="text-general"><?=$r->propAlias?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">DIRECCIÓN: </td>
                                        <td class="text-general" colspan="2"><?=$r->propDireccion1?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">FECHA: </td>
                                        <td class="text-general"><?=$r->reciboFecha?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">REFERENCIA: </td>
                                        <td class="text-general" colspan="2"><?=$ref?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <img class="contact" src="<?=$URLSERVER?>/assets/images/contactos.jpg" alt="logo-contact">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="qrcode" src="<?=$PNG_WEB_DIR.basename($filename)?>" alt="qrcode"> 
                                        </td>
                                        <td colspan="2" class="text-general text-foot">
                                            <p class="text-desktop">
                                                Puede validar los datos de este Recibo escaneando el código
                                                QR o visitanto <strong><?=$_SERVER['HTTP_HOST']?>/recibos/<?=$r->reciboLink?></strong>
                                            </p>
                                            <p class="text-mobile">
                                                Puede validar los datos <br> de este Recibo escaneando <br> el código
                                                QR o visitanto <strong><?=$_SERVER['HTTP_HOST']?>/<br>recibos/<?=$r->reciboLink?></strong>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                <div class="recibo-footer">
                                    <p>Fecha del registro: <?=$r->abonoTStamp?></p>
                                    <p>Cuotta © 2021</p>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="b2">
                    <div class="bloque">
                        <!-- Rectangular /12206962/dem_rect1 -->
                        <div id='div-gpt-ad-1641416523864-0' style='min-width: 300px; min-height: 50px;'>
                            <script>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1641416523864-0'); });</script>
                        </div>
                        <!-- /12206962/dem_rect3 -->
                        <div id='div-gpt-ad-1642027276963-0' style='min-width: 300px; min-height: 50px;'>
                            <script>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1642027276963-0'); });</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="elements">
		<!-- <a href="<?=$URLSERVER?>download/<?=$randomText?>" class="download-cert btn">Descargar</a> -->
	</div>
</body>
</html>

<script>

function printing(){
    window.print();
}

let dem_rect1 = document.getElementById("div-gpt-ad-1641416523864-0");
let first = document.getElementById("first");

if (window.screen.width <= 1024) {
    dem_rect1.remove();
    first.innerHTML += "<div id='div-gpt-ad-1641416523864-0' style='min-width: 300px; min-height: 50px;'><script>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1641416523864-0'); });</div>";
} else {
    first.remove();
}

</script>