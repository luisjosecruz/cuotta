<?php 

define('ACCESS_TOKEN', $_POST['access_token']);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.wompi.sv/EnlacePago",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer " . ACCESS_TOKEN,
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$data = json_decode($response, true);

$resultado = $data['resultado'];

$html = "
  <div class='wrap_data'>
    <h2>Payment links</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Aplicativo</th>
                <th>Monto</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>";
            foreach($resultado as $i){
              $html .= "
                <tr>
                  <td>".$i['idEnlace']."</td>
                  <td>".$i['nombreEnlace']."</td>
                  <td>".$i['nombreAplicativo']."</td>
                  <td>".$i['monto']."</td>
                  <td><div class='wompi_button_widget' data-url-pago='".$i['urlEnlace']."'</div></td>
                </tr>";
            }
    $html.="
        </tbody>
    </table>
  </div>
  <script src='https://pagos.wompi.sv/js/wompi.pagos.js'></script>
";

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $html;
}


?>