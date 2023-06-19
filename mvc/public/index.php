<?php

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controllers\UserController;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add routes
$app->get('/', function (Request $request, Response $response) {
    $userController = new UserController();
    ob_start();
     $data = $userController->getAllStudents($request, $response);
    include __DIR__.'/../src/Views/homepage.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->get('/log-in', function (Request $request, Response $response) {
    $userController = new UserController();
    ob_start();
     $data = $userController->getAllStudents($request, $response);
    include __DIR__.'/../src/Views/homepage.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    return $userController->getUser($request, $response, $args);
});

$app->get('/student/{id}', function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    return $userController->getStudent($request, $response, $args);
});

$app->get('/student/{id}/delete', function (Request $request, Response $response, array $args) {
    $studentId = $args['id'];
    $userController = new UserController();
    return $userController->deleteStudentById($request, $response, $studentId);
});

$app->get('/student/{id}/edit', function (Request $request, Response $response, array $args) {
    $studentId = $args['id'];
    $userController = new UserController();
    return $userController->editStudentById($request, $response, $studentId);
});

$app->get('/student-form', function (Request $request, Response $response) {
    ob_start();
    include __DIR__.'/../src/Views/create-student.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->post('/student-create', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $userController = new UserController();
    return $userController->createStudent($request, $response, $data);
});


$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->run();