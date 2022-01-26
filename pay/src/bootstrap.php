<?php 

require_once("config/env.php");
require_once("config/db.php");
// require_once("config/token.php");

(new Env())->load();

$conn = (new Database())->getConnection();
mysqli_set_charset($conn, 'utf8');

// $token = (new Token())->getToken();

?>