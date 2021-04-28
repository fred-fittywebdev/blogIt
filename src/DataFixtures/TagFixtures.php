<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class TagFixtures extends Fixture
{
    protected $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
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
            $tag->setSlug($this->slugger->slug($tag->getNom()));
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