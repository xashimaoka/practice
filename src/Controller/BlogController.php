<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2020/10/08
 * Time: 16:37
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function latestListAction()
    {
        $em = $this->getDoctrine()->getManager();//エンティティマネージャーを取得
        $blogArticleRepository = $em->getRepository('AppBundle:BlogArticle');
        $blogList = $blogArticleRepository->find([],['targetDate' => 'DESC']);


        return $this->render('Blog/latestList.html.twig',
            ['blogList' => $blogList]
        );
    }
}