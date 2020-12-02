<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminMenuController extends AbstractController
{
    /**
     * @Return Response
     * @Route("/admin/")
     */
    public function indexAction(): Response
    {
        return $this->render('Admin/Common/index.html.twig');
    }
}
