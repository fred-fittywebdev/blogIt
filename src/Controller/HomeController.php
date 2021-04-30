<?php

namespace App\Controller;

use DateTimeInterface;
use App\Entity\Article;
use App\Form\CommentType;
use App\Entity\Commentaire;
use Dzango\Twig\Extension\Truncate;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/{nom}", name="article_show")
     */
    public function show($nom, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em)
    {
        $article = $articleRepository->findOneBy([
            'slug' => $nom
        ]);

        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $form = $this->createForm(CommentType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('article_show', ['nom' => $article->getTitre()]);
        }
        $formView = $form->createView();




        if (!$article) {
            throw $this->createNotFoundException("L'article demandé n'existe pas");
        }
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'formView' => $formView
        ]);
    }
}