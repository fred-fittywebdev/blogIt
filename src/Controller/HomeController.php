<?php

namespace App\Controller;

use DateTimeInterface;
use App\Entity\Article;
use App\Form\CommentType;
use App\Entity\Commentaire;
use App\Form\ArticleType;
use Dzango\Twig\Extension\Truncate;
use App\Service\VerificationComment;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Asset\Package;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy(['state' => 'publie'], ['id' => 'DESC'], 3);
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
    public function show(
        $nom,
        ArticleRepository $articleRepository,
        Request $request,
        EntityManagerInterface $em,
        VerificationComment $verif,
        FlashBagInterface $session
    ) {


        $article = $articleRepository->findOneBy([
            'slug' => $nom
        ]);


        $commentaire = new Commentaire();
        $commentaire->setArticle($article);


        $form = $this->createForm(CommentType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($verif->motInterdits($commentaire) === false) {
                $em->persist($commentaire);
                $em->flush();

                return $this->redirectToRoute('article_show', ['nom' => $article->getTitre()]);
            } else {
                $session->add('danger', "Votre commentaire contient un mot grossier");
            }
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


    /**
     * @Route("/admin/article/{id}/edit", name="article_edit")
     */
    public function edit($id, ArticleRepository $articleRepository)
    {
        $article =  $articleRepository->find($id);

        return $this->render('article/edit.html.twig', [
            "article" => $article
        ]);
    }

    /**
     * @Route("/admin/article/create", name="article_create")
     * @Route("/admin/article/{id}/edit", name="article_edit")
     */
    public function create(Article $article = null, Request $request, ArticleRepository $articleRepository, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        if ($article === null) {
            $article = new Article();
        }



        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('Brouillon')->isClicked()) {
                $article->setState('brouillon');
            } else {
                $article->setState('a publier');
            }

            if ($article->getId() === null) {
                $article->setBest(false);
                $article->setSlug(strtolower($slugger->slug($article->getTitre())));
                // dd($article);

                $em->persist($article);
            }

            $em->flush();

            // return $this->redirectToRoute('homepage');
        }

        if (!$article) {
            throw $this->createNotFoundException("L'article demandé n'existe pas");
        }

        $formView = $form->createView();
        return $this->render('article/create.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/admin/article/brouillons", name="article_brouillon")
     */
    public function brouillon(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy([
            'state' => 'brouillon'
        ]);

        return $this->render('article/brouillon.html.twig', [
            'articles' => $articles
        ]);
    }
}