<?php 
    require_once "../config/pdo.php";

// validar que sean datos por medio del método POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $server = $_POST['server'];

    ajaxFn_login($username, $password);

    // $sql = "SELECT * FROM usuarios WHERE usuarios.usuarioID = $username AND usuarios,";

    // $query = $pdo->prepare($sql);
    // $query->execute();
    // $result = $query->fetchAll(PDO::FETCH_OBJ);

    // if($query->rowCount() > 0){
    //     $counter = 0;
    //     foreach($result as $r) {

    //     }
    // }

    $cognito = new CognitoAWS();

    function ajaxFn_login($username, $password) {
		$cognito = $this->cognito;

		$cognito->initialize();
		if ($cognito->isAuthenticated()) { echo 200; exit(); }

		$error = $cognito->authenticate($username, $password);
        if(!empty($error)) {
        	$error = json_decode($error, TRUE);
            echo "Error";
        }else{
        	echo 200;
        }
	}

	function ajaxFn_logout() {
		$cognito = $this->cognito;

		$cognito->initialize();
		$cognito->logout();
		echo 200;
	}

}else{
    return false;
}

 //Hola12345.
