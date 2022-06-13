<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures;
use App\Entity\Article;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10; $i++){
            $article= new Article();
        $article->setTitle("Titre de l'article")
                ->setContent("le contenu de l'article")
                ->setImage("http://placehold.it/350x350")
                ->setCreatedAt(new \DateTime());
                $manager->persist($article);

        }
        
        $manager->flush();
    }
}
