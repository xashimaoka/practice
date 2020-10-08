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
        return $this->render('Concert/index.html.twig');
    }
}