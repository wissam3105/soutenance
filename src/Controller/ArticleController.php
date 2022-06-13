<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;




class ArticleController extends AbstractController
{
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    /**
     * @Route("/article", name="article")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('article/produit.html.twig',[
        'articles' => $articles
    ]);
    }
    /**
     * @Route("/article/new", name="article_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, CategorieRepository $categorieRepository, SluggerInterface $slugger): Response
    {

        $article= new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $article = $form->getData();
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
    
                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('article_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo $e;
                }
                $article->setImage($newFilename);
            }
            $this->em->persist($article);
            $this->em->flush();
            
            return $this->redirectToRoute('article');

        }
        return $this->render('article/new.html.twig',[
            'form' => $form->createView()
        ]);

    }
}

