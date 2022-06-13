<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GammeAuLaitController extends AbstractController
{
    /**
     * @Route("/gamme-lait", name="gamme-lait")
     */
    public function index(): Response
    {
        return $this->render('gamme_au_lait/index.html.twig', [
            'controller_name' => 'GammeAuLaitController',
        ]);
    }
}
