<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2020/12/16
 * Time: 20:49
 */

namespace App\Controller;

use App\Entity\Inquiry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * @Route("/admin/inquiry")
 */
class AdminInquiryEditController extends AbstractController
{
    private function createInquiryForm($inquiry): FormInterface
    {
        return $this->createFormBuilder($inquiry, //初期値となるエンティティオブジェクト
            ["validation_groups" => ["admin"]])
            ->add('processStatus',ChoiceType::class,[
                'choices' => [
                    '未対応',
                    '対応中',
                    '対応済',
                    ],
                'empty_data' => 0,
                'expanded' => true,
                ])
            ->add('processMemo',TextareaType::class)
            ->add('submit',SubmitType::class,[
                'label' => '保存',
            ])
            ->getForm();
    }
    /**
     * @Route("/{id}/edit", methods={"GET","HEAD"})
     * @ParamConverter("inquiry",class="App:Inquiry")
     */
    public function input(Inquiry $inquiry)
    {
        $form = $this->createInquiryForm($inquiry);

        return $this->render('Admin/Inquiry/edit.html.twig',
            [
                'form' => $form->createView(),
                'inquiry' => $inquiry
            ]);
    }
    /**
     * @Route("/{id}/edit", methods={"POST","GET"})
     * @ParamConverter("inquiry",class="App:Inquiry")
     */
    public function inputPost(Request $request, Inquiry $inquiry):Response
    {
        $form = $this->createInquiryForm($inquiry);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl(
               'app_admininquirylist_index'
            ));
        }

        return $this->render('Admin/Inquiry/edit.html.twig',[
            'form' => $form->createView(),
            'inquiry' => $inquiry
            ]
        );
    }
}
