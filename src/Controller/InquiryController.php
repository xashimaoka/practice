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
    private function createInquiryForm(): FormInterface //関数:出力される値の種類
    {
        $form = $this->createFormBuilder($data = null, [
            'data_class' => \App\Entity\Inquiry::class, //第一引数に$data, 第二引数にclass名を指定
        ])
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
    public function indexPostAction(Request $request, \Swift_Mailer $mailer): Response //request引数を指定
    {
        $form = $this->createInquiryForm();
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $data = $form->getData();

            //databaseへの登録
            $em = $this->getDoctrine()->getManager(); //エンティティマネージャーを取得
            $em->persist($data); //エンティティをdoctrineの管理下へ
            $em->flush(); //変更をデータベースに適用


            //メールメッセージの作成
            $message = (new \Swift_Message())
                ->setSubject('webサイトからのお問い合わせ')
                ->setFrom('webmaster@example.com')
                ->setTo('admin@example.com')
                ->setBody(
                    $this->renderView(
                        'mail/inquiry.txt.twig',
                        ['data' => $data]
                    )
                );

            $mailer->send($message);

            return $this->redirect(
                $this->generateUrl('app_inquiry_complete'));
        }


        return $this->render('Inquiry/index.html.twig',
            ['form' => $this->createInquiryForm()->createView()]
        );
    }

}