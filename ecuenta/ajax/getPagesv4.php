<?php 

require_once "../config/pdo.php";

// validar que sean datos por medio del método POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $community = intval($_POST['community']);
    $month = (isset($_POST['month'])) ? intval($_POST['month']) : 0;
    $background = (isset($_POST['background'])) ? intval($_POST['background']) : 1;
    $URLSERVER = $_POST['urlserver'];
    $URLORIGIN = $_POST['urlorigin'];
}else{
    return false;
}

$data_month = ($month == 0) ? "" : "AND MONTH(mand.mandFechaFin) = $month";

// -------------------------------------------------------------------------------------------------------
// EDIT THIS: your auth parameters
$username = 'lcruz';
$password = 'soporte247';

// EDIT THIS: the query parameters
//$url     = 'http://planetozh.com/blog/';    // URL to shrink
$keyword = 'xyz12';                         // optional keyword
$title   = '-----';                         // optional, if omitted YOURLS will lookup title with an HTTP request
$format  = 'json';                          // output format: 'json', 'xml' or 'simple'
// EDIT THIS: the URL of the API file
$api_url = 'https://ctta.link/yourls-api.php';
// -------------------------------------------------------------------------------------------------------

$html = '';

$bg = ($background == 1) ? "background:#f5f5f5 url('".$URLSERVER."assets/images/FEB2022v.A.jpg') no-repeat center;background-size:cover;" : "";
$bg = ($background == 1 && $month == 0) ? "background:#ffffff url('".$URLSERVER."assets/images/bg_user.jpg') no-repeat center;background-size:cover;" : $bg;

$sql = "SELECT p.propID, p.propAlias, p.propShortLnk, com.comID, com.comNombre, cont.contNombre, mand.mandNumero,
            cont.contApellido, p.propDireccion1, mand.mandCorrelativo, mand.mandHash,
            DATE_FORMAT(mand.mandFechaInicio, '%d-%m-%Y') mandFechaInicio, mand.mandFechaInicio mandIni, mand.mandFechaFin mandFin, 
            mand.mandFechaPago, DATE_FORMAT(mand.mandFechaFin, '%d-%m-%Y') mandDateFin, 
            DATE_FORMAT(mand.mandFechaPago, '%d-%m-%Y') mandDatePago, com.comCta1, mand.mandBarras, mand.mandNPE, mand.mandSaldoInicial, 
            mand.mandSaldoFinal
        FROM comunidades com
        INNER JOIN propiedades p ON p.comID = com.comID
        INNER JOIN vinculacion v ON v.vincPropID = p.propID
        INNER JOIN contactos cont ON v.vincContactoID = cont.contID
        INNER JOIN mandamientos mand ON mand.propID = p.propID
        WHERE com.comID = $community
        AND v.vincOrden = 1
        $data_month 
        ORDER BY mand.mandNumero ASC";

$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

// get logo 
$sqlLogo = "SELECT comunidades.comLogo FROM comunidades WHERE comunidades.comID = $community";

$imagenRes = "";

$queryLogo = $pdo->prepare($sqlLogo);
$queryLogo->execute();
$resultLogo = $queryLogo->fetchAll(PDO::FETCH_OBJ);
if ($queryLogo->rowCount() > 0) {
    foreach($resultLogo as $logo) {
        $imagenRes = $logo->comLogo;
    }
}

$imagenRes = ($imagenRes == "") ? "/imagenes/logos/default.jpg" : $imagenRes;

if($query->rowCount() > 0){
    $counter = 0;
    foreach($result as $r){
        //-------------------------------------------------------------------------------------------------------
        // $url     = 'https://developer.cuotta.com/pay/'.$r->mandHash;
        $url     = 'https://arfaf.click/'.$r->propShortLnk;
        $url_arfaf = 'https://arfaf.click/'.$r->propShortLnk;
        $url_arfaf_show = 'www.arfaf.click/'.$r->propShortLnk;
        // Init the CURL session
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $api_url );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
        curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
                'url'      => $url,
                /*'keyword'  => $keyword,
                'title'    => $title,*/
                'format'   => $format,
                'action'   => 'shorturl',
                'username' => $username,
                'password' => $password
            ) );
        // Fetch and return content
        $data = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($data);
        $link = $data->shorturl;
        //-------------------------------------------------------------------------------------------------------

        if($counter % 2 == 0){
            $html .= '<article class="page" id="print" style="'.$bg.'">';
        }

        // saldo anterior validación
        if ($r->mandSaldoInicial < 0) {
            $saldoMas = "$ ".$r->mandSaldoInicial;
            $saldoMenos = "";
        } else {
            $saldoMenos = "$ ".$r->mandSaldoInicial;
            $saldoMas = "";
        }

        // if ($saldoMas != "") {
        //     $saldoMas = ($saldoMas < 0) ? "$ 0.00" : $saldoMenos;
        // }

        // if ($saldoMenos != "") {
        //     $saldoMenos = ($saldoMenos < 0) ? "$ 0.00" : $saldoMenos;
        // }

        $html .= '
                <input type="hidden" value="'.$url_arfaf.'" class="data_qrcode'.$counter.'">
                <!-- input type="hidden" value="'.$link.'" class="data_qrcode'.$counter.'" -->
                <div class="page__parts">
                    <h1 class="account"><!--div id="qcode'.$counter.'" class="codes"></div--></h1>
                    <h1 class="account logo-residencial"><div class="codes"><img src="'.$URLORIGIN.$imagenRes.'"></div></h1>
                    <h2 class="correlative">'.$r->mandCorrelativo.'</h2>
                    <h3 class="community">RESIDENCIAL '.$r->comNombre.'</h3>
                    <h4 class="fullname">'.$r->contNombre.' '.$r->contApellido.'</h4>
                    <h3 class="alias">'.$r->propAlias.'</h3>
                    <h4 class="direction">'.$r->propDireccion1.'</h4>

                    <h5 class="cutdate">'.$r->mandDateFin.'</h5>
                    <h5 class="lastdate">'.$r->mandDatePago.'</h5>

                    <div class="table-transactions">
                        <table>
                            <tr>
                                <td>'.$r->mandFechaInicio.'</td>
                                <td>SALDO ANTERIOR</td>
                                <td>'.$saldoMenos.'</td>
                                <td>'.$saldoMas.'</td>
                            </tr>';

                                $sql_2 = "SELECT transDesc, transMonto, DATE_FORMAT(transacciones.transFecha, '%d-%m-%Y') FechaOperacion
                                        FROM transacciones
                                        WHERE transacciones.propID = '".$r->propID."' 
                                        AND transacciones.transFecha BETWEEN '".$r->mandIni."' AND '".$r->mandFin."'
                                        ORDER BY transacciones.transFecha ASC
                                        ";
                                $query_2 = $pdo->prepare($sql_2);
                                $query_2->execute();
                                $result_2 = $query_2->fetchAll(PDO::FETCH_OBJ);
                                if($query_2->rowCount() > 0){
                                    foreach($result_2 as $r_2){

                                        if ($r_2->transMonto < 0) {
                                            $abono = "$ ".$r_2->transMonto;
                                            $cargo = "";
                                        } else {
                                            $cargo = "$ ".$r_2->transMonto;
                                            $abono = "";
                                        }

                                        $html .= '<tr>';
                                            $html .= '<td width="17%">'.$r_2->FechaOperacion.'</td>';
                                            $html .= '<td width="52%">'.$r_2->transDesc.'</td>';
                                            $html .= '<td width="16%">'.$cargo.'</td>';
                                            $html .= '<td width="15%">'.$abono.'</td>';
                                        $html .= '</tr>';
                                    }
                                }
                                $saldoFinal = ($r->mandSaldoFinal < 0 ) ? "0.00" : $r->mandSaldoFinal;
                        $html.='
                        </table>
                    </div>
                    <div class="table-total">
                        <table>
                            <tr>
                                <td><span class="bold-total invisible">---- -- -- ---- --</span></td>
                                <td><strong class="bold-total invisible">A CANCELAR</strong></td>
                                <td><strong class="bold-total">$ '.$saldoFinal.'</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="footer">
                        <h1 class="qr-space">
                            <div id="qcode'.$counter.'" class="codes"></div>
                        </h1>
                        <p class="qr_data">'.$url_arfaf_show.'</p>
                    </div>

                    <!--h6 class="npe"><span>NPE</span> '.$r->mandNPE.'</h6-->
                    <!--h6 class="barcode"><img src="/ecuenta/barcode/'.$r->mandBarras.'"></h6-->
                    <!--h6 class="barcode_number">'.$r->mandBarras.'</h6-->
                    <p></p>
                </div>
        ';
        if($counter % 2 != 0){
            $html .= '</article>';
        }
        $counter++;
    }
}else{
    $html = "empty";
}

echo $html;
 
?>