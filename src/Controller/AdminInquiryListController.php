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
     * @Route("")
     */
    public function index(InquiryRepository $inquiryRepository):Response
    {
        $inquiryList = $inquiryRepository->findBy([],['id' => 'DESC']);

        return $this->render('Admin/Inquiry/index.html.twig',
            ['inquiryList' => $inquiryList]
        );
    }
}