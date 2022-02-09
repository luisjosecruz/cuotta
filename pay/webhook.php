<?php 
require_once("src/bootstrap.php");
require_once("src/config/token.php");

(new Env())->load();

$token = (new Token())->getToken();

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $_POST = (array) json_decode(file_get_contents('php://input'), true);
        handlePost($_POST, $conn, $token);
        break;
    case 'GET':
        getData($conn);
        break;
    default: 
        echo "Request Method Not Found";
}

// handle method POST
function handlePost ($post, $conn, $token) {
    $json = json_encode($post);

    $cliente = $post['Cliente'];
    $aplicativo = $post['Aplicativo'];

    $idTransaccion = $post['IdTransaccion'];
    $fechaTransaccion = $post['FechaTransaccion'];
    $fechaT = date('Y-m-d', strtotime(date($fechaTransaccion)));
    $horaT = date('H:i:s', strtotime(date($fechaTransaccion)));
    $aplicativoName = $aplicativo['Nombre'];
    $monto = $post['Monto'];
    $mand = $cliente['Mandamiento'];
    $nombre = $cliente['Nombre'];
    $email = $cliente['EMail'];
    $card = substr($post['Tarjeta'], -5);
    $tarjeta = 'Pago con tarjeta (-'.trim($card).')';

    $query = "
        INSERT INTO 
        abonos(movID,abonoCtaID,abonoCorr,abonoFecha,abonoHora,abonoSucursal,abonoRef,abonoBruto,mandCorrelativo,abonoStatus,abonoUsuario,abonoData) 
        VALUES('101-03','101','$idTransaccion','$fechaT','$horaT','$aplicativoName','$tarjeta',$monto,'$mand','pendiente','admin1','$json');
    ";

    if ( $conn->query($query) ) {
        echo "Insert done! ";
    } else {
        echo "Insert error!  ";
    }

    // validate transacction
    if ( isAVT($idTransaccion, $token) ) {
        $update = " 
            UPDATE abonos SET abonoStatus = 'verificado' 
            WHERE abonoCorr = '$idTransaccion' AND abonoFecha = '$fechaT' AND abonoHora = '$horaT';";

        if ( $conn->query($update) ) {
            echo "Update done! ";
        } else {
            echo "Update error! ";
        }

    } else {
        echo "Invalid Transacction";
    }

    mysqli_close($conn);
}

// Is A Valid Transacction ? 
function isAVT ($idTransaccion, $token) {

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.wompi.sv/TransaccionCompra/" . $idTransaccion,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "content-type: application/json"
        )
    ));

    $response = curl_exec($curl);
    $data = json_decode($response, true);
    $result = $data['resultadoTransaccion'];
    $err = curl_error($curl);
    curl_close($curl);

    return ($result == 'ExitosaAprobada') ? true : false;
}

// handle method GET
function getData ($conn) {
    $query = "SELECT * FROM abonos ORDER BY abonoID DESC";

    if( $result = $conn->query($query) ) {
        while( $row = mysqli_fetch_array($result) ){
            echo $row['abonoID']." - ".$row['abonoCorr']." - ".$row['abonoTStamp']." \n ".$row['abonoData']."\n\n";
        }
    } else {
        echo "Error! ". $query;
    }
}

// return "Test - ".$result." - ".$data." - ".$response." - ".$idTransaccion." - ".$token;

?>