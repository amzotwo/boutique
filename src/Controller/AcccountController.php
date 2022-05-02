<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcccountController extends AbstractController
{
    /**
     * @Route("/compte", name="app_acccount")
     */
    public function index(): Response
    {
        return $this->render('acccount/index.html.twig');
    }
}
