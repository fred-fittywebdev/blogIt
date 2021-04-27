<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tagNames = [
            'Sport',
            'Evasion',
            'Développement'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $tag = new Tag();
            $tag->setNom($tagNames[array_rand($tagNames)]);
            $tag->setArticle($this->getReference('article-' . random_int(1, 33)));

            $manager->persist($tag);

            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            ArticleFixtures::class
        ];
    }
}