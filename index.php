<?php
require 'vendor/autoload.php';

$app= new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true, //turning error details on
    ]]
); //initialisation 

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . "/ressources/views", [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};


/*
$container['greeting'] = function() {
    return "Hello from the other side";
};*/

$app->get('/',function($request,$response) {


return $this->view->render($response,'home.twig') ;

})->setName('home');
$app->get('/users',function($request,$response) {
    $users = [
        ['username' => 'Marwen'],
        ['username' => 'Rihab'],
        ['username' => 'Monia'],
    ];
    

    return $this->view->render($response,'users.twig',[
        'users' => $users]) ;
    
    })->setName('users.list');


    $app->get('/contact',function($request,$response) {


        return $this->view->render($response,'contact.twig') ;
        
        });

    $app->post('/contact',function($request,$response) {


      // echo $request->getParams("email");
    echo $request->getParam('email'); 
        })->setName('contact');    



$app->run(); //demarrer l'appliquation
?>