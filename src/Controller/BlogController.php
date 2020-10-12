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
        $blogList = [
                [
                    'targetDate' => '2015/03/15',
                    'title' => '東京公演レポート'
                ],
                [
                    'targetDate' => '2015/02/15',
                    'title' => '最近の練習風景'
                ],
            ];


        return $this->render('Blog/latestList.html.twig',
            ['blogList' => $blogList]
        );
    }
}