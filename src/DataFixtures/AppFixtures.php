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
            'Louane',
            'Aurélien',
            'Jean-Noel',
            'Clément',
            'Marylou'
        ];

        $content = [
            "Alright kid, you stick to your father like glue and make sure that he takes her to the dance. Okay, alright, Saturday is good, Saturday's good, I could spend a week in 1955. I could hang out, you could show me around. Doc. I'm too loud. I can't believe it. I'm never gonna get a chance to play in front of anybody. I'm writing this down, this is good stuff.",
            "Oh no, don't touch that. That's some new specialized weather sensing equipment. Doc, she's beautiful. She's crazy about me. Look at this, look what she wrote me, Doc. That says it all. Doc, you're my only hope. There, there, now, just relax. You've been asleep for almost nine hours now. Yeah, I think it's a major embarrassment having an uncle in prison. It's about the future, isn't it?",
            "Please, Marty, don't tell me, no man should know too much about their own destiny. Give me a hand, Lorenzo. Ow, dammit, man, I sliced my hand. Yeah, I think maybe you do. Yeah, I think it's a major embarrassment having an uncle in prison. Wait a minute, wait a minute, Doc, are you telling me that you built a time machine out of a delorean.",
            "It's uh, the other end of town, a block past Maple. When could weathermen predict the weather, let alone the future. Ahh. You wanna a Pepsi, pall, you're gonna pay for it. Your not gonna be picking a fight, Dad, dad dad daddy-o. You're coming to a rescue, right? Okay, let's go over the plan again. 8:55, where are you gonna be.",
            "oh yeah, all you gotta do is go over there and ask her. Uh, plutonium, wait a minute, are you telling me that this sucker's nuclear? You bet. Whoa, this is heavy. Hey, Doc? Doc. Hello, anybody home? Einstein, come here, boy. What's going on? Wha- aw, god. Aw, Jesus. Whoa, rock and roll. Yo",
            "I'm writing this down, this is good stuff. C'mon, he's not that bad. At least he's letting you borrow the car tomorrow night. Mayor Goldie Wilson, I like the sound of that. Children. His head's gone, it's like it's been erased.",
            "About how far ahead are you going? Oh. George. George. So tell me, Marty, how long have you been in port? One point twenty-one gigawatts. One point twenty-one gigawatts. Great Scott.",
            "Re-elect Mayor Goldie Wilson. Progress is his middle name. Dammit, Doc, why did you have to tear up that letter? If only I had more time. Wait a minute, I got all the time I want I got a time machine, I'll just go back and warn him. 10 minutes oughta do it. Time-circuits on, flux-capacitor fluxing, engine running, alright. No, no no no no, c'mon c'mon. C'mon c'mon, here we go, this time. Please, please, c'mon. Don't tell me anything. Yeah, where does he live? That's a big bruise you have there.",
            "Right. Good evening, I'm Doctor Emmett Brown. I'm standing on the parking lot of Twin Pines Mall. It's Saturday morning, October 26, 1985, 1:18 a.m. and this is temporal experiment number one. C'mon, Einy, hey hey boy, get in there, that a boy, in you go, get down, that's it. Hello. Doc, is that a de- Go.",
            "No, Marty, we've already agreed that having information about the future could be extremely dangerous. Even if your intentions are good, they could backfire drastically. Whatever you've got to tell me I'll find out through the natural course of time. Oh, oh Marty, here's your keys. You're all waxed up, ready for tonight. Uh, well, okay Biff, uh, I'll finish that on up tonight and I'll bring it over first thing tomorrow morning. Holy shit. No, I refuse to except the responsibility."
        ];
        // $isBest = random_int(0, 1);
        $date = new DateTime();

        for ($a = 1; $a <= 33; $a++) {

            $article = new Article();
            $article->setTitre("Article-$a");
            $article->setAuteur($auteurs[array_rand($auteurs)]);
            $article->setContenu($content[array_rand($content)]);
            $article->setDateCreation(new \DateTime('-' . random_int(1, 45) . ' days'));
            $article->setSlug($this->slugger->slug($article->getTitre()));
            $article->setMainPicture($faker->imageUrl(1500, 844, true));
            $article->setBest(random_int(0, 1));

            $this->addReference('article-' . $a, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }
}