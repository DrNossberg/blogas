<?php

// Démarrage sessions PHP
// (pour le support des variables de session)
session_start();

require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \blogapp\conf\ConnectionFactory;

// Création de la connexion à la base
ConnectionFactory::makeConnection('src/conf/conf.ini');

// Configuration de Slim

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true
    ],
    'flash' => function() {
        return new \Slim\Flash\Messages();
    }
];

// Création du dispatcher

$app = new \Slim\App($configuration);

// Définition des routes

$app->get('/',
    '\blogapp\Controllers\PostController:listPosts')
    ->setName('index');


/*
 * POSTS
 */
$app->post('/getposts',
            '\blogapp\Controllers\PostController:getPosts')
    ->setName('post_get');


$app->get('/post/{id}',
          '\blogapp\Controllers\PostController:displayPost')
    ->setName('post_display');

$app->get('/newpost',
            '\blogapp\Controllers\PostController:createPostForm')
    ->setName('post_create_form');

$app->post('/createpost',
            '\blogapp\Controllers\PostController:createPost')
    ->setName('post_create');

    
    
/*
* COMMENTS 
*/
$app->post('/createcomment/{id}',
            '\blogapp\Controllers\CommentController:createComment')
    ->setName('comment_create');
    



/*
 * USERS MANAGEMENT
 */
$app->get('/register',
          '\blogapp\Controllers\UserController:createUserForm')
    ->setName('user_create_form');

$app->post('/createuser',
          '\blogapp\Controllers\UserController:create')
    ->setName('user_create');

$app->get('/login',
    '\blogapp\Controllers\UserController:connectionUserForm')
    ->setName('user_connection_form');

$app->post('/connectutil',
    '\blogapp\Controllers\UserController:connect')
    ->setName('user_connection');

$app->get('/disconnect',
    '\blogapp\Controllers\UserController:disconnect')
    ->setName('user_deconnection');

$app->get('/manageusers',
    '\blogapp\Controllers\UserController:manageUsers')
    ->setName('user_manage');

$app->post('/expeluser/{id}',
    '\blogapp\Controllers\UserController:expel')
    ->setName('user_expel');

$app->post('/unexpeluser/{id}',
    '\blogapp\Controllers\UserController:unexpel')
    ->setName('user_unexpel');


/*
 * CATEGORIES
 */
$app->get('/managecategories',
    '\blogapp\Controllers\CategoryController:manageCategories')
    ->setName('cat_manage');

$app->post('/createcategory',
    '\blogapp\Controllers\CategoryController:create')
    ->setName('cat_create');

$app->post('/deletecategory/{id}',
    '\blogapp\Controllers\CategoryController:delete')
    ->setName('cat_delete');



$app->run();
