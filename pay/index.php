<?php 

$URI = $_SERVER['REQUEST_URI'];
$uriParts = explode("/", $URI);

switch($uriParts[1]){
    case 'pay':
        $route = $uriParts[2];
        require_once('inc/header.php');
        require_once('inc/home.php');
        require_once('inc/footer.php');
        break;
}

?>

