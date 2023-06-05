<?php
namespace App;

use PDO;

class Database 
{
    private $host = '127.0.0.1';
    private $username = 'root';
    private $password = '';
    private $database = 'php12';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
        } catch(PDOException $error){
            echo 'Error: No connection' . $error->getMessage();
        }

    }

    public function query($sql, $parameters = []){

        $sttm = $this->connection->prepare($sql);
        $sttm->execute($parameters);
        $response_data = $sttm->fetch(PDO::FETCH_ASSOC);
        if($response_data === false){
            return 'Error Found: By Developer ' ;
        }
        return $response_data;
    }





    
}