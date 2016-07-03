<?php
/**
 * Created by PhpStorm.
 * User: darke_000
 * Date: 01.07.2016
 * Time: 18:10
 */

namespace Comments\Controller;

use Silex\Application;
use Comments\Form\Type\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class IndexController
{
    public function showIndex(Request $request, Application $app)
    {
        $form = $app['form.factory']->create(CommentType::class);

        if ($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()){
                $data = $form->getData();

                $app['repository.comment']->inputComment((int)$data['pid'], $data['text'], $data['user']);
            }
        }

        $comments = $app['repository.comment']->getAllComments();
        return $app['twig']->render('index.twig', array ('form' => $form->createView(), 'comments' => $comments));
    }

    public function deleteComment(Request $request, $id,  Application $app)
    {
        $app['repository.comment']->deleteComment($id);

        $comments = $app['repository.comment']->getAllComments();
        return $app['twig']->render('index.twig', array ('comments' => $comments));
    }
}