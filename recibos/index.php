<?php

// get database connection
require_once("config/pdo.php");

// get request uri
$uri = $_SERVER['REQUEST_URI'];

// divide uri
$uri_parts = explode('/', $uri);
array_shift($uri_parts);

// get route
$route = (isset($uri_parts[1])) ? $uri_parts[1] : "";

// get url server
$URLSERVER = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/$uri_parts[0]/";
$URLORIGIN = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

if ($route != "") {
    
    require_once('src/functionsdb.php');
    require_once('src/phpqrcode/qrlib.php');
    
    // generación de la imagen del código qr
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrimages'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'qrimages/';
    $filename = $PNG_TEMP_DIR.'ljcm.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 4;
    
    $link = getData($pdo, $route);
    $response = $link->fetchAll(PDO::FETCH_OBJ);
    $reciboLink = "";
    if($link->rowCount() > 0){
        foreach($response as $row) {
            $textToQRCode = $_SERVER['HTTP_HOST']."/recibos/".$row->reciboLink;
            $reciboLink = $row->reciboLink;
        }
    }
    
    // $filename = $PNG_TEMP_DIR.'ljcm'.md5($textToQRCode.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    $filename = $PNG_TEMP_DIR.'ljcm'.$reciboLink.'.png';
    QRcode::png($textToQRCode, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
    
    if ($uri_parts[1] == "download") {
            require_once('downloadRecibo.php');
    } else {
        require_once('routes/recibo.php');
    }

} else {
    echo 'Error 404 | Not Found';
}

