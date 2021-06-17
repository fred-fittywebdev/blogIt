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
use App\Service\RandomPassword;
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
            'randomArticle' => $randomArticles,

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
}
