<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToppageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $information = "5月と6月の公演情報を追加しました。";

        return $this->render('Toppage/index.html.twig',
            ['information' => $information]
        );
    }
}
