<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionHommeController extends AbstractController
{
    /**
     * @Route("/collection", name="collection")
     */
    public function index(): Response
    {
        return $this->render('collection_homme/index.html.twig', [
            'controller_name' => 'CollectionHommeController',
        ]);
    }
}
