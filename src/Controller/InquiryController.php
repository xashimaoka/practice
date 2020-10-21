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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
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
    private function createInquiryForm(): FormInterface
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('email',TextType::class)
            ->add('tel',TextType::class,[
                'required' => false,
            ])
            ->add('type',ChoiceType::class,[
                'choices' => [
                    '公演について' => true,
                    'その他' => false,
                ],
                'expanded' => true,
            ])
            ->add('content',TextareaType::class)
            ->add('submit',SubmitType::class,[
                'label' => '送信',
            ])
            ->getForm();
        return $form;
    }

    /**
     * @Route("/", methods={"GET","HEAD"})
     */
    public function indexAction(): Response
    {
        return $this->render('Inquiry/index.html.twig',
            ['form' => $this->createInquiryForm()->createView()]
        );
    }

    /**
     * @Route("/complete")
     */
    public function completeAction(): Response
    {
        return $this->render('Inquily/complete.html.twig');
    }


    /**
     * @Route("/", methods={"POST","HEAD"})
     */
    public function indexPostAction(Request $request): Response
    {
        $form = $this->createInquiryForm();
        $form->handleRequest($request);
        if ($form->isValid())
        {
            return $this->redirect(
                $this->generateUrl('app_inquiry_complete'));
        }


        return $this->render('Inquiry/index.html.twig',
            ['form' => $this->createInquiryForm()->createView()]
        );
    }

}