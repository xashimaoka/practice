<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminMenuController extends AbstractController
{
    /**
     * @return Response
     * @Route("/admin")
     */
    public function index(): Response
    {
        return $this->render('Admin/Common/index.html.twig');
    }
}
