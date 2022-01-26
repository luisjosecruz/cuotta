<?php 

require_once("config/env.php");
require_once("config/token.php");

(new Env())->load();

$token = (new Token())->getToken();

echo $token;

?>