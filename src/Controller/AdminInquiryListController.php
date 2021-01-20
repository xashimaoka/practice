<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2020/12/02
 * Time: 20:22
 */

namespace App\Controller;


use App\Entity\Inquiry;
use Psr\Container\ContainerInterface;
use App\Repository\InquiryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/inquiry")
 */
class AdminInquiryListController extends AbstractController
{
    /**
     * @param InquiryRepository $inquiryRepository
     * @return Response
     * @Route("/search")
     */
    public function index(Request $request,InquiryRepository $inquiryRepository):Response
    {
        $form =$this->createSearchForm();
        $form->handleRequest($request);
        $keyword = null;
        if ($form->isSubmitted() && $form->isValid()){
            $keyword = $form->get('search')->getData();
        }

        $inquiryList = $inquiryRepository->findAllByKeyword($keyword);

        return $this->render('Admin/Inquiry/index.html.twig', [
                'inquiryList' => $inquiryList,
                'form' => $form->createView(),//formはviewにして渡す必要がある
            ]
        );
    }

    private function createSearchForm()
    {
        return $this->createFormBuilder()
            ->add('search',searchType::class)
            ->add('submit',submitType::class,[
                'label' => '検索',
            ])
            ->getForm();
    }
}