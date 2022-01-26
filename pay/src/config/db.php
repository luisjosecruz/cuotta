<?php 

class Database
{
    private $connect = null;

    public function __construct(){
        $servername  = getenv('DB_SERVERNAME');
        $username    = getenv('DB_USERNAME');
        $password    = getenv('DB_PASSWORD');
        $port        = getenv('DB_PORT');
        $db          = getenv('DB_NAME');

        // try {
        //     $this->connect = new \PDO("mysql:host=$servername;port=$port;charset=utf8mb4;dbname=$db", $username, $password);
        // } catch (\PDOException $e) {
        //     exit($e->getMeesage());
        // }

        try {
            $this->connect = mysqli_connect($servername, $username, $password, $db);
        } catch (Exception $e) {
            echo $e->errorMessage();
        }
    }

    public function getConnection(){
        return $this->connect;
    }
}

?>