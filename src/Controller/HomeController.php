<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(EntityManagerInterface $em)
    {

        $article = new Article;
        $article
            ->setTitre('Un troisième article')
            ->setContenu('Assertively matrix goal-oriented leadership vis-a-vis fully researched technology. Seamlessly synergize out-of-the-box opportunities before worldwide opportunities. Energistically productize visionary processes vis-a-vis unique content. Proactively foster enterprise.')
            ->setAuteur('Fred')
            ->setSlug('troisieme-article')
            ->setDateCreation(new \DateTime('now'));


        $em->persist($article);
        $em->flush();


        return $this->render('home.html.twig');
    }
}