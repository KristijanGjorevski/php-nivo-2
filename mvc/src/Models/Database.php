<?php
namespace App\Controllers;

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

    public function getAllStudents(){

        $sql = "SELECT * FROM studenti
                ORDER BY studenti.ime";
        $sttm = $this->connection->prepare($sql);
        $sttm->execute();
        $response_data = $sttm->fetchAll(PDO::FETCH_ASSOC);

        return $response_data ?? null;
    }

    public function getStudentById($parameters = []){

        $sql = "SELECT * FROM studenti WHERE id = :id";
        $sttm = $this->connection->prepare($sql);
        $param = [':id' => $parameters['id']];
        $sttm->execute($param);
        $response_data = $sttm->fetch(PDO::FETCH_ASSOC);

        return $response_data ?? null;
    }
    
    public function insertStudent($parameters = []){

        $sql = "
        INSERT INTO `studenti` (`ime`, `prezime`, `godini`, `email`)
        VALUES (:ime,:prezime,:godini,:email);
        ";
        $sttm = $this->connection->prepare($sql);
        $param = 
        [
            ':ime' => $parameters['ime'],
            ':prezime' => $parameters['prezime'],
            ':godini' => $parameters['godini'],
            ':email' => $parameters['email']
        ];

        $response_data = $sttm->execute($param);

        return $response_data ?? false;
    }

    public function deleteStudent($parameters = []){

        $sql = "
        DELETE FROM `studenti`
        WHERE id = :id
        ";

        $param = 
        [
            ':id' => $parameters,
        ];

        $sttm = $this->connection->prepare($sql);

        $response_data = $sttm->execute($param);

        return $response_data ?? false;
    }

    public function editStudent($parameters = []){

        $sql = "
        SELECT * FROM `studenti`
        WHERE id = :id
        ";

        $param = 
        [
            ':id' => $parameters,
        ];

        $sttm = $this->connection->prepare($sql);

        $response_data = $sttm->execute($param);
        $response_data = $sttm->fetch(PDO::FETCH_ASSOC);
        return $response_data ?? false ;
    }
    
}