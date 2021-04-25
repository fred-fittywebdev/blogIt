<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;

class CommentaireFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prenoms = [
            'Isabelle',
            'Paul',
            'Victor',
            'Bernard',
            'Sandra',
            'Vanessa'
        ];

        $comments = [
            "Nullam nec tortor bibendum, tempor est vitae, dignissim nulla. Phasellus sollicitudin nunc sed fermentum condimentum. Etiam ac condimentum purus",
            "Quisque dignissim ex a vulputate pellentesque. Etiam vestibulum nec felis vel commodo. Sed sed tellus ut erat porta varius ut rutrum eros",
            "Proin congue, urna eget aliquam sodales, odio nisi tempus sapien, eget congue eros tellus sit amet sem. Integer viverra ex ac elit accumsan",
            "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin facilisis mattis maximus",
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum nunc at aliquet pulvinar. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus"
        ];

        for ($i = 1; $i <= 50; $i++) {
            $comment = new Commentaire();
            $comment->setContenu($comments[array_rand($comments)]);
            $comment->setAuteur($prenoms[array_rand($prenoms)]);
            $comment->setDatePost(new \DateTime('-' . random_int(1, 45) . ' days'));
            $comment->setArticle($this->getReference('article-' . random_int(1, 33)));

            $manager->persist($comment);

            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class
        ];
    }
}