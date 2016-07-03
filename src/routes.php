<?php
/**
 * Created by PhpStorm.
 * User: darke_000
 * Date: 01.07.2016
 * Time: 18:08
 */

$app->get('/', 'Comments\Controller\IndexController::showIndex');
$app->match('/', 'Comments\Controller\IndexController::showIndex');
$app->delete('/comment/{id}', 'Comments\Controller\IndexController::deleteComment');
