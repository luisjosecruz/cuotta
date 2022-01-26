<?php 

require_once("config/env.php");
require_once("config/token.php");

(new Env())->load();

$token = (new Token())->getToken();

$data = $_POST;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.wompi.sv/TransaccionCompra/Bitcoin",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer " . $token,
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

//$data = json_decode($response, true);

echo $response;

?>