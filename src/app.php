<?php
/**
 * Created by PhpStorm.
 * User: darke_000
 * Date: 01.07.2016
 * Time: 18:08
 */

use Symfony\Component\Validator\Constraints as Assert;

$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => '../app/views'
));
$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new \Silex\Provider\DoctrineServiceProvider());
$app->register(new \Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

$app['repository.comment'] = $app->share(function ($app){
    return new \Comments\Repository\CommentRepository($app['db']);
});
