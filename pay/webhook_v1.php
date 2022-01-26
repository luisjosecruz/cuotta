<?php 

require_once("src/bootstrap.php");

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
        echo "I don't think I have what you are looking for ...";
}

// handle method POST
function handlePost ($post, $conn, $token) {
    $json = json_encode($post);

    $cliente = $post['Cliente'];
    $aplicativo = $post['Aplicativo'];

    $idTransaccion = $post['IdTransaccion'];
    $fechaTransaccion = $post['FechaTransaccion'];
    $fechaTrans = date('Y-m-d', strtotime(date($fechaTransaccion)));
    $horaTrans = date('H:i:s', strtotime(date($fechaTransaccion)));
    $nombreAplicativo = $aplicativo['Nombre'];
    $monto = $post['Monto'];
    $mandamiento = $cliente['Mandamiento'];
    $nombre = $cliente['Nombre'];
    $email = $cliente['EMail'];

   if (isAVT($idTransaccion, $token)) {
        $query = "
            INSERT INTO abonos(
                movID, abonoCorr, abonoFecha, abonoHora, abonoSucursal, abonoBruto, mandCorrelativo, abonoUsuario, data
            ) VALUES (
                '101-02', '$idTransaccion', '$fechaTrans', '$horaTrans', '$nombreAplicativo', $monto, '$mandamiento', 'admin1', '$json'
            )
        ";

        // $query = "INSERT INTO abono(json) VALUES ('$json')";

        if ($conn->query($query)) {
            echo "Done!";
        }else{
            echo "Error! ". $query;
        }

        mysqli_close($conn);
    } else {
        echo "Something is wrong (Invalid Transacction)";
    }
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
            "authorization: Bearer " . $token,
            "content-type: application/json"
        )
    ));

    $response = curl_exec($curl);
    $data = json_decode($response, true);
    $result = $data['resultadoTransaccion'];
    $err = curl_error($curl);
    curl_close($curl);

    return ($result === 'ExitosaAprobada') ? true : false;
}

// handle method GET
function getData ($conn) {
    $query = "SELECT * FROM abonos ORDER BY abonoID DESC";

    if($result = $conn->query($query)){
        while($row = mysqli_fetch_array($result)){
            echo $row['abonoID']." - ".$row['abonoCorr']." - ".$row['abonoTStamp']." \n ".$row['data']."\n\n";
        }
    }else{
        echo "Error! ". $query;
    }
}

?>