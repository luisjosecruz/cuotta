<?php 

// validate method
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $requestType = $_POST['requestType'];
} else {
    die("Something is wrong: The request method isn't post"); 
}

// handle request
switch ($requestType) {
    case 'get-info-to-pay':
        require_once("dao/mandamientos.php");
        $data = $_POST;
        $mand_obj = new Mandamientos();
        echo getInfoPay($data, $mand_obj);

        break;
    case '':


        break;
    default:
        # code...
        break;
}

function getInfoPay($data, $mand_obj) {
    require_once("bootstrap.php");
    $response = $mand_obj->getInfoPay($data, $conn);
    return $response;
}
?>