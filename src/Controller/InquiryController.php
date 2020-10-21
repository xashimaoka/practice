<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2020/10/14
 * Time: 15:54
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


/**
 * @Route("/inquiry", methods={"GET","HEAD"})
 */

class InquiryController  extends AbstractController
{
    /**
     * @Route("/", methods={"GET","HEAD"})
     */

    public function indexAction()
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('email',TextType::class)
            ->add('tel',TextType::class,[
                'required' => false,
            ])
            ->add('type',ChoiceType::class,[
                'choices' => [
                    '公演について',
                    'その他',
                    ],
                'expanded' => true,
                ])
            ->add('content',TextareaType::class)
            ->add('submit',SubmitType::class,[
                'label' => '送信',
            ])
            ->getForm();

        return $this->render('Inquiry/index.html.twig',
            ['form' => $form->createView()]
        );
    }

}