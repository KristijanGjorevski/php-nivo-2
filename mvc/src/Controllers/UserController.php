<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\Response  as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../Models/Database.php';

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

    public function getAllStudents(Request $request, Response $response){
        $resp_data = $this->db->getAllStudents(); 
        return $resp_data;
    }

    public function getStudent(Request $request, Response $response, $args){

        if(!is_numeric($args['id']) || $args['id'] <= 0){
            $response->getBody()->write('Student id needs to be a number');
            return $response->withStatus(404);
        }

        $student = $this->db->getStudentById($args);
        // die($student);
        if($student){
            ob_start();
            include __DIR__ .'/../Views/student.php';
            $output = ob_get_clean(); 

            // ob_flush()
            $response->getBody()->write($output);
            return $response;
        }else {
            ob_start();
            include __DIR__ .'/../Views/404.php';
            $output = ob_get_clean(); 
            $response->getBody()->write($output);
            return $response->withStatus(404);
        }
    }

    public function deleteStudentById(Request $request, Response $response, $args){

        $student = $this->db->deleteStudent($args);

        if($student){
            return $response->withHeader('Location','/')->withStatus(302);
        }else {
            $response->getBody()->write('<h1>Student not deleted</h1>');
            return $response;
        }
    }

    public function editStudentById(Request $request, Response $response, $args){

        $student = $this->db->editStudent($args);

        if($student){

            $_SESSION['oldData'] = $student;

            ob_start();
            include __DIR__ .'/../Views/create-student.php';
            $output = ob_get_clean(); 
            $response->getBody()->write($output);

            unset($_SESSION['oldData']);

            return $response->withStatus(404);
        }else {
            $response->getBody()->write('<h1>Student not edited</h1>');
            return $response;
        }
    }

    public function createStudent(Request $request, Response $response,array $args){

        $validation = $this->validateStudentCreation($args);

        if(!empty($validation)){
            
            $_SESSION['error'] = $validation;
            $_SESSION['oldData'] = $args;
            
            ob_start();
            include __DIR__ .'/../Views/create-student.php';
            $output = ob_get_clean(); 
            $response->getBody()->write($output);

            unset($_SESSION['error']);
            unset($_SESSION['oldData']);

            return $response->withStatus(404);
        } else {
            // insert into database
            $confirmation = $this->db->insertStudent($args);

            return $response->withHeader('Location','/')->withStatus(302);
        }

        // treba da vratime rezultat nazad do korisnikot so return
        // Nareden cas tuka treba da se dovrsat stvari
    }
    
    private function validateStudentCreation($params){

        $errors = [];

        if(empty($params['ime'])){
            $errors[] = 'inputot za ime e potrebno';
        }
        if(empty($params['prezime'])){
            $errors[] = 'inputot za prezime e potrebno';
        }
        if(! is_numeric($params['godini'])){
            $errors[] = 'inputot za godini treba da bide integer';
        }
        if(empty($params['email'])){
            $errors[] = 'inputot za email e potreben';
        } elseif (!filter_var($params['email'],FILTER_VALIDATE_EMAIL)){
            $errors[] = 'invaliden e formatot na email';
        }
        
        return $errors;
    }
}