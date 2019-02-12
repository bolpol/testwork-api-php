<?php
namespace App;
use App\Controller\AuthController;
use App\Controller\CategoryController;
use App\Controller\ProductController;
use App\Modifier\RequestValidation;
use Flight;
use Gridonic\JsonResponse\ErrorJsonResponse;
use Gridonic\JsonResponse\SuccessJsonResponse;


/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/11/2019
 * Time: 11:35 AM
 */

//var_dump($_GET, $_GET, $_COOKIE);

Flight::route('GET /', function () {
    require_once  \dirname(__DIR__) . '/Web/Home/index.php';
});

Flight::route('GET /home/', function () {
    require_once  \dirname(__DIR__) . '/Web/Home/index.php';
});

Flight::route('GET|POST /auth/login/', function () {

    $input = new RequestValidation($_GET);
    $input->require('email');
    $input->require('password');

    try {
        $data = (new AuthController())->login($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }

});

Flight::route('GET|POST /auth/register/', function () {

    $input = new RequestValidation($_GET);
    $input->require('name');
    $input->require('email');
    $input->require('password');

    try {
        $data = (new AuthController())->register($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }

});

/*
 *  ----------- PRODUCT ROUTER ---------------
 */
Flight::route('GET /api/product/@id:[0-9]{0,7}', function($id){

    try {
        $data = (new ProductController())->get($id);
        var_dump($data);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET /api/product/all/', function () {

    try {
        $data = (new ProductController())->read();
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET|POST /api/product/create/', function () {

    $input = new RequestValidation($_GET);
    $input->require('name');
    $input->require('categories');
    $input->require('token'); 

    try {
        $data = (new ProductController())->create($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET|POST /api/product/update/', function () {
    
    $input = new RequestValidation($_GET);
    $input->require('token'); 
    
    try {
        $data = (new ProductController())->update($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET|POST /api/product/delete/', function () {
    
    $input = new RequestValidation($_GET);
    $input->require('token'); 
    
    try {
        $data = (new ProductController())->delete($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

/*
 *  ----------- CATEGORIES ROUTER ---------------
 */
Flight::route('GET /api/categories/all/', function () {

    try {
        $data = (new CategoryController())->read();
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET|POST /api/categories/create/', function () {

    $input = new RequestValidation($_GET);
    $input->require('name');
    $input->require('token');

    try {
        $data = (new CategoryController())->create($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET|POST /api/categories/update/', function () {
    
    $input = new RequestValidation($_GET);
    $input->require('token'); 
    
    try {
        $data = (new CategoryController())->update($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

Flight::route('GET|POST /api/categories/delete/', function () {

    $input = new RequestValidation($_GET);
    $input->require('token'); 
    
    try {
        $data = (new CategoryController())->delete($_GET);
        (new SuccessJsonResponse($data, 'Success message', 'Success title', 200))->send();
    } catch (\ErrorException $e) {
        (new ErrorJsonResponse([], $e->getMessage(), 'Error title', 400, 'undefined', []))->send();
    }
});

// ----------- START ROUTING ---------------
Flight::start();