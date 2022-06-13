<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(SessionInterface $session, ArticleRepository $articleRepository): Response
    {
        $panier = $session->get('panier', []);
        $panierData = [];

        foreach($panier as $id => $quantite){
            $panierData[] = [
                'article' => $articleRepository->find($id),
                'quantite' => $quantite
            ];
        }
        $total = 0;

        foreach($panierData as $art){
            $totalArt = $art['article']->getPrix() * $art['quantite'];
            $total += $totalArt;
        }

        return $this->render('panier/index.html.twig', [
            'panier' => $panierData,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="app_panier_add")
     */
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            $panier[$id]++ ;
        }else{
            $panier[$id] = 1;
        };

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/panier/delete/{id}", name="app_panier_delete")
     */
    public function delete($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute("app_panier");
    }
}
