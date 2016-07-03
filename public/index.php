<?php
/**
 * Created by PhpStorm.
 * User: darke_000
 * Date: 01.07.2016
 * Time: 18:06
 */
header('Content-Type: text/html; charset=utf-8');

require_once('../vendor/autoload.php');

$app = new \Silex\Application();

$app['debug'] = true;

include_once ('../src/app.php');
include_once ('../app/config/database.php');
include_once ('../src/routes.php');

$app->run();
