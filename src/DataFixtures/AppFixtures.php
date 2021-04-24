<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        $auteurs = [
            'Fred',
            'Milo',
            'Loucas',
            'Lilie',
            'Louane'
        ];

        $content = [
            "Alright kid, you stick to your father like glue and make sure that he takes her to the dance. Okay, alright, Saturday is good, Saturday's good, I could spend a week in 1955. I could hang out, you could show me around. Doc. I'm too loud. I can't believe it. I'm never gonna get a chance to play in front of anybody. I'm writing this down, this is good stuff.",
            "Oh no, don't touch that. That's some new specialized weather sensing equipment. Doc, she's beautiful. She's crazy about me. Look at this, look what she wrote me, Doc. That says it all. Doc, you're my only hope. There, there, now, just relax. You've been asleep for almost nine hours now. Yeah, I think it's a major embarrassment having an uncle in prison. It's about the future, isn't it?",
            "Please, Marty, don't tell me, no man should know too much about their own destiny. Give me a hand, Lorenzo. Ow, dammit, man, I sliced my hand. Yeah, I think maybe you do. Yeah, I think it's a major embarrassment having an uncle in prison. Wait a minute, wait a minute, Doc, are you telling me that you built a time machine out of a delorean.",
            "It's uh, the other end of town, a block past Maple. When could weathermen predict the weather, let alone the future. Ahh. You wanna a Pepsi, pall, you're gonna pay for it. Your not gonna be picking a fight, Dad, dad dad daddy-o. You're coming to a rescue, right? Okay, let's go over the plan again. 8:55, where are you gonna be.",
            "oh yeah, all you gotta do is go over there and ask her. Uh, plutonium, wait a minute, are you telling me that this sucker's nuclear? You bet. Whoa, this is heavy. Hey, Doc? Doc. Hello, anybody home? Einstein, come here, boy. What's going on? Wha- aw, god. Aw, Jesus. Whoa, rock and roll. Yo",
            "I'm writing this down, this is good stuff. C'mon, he's not that bad. At least he's letting you borrow the car tomorrow night. Mayor Goldie Wilson, I like the sound of that. Children. His head's gone, it's like it's been erased."
        ];
        $date = new DateTime();

        for ($a = 1; $a <= 24; $a++) {

            $article = new Article();
            $article->setTitre("Article n°: $a");
            $article->setAuteur($auteurs[array_rand($auteurs)]);
            $article->setContenu($content[array_rand($content)]);
            $article->setDateCreation(new \DateTime('-' . random_int(1, 45) . ' days'));
            $article->setSlug($this->slugger->slug($article->getTitre()));
            $article->setMainPicture($faker->imageUrl(600, 600, true));

            $manager->persist($article);
        }

        $manager->flush();
    }
}