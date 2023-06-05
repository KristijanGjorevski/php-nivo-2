<?php

namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/Database.php';

class UserController
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getUser(Request $request, Response $response, $args){
        $userId = [
            'id' => $args['id'],
            'name' => 'Kris',
            'email' => 'kristijan.gjorevski@magia.com'
        ];

        


        $response->getBody()->write(json_encode($userId));
        return $response->withHeader('Content-type', 'application/json');
    }

    public function getStudent(Request $request, Response $response, $args){

        $sql = "SELECT * FROM studenti WHERE id = :id";

        $param = [':id' => $args['id']];
        
        $student = $this->db->query($sql,$param); 

        // $student = $result->fetch();

        ob_start();
        
        include __DIR__ .'/../views/student.php';

        $output = ob_get_clean(); 
        // ob_flush()
        $response->getBody()->write($output);

        return $response;

    }
}