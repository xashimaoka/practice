<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2020/10/08
 * Time: 16:37
 */

namespace App\Controller;

use App\Repository\BlogArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @param BlogArticleRepository $blogArticleRepository
     * @return Response
     * @Route("/blog")
     */
    public function latestList(BlogArticleRepository $blogArticleRepository):Response
    {
        $blogList = $blogArticleRepository->findBy([],['targetDate' => 'DESC']); //エンティティリポジトリのファインダメソッドを実行して情報取得


        return $this->render('Blog/latestList.html.twig',
            ['blogList' => $blogList]
        );
    }
}