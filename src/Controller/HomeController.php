<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dzango\Twig\Extension\Truncate;
use Symfony\Bundle\TwigBundle\DependencyInjection\Compiler\TwigEnvironmentPass;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy([], ['id' => 'DESC'], 3);
        $randomArticles = $articleRepository->findAll();

        $featuredProduct = $articleRepository->findBy(['best' => 1], [], 1, 5);

        // dd($featuredProduct);


        return $this->render('home.html.twig', [
            'articles' => $articles,
            'randomArticle' => $randomArticles
        ]);
    }

    /**
     * @Route("/{tag_slug}/{slug}", name="article_show")
     */
    public function show($slug, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findOneBy([
            'slug' => $slug
        ]);


        if (!$article) {
            throw $this->createNotFoundException("L'article demandé n'existe pas");
        }
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}
