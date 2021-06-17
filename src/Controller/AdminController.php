<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
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