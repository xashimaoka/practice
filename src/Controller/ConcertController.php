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

class ConcertController extends AbstractController
{
    /**
     * @Route("/concert/")
     */
    public function indexAction()
    {
        $concertList = [
                [
                    'date' => '2015/05/03',
                    'time' => '14:00',
                    'place' => '東京文化会館',
                    'available' => false,
                ],
                [
                    'date'=> '2016/01/10',
                    'time' => '14:00',
                    'place' => '渋谷公会堂',
                    'available' => true,
                ],
            ];


        return $this->render('Concert/index.html.twig',
            ['concertList' => $concertList]
        );
    }
}