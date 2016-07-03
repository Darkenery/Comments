<?php
/**
 * Created by PhpStorm.
 * User: darke_000
 * Date: 02.07.2016
 * Time: 0:02
 */

namespace Comments\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pid', HiddenType::class)
            ->add('user', TextType::class, array(
                'label' => 'Имя'
            ))
            ->add('text', TextareaType::class, array(
                'label' => 'Комментарий',
                'attr' => array(
                    'rows' => '3',
                    'cols'=> '160'
                )
            ))
            ->add('answer', SubmitType::class, array(
                'label' => 'Отправить',
                'attr' => array('class' => 'btn btn-success')
            ));
    }

    public function getName()
    {
        return 'comment';
    }
}