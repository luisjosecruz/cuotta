<?php

require_once '../src/controller/Cognito.php';
use Cuotta\Src\Controller\CognitoController\CognitoAWS;

// get database connection
require_once "config/pdo.php";

// get request uri
$uri = $_SERVER['REQUEST_URI'];

// divide uri
$uri_parts = explode('/', $uri);
array_shift($uri_parts);

// get route
$route = $uri_parts[1];

// url server
$URLSERVER = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/$uri_parts[0]/";
$URLORIGIN = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

session_start();

switch($route){
    case 'printv3':
        $fact = (isset($uri_parts[2])) ? $uri_parts[2] : "";
        require_once ('views/ecuentas_v3.php');

        break;
    case 'printv2':
        $fact = (isset($uri_parts[2])) ? $uri_parts[2] : "";
        require_once ('views/ecuentas_v2.php');

        break;
    case 'printv1':
        $fact = (isset($uri_parts[2])) ? $uri_parts[2] : "";
        require_once ('views/ecuentas_v1.php');

        break;
    case 'barcode':
        $fact = (isset($uri_parts[2])) ? $uri_parts[2] : "";
        require "views/barcode.php";

        break;
    case 'mandamientos':
        $comunidad = (isset($uri_parts[2])) ? $uri_parts[2] : "";
        require "views/print.php";
        
        break;
    default:

        date_default_timezone_set('America/El_Salvador');

        /* VALIDATE LOGIN */
        $cAWS = new CognitoAWS();
        $cAWS->initialize();
        if (!$cAWS->isAuthenticated()) {
            require "views/login.php";
        }else{
            require "views/home.php";
        }
}

?>
