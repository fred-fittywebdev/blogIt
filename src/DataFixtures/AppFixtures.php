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
            "Hey, Doc, we better back up, we don't have enough roads to get up to 88. I'll get it back to you, alright? Please note that Einstein's clock is in complete synchronization with my control watch. Okay, alright, Saturday is good, Saturday's good, I could spend a week in 1955. I could hang out, you could show me around. Oh, oh a rematch, why, were you cheating?

            Wait a minute. Wait a minute, Doc. Are you telling me that it's 8:25? Well, bring her along. This concerns her too. Here you go, lady. There's a quarter. Of course not, Biff, now I wouldn't want that to happen. Now, uh, I'll finish those reports up tonight, and I'll run em them on over first thing tomorrow, alright? Where does he come from?
            
            I don't know, but I'm gonna find out. No, no, George, look, it's just an act, right? Okay, so 9:00 you're strolling through the parking lot, you see us struggling in the car, you walk up, you open the door and you say, your line, George. Why that's me, look at me, I'm an old man. Doc. No, bastards.
            
            You do? Well, safe and sound, now, n good old 1955. Our first television set, Dad just picked it up today. Do you have a television? Just say anything, George, say what ever's natural, the first thing that comes to your mind. Are you okay?
            
            But you're good, Marty, you're really good. And this audition tape of your is great, you gotta send it in to the record company. It's like Doc's always saying. Doc, you gotta help me. you were the only one who knows how your time machine works. So what's it to you, butthead. You know you've been looking for a, since you're new here, I'm gonna cut you a break, today. So why don't you make like a tree, and get out of here. Huh? I, I don't know.
            
            Erased from existence. Yeah, well history is gonna change. Brown, Brown, Brown, Brown, Brown, great, you're alive. Do you know where 1640 Riverside- No, it was The Enchantment Under The Sea Dance. Our first date. It was the night of that terrible thunderstorm, remember George? Your father kissed me for the very first time on that dance floor. It was then I realized I was going to spend the rest of my life with him. Okay, that's enough. Now stop the microphone. I'm sorry fellas. I'm afraid you're just too darn loud. Next, please. Where's the next group, please.

            ",
            "No no no, Doc, I just got here, okay, Jennifer's here, we're gonna take the new truck for a spin. What did she say? It's your mom, she's tracked you down. Quick, let's cover the time machine. What? Alright, punk, now- Alright, alright, okay McFly, get a grip on yourself. It's all a dream. Just a very intense dream. Woh, hey, listen, you gotta help me.

            Oh, thank you, thank you. Okay now, we run some industrial strength electrical cable from the top of the clocktower down to spreading it over the street between two lamp posts. Meanwhile, we out-fitted the vehicle with this big pole and hook which runs directly into the flux-capacitor. At the calculated moment, you start off from down the street driving toward the cable execrating to eighty-eight miles per hour. According to the flyer, at !0:04 pm lightning will strike the clocktower sending one point twenty-one gigawatts into the flux-capacitor, sending you back to 1985. Alright now, watch this. You wind up the car and release it, I'll simulate the lightening. Ready, set, release. Huhh. C'mon, more, dammit. Jeez. Holy shit. Let's see if you bastards can do ninety. Children. Damn. I'm late for school. Quiet.
            
            No, I refuse to except the responsibility. No, it was The Enchantment Under The Sea Dance. Our first date. It was the night of that terrible thunderstorm, remember George? Your father kissed me for the very first time on that dance floor. It was then I realized I was going to spend the rest of my life with him. Time machine, I haven't invented any time machine. What was it, George, bird watching? Can I go now, Mr. Strickland?
            
            I'm telling the truth, Doc, you gotta believe me. Oh, yeah, yeah. Marty, are you alright? The storm. Welcome to my latest experiment. It's the one I've been waiting for all my life.
            
            Einstein, hey Einstein, where's the Doc, boy, huh? Doc Where's Einstein, is he with you? What? No no no this sucker's electrical, but I need a nuclear reaction to generate the one point twenty-one gigawatts of electricity- Hey.
            
            Thanks. C'mon. Precisely. Alright, alright, okay McFly, get a grip on yourself. It's all a dream. Just a very intense dream. Woh, hey, listen, you gotta help me. Jennifer.
            
            ",
            "Don't say a word. I know, and all I could say is I'm sorry. Whoa, wait a minute, Doc, are you telling me that my mother has got the hots for me? No, not yet. Hello, Jennifer.

            Of course, the Enchantment Under The Sea Dance they're supposed to go to this, that's where they kiss for the first time. Now, Biff, um, can I assume that your insurance is gonna pay for the damage? What do you mean you've seen this, it's brand new. The way I see it, if you're gonna build a time machine into a car why not do it with some style. Besides, the stainless, steel construction made the flux dispersal- look out. I will.
            
            Please note that Einstein's clock is in complete synchronization with my control watch. Its good. What? I'm, I'm sorry, Mr. McFly, I mean, I was just starting on the second coat. Then how am I supposed to ever meet anybody.
            
            Good, you could start by sweeping the floor. Listen, I gotta go but I wanted to tell you that it's been educational. Yeah, gimme a Tab. I'm writing this down, this is good stuff. Einstein, hey Einstein, where's the Doc, boy, huh? Doc
            
            Doc, I'm from the future. I came here in a time machine that you invented. Now, I need your help to get back to the year 1985. Hi. Save the clock tower. Marty, are you alright? I don't know, I can't keep up with all of your boyfriends.
            
            No no no, Doc, I just got here, okay, Jennifer's here, we're gonna take the new truck for a spin. Yeah, it's in the back. Doc. Why thank you, Marty. George. Good morning, sleepyhead, Good morning, Dave, Lynda That's for messing up my hair.
            
            ",
            "Then how am I supposed to ever meet anybody. George. I said the keys are in here. Hey, George, buddy, you weren't at school, what have you been doing all day? That was the day I invented time travel. I remember it vividly. I was standing on the edge of my toilet hanging a clock, the porces was wet, I slipped, hit my head on the edge of the sink. And when I came to I had a revelation, a picture, a picture in my head, a picture of this. This is what makes time travel possible. The flux capacitor.

            On the night I go back in time, you get- Doc. It's information about the future isn't it. I warned you about this kid. The consequences could be disastrous. What's a rerun? Wrecked? Roads? Where we're going we don't need roads.
            
            The keys are in the trunk. Biff. I hope so. Yeah, alright, bye-bye. What? What were you doing in the middle of the street, a kid your age.
            
            Ah. Whoa. Okay. Give me a hand, Lorenzo. Ow, dammit, man, I sliced my hand. Alright kid, you stick to your father like glue and make sure that he takes her to the dance. Sit here, Marty.
            
            I just wanna use the phone. The flux capacitor. Oh, you make it sound so easy. I just, I wish I wasn't so scared. Right. Jesus.
            
            Jesus. Children. I'll get it back to you, alright? You do? Shut your filthy mouth, I'm not that kind of girl.
            
            ",
            "Right check, Doc. It's taken me almost thirty years and my entire family fortune to realize the vision of that day, my god has it been that long. Things have certainly changed around here. I remember when this was all farmland as far as the eye could see. Old man Peabody, owned all of this. He had this crazy idea about breeding pine trees. Now, now, Biff, now, I never noticed any blindspot before when I would drive it. Hi, son. Biff. Nothing's coming to my mind.

            God dammit, I'm late. What do you mean you've seen this, it's brand new. Stop it. Yeah, it's in the back. I know, and all I could say is I'm sorry.
            
            Next, please. A block passed Maple, that's John F. Kennedy Drive. I over slept, look I need your help. I have to ask Lorraine out but I don't know how to do it. I have to ask Lorraine out but I don't know how to do it. Ah. Whoa. Radiation suit, of course, cause all of the fall out from the atomic wars. This is truly amazing, a portable television studio. No wonder your president has to be an actor, he's gotta look good on television.
            
            So what's it to you, butthead. You know you've been looking for a, since you're new here, I'm gonna cut you a break, today. So why don't you make like a tree, and get out of here. Whoa, this is heavy. The flux capacitor. Good, there's somebody I'd like you to meet. Lorraine. I think it's terrible. Girls chasing boys. When I was your age I never chased a boy, or called a boy, or sat in a parked car with a boy.
            
            Yeah well, I saw it on a rerun. Keys? You do? Marty. Marty. Marty. You know, Doc, you left your equipment on all week.
            
            Marty, you seem so nervous, is something wrong? Biff, stop it. Biff, you're breaking his arm. Biff, stop. But, what are you blind McFly, it's there. How else do you explain that wreck out there? Marty, you didn't fall asleep, did you? he's an idiot, comes from upbringing, parents were probably idiots too. Lorraine, if you ever have a kid like that, I'll disown you.
            
            ",
            "I gotta go, uh, I gotta go. Thanks very much, it was wonderful, you were all great. See you all later, much later. Yeah well look, Marvin, Marvin, you gotta play. See that's where they kiss for the first time on the dance floor. And if there's no music, they can't dance, and if they can't dance, they can't kiss, and if they can't kiss, they can't fall in love and I'm history. That's true, Marty, I think you should spend the night. I think you're our responsibility. Where? Yeah, it's in the back.

            I have to tell you about the future. You broke it. Wow, look at him go. I will. That ain't no airplane, look. yes, Joey just loves being in his playpen. he cries whenever we take him out so we just leave him in there all the time. Well Marty, I hope you like meatloaf.
            
            Well just gimme something without any sugar in it, okay? Marty, you're beginning to sound just like my mother. Yeah, exactly. Are those my clocks I hear? Marty, why are you so nervous?
            
            Quiet down, I'm sure the car is fine. You can't, uh, that is, uh, nobody's home. Who is that guy. Excuse me. Of course not, Biff, now I wouldn't want that to happen. Now, uh, I'll finish those reports up tonight, and I'll run em them on over first thing tomorrow, alright?
            
            Don't pay any attention to him, he's in one of his moods. Sam, quit fiddling with that thing, come in here to dinner. Now let's see, you already know Lorraine, this is Milton, this is Sally, that's Toby, and over there in the playpen is little baby Joey. You cost three-hundred buck damage to my car, you son-of-a-bitch. And I'm gonna take it out of your ass. Hold him. Yeah, but I never picked a fight in my entire life. George: you ever think of running for class president? George McFly? Oh, he's kinda cute and all, but, well, I think a man should be strong, so he could stand up for himself, and protect the woman he loves. Don't you?
            
            Please, Marty, don't tell me, no man should know too much about their own destiny. It's uh, the other end of town, a block past Maple. Doc, Doc, it's me, Marty. Whoa, whoa, okay. I don't worry. this is all wrong. I don't know what it is but when I kiss you, it's like kissing my brother. I guess that doesn't make any sense, does it?
            
            ",
            "She's just trying to keep you respectable. Doc. Oh, oh Marty, here's your keys. You're all waxed up, ready for tonight. Well, what if they didn't like them, what if they told me I was no good. I guess that would be pretty hard for somebody to understand. So tell me, Marty, how long have you been in port?

            Never? God dammit, I'm late. Well, because George, nice girls get angry when guys take advantage of them. Sam, quit fiddling with that thing and come in here and eat your dinner. That ain't no airplane, look.
            
            The keys are in the trunk. I think it's terrible. Girls chasing boys. When I was your age I never chased a boy, or called a boy, or sat in a parked car with a boy. Lorraine, have you ever, uh, been in a situation where you know you had to act a certain way but when you got there, you didn't know if you could go through with it? I think we need a rematch. George, there's nothing to be scared of. All it takes is a little self confidence. You know, if you put your mind to it, you could accomplish anything.
            
            George, buddy. remember that girl I introduced you to, Lorraine. What are you writing? She's just trying to keep you respectable. Good, there's somebody I'd like you to meet. Lorraine. Quiet down, I'm sure the car is fine. Uh no, not hard at all. So anyway, George, now Lorraine, she really likes you. She told me to tell you that she wants you to ask her to the Enchantment Under The Sea Dance.
            
            Calvin. What did she say? It's your mom, she's tracked you down. Quick, let's cover the time machine. Yeah, well, I still don't understand what Dad was doing in the middle of the street. Hey man, the dance is over. Unless you know someone else who could play the guitar. About how far ahead are you going?
            
            She's just trying to keep you respectable. Okay. Uncle Jailbird Joey? Can't be. This is nuts. Aw, c'mon. We're gonna take a little break but we'll be back in a while so, don't nobody go no where.
            
            ",
            "That's a big bruise you have there. It's already mutated into human form, shoot it. Well, this is a radiation suit. Lorraine. Does your mom know about tomorrow night?

            What, what? Thank god I still got my hair. What on Earth is that thing I'm wearing? Yoo. His head's gone, it's like it's been erased. Tab? I can't give you a tab unless you order something.
            
            Doc, you gotta help- Lorraine, have you ever, uh, been in a situation where you know you had to act a certain way but when you got there, you didn't know if you could go through with it? Wait a minute, what are you doing, Doc? Alright, I'm ready. What's with the life preserver?
            
            The future, it's where you're going? Without any sugar. Hey boy, are you alright? Doc, Doc. Oh, no. You're alive. Bullet proof vest, how did you know, I never got a chance to tell you. About all that talk about screwing up future events, the space time continuum. Shit.
            
            Marty you gotta come back with me. Well, she's not doing a very good job. You extol me with a lot of confidence, Doc. This is it. This is the answer. It says here that a bolt of lightning is gonna strike the clock tower precisely at 10:04 p.m. next Saturday night. If we could somehow harness this bolt of lightning, channel it into the flux capacitor, it just might work. Next Saturday night, we're sending you back to the future. Oh no, don't touch that. That's some new specialized weather sensing equipment.
            
            What? You cost three-hundred buck damage to my car, you son-of-a-bitch. And I'm gonna take it out of your ass. Hold him. Good evening, I'm Doctor Emmett Brown. I'm standing on the parking lot of Twin Pines Mall. It's Saturday morning, October 26, 1985, 1:18 a.m. and this is temporal experiment number one. C'mon, Einy, hey hey boy, get in there, that a boy, in you go, get down, that's it. Crazy drunk drivers. But I can't go to the dance, I'll miss my favorite television program, Science Fiction Theater.
            
            ",
            "Right. But, what are you blind McFly, it's there. How else do you explain that wreck out there? This is for all you lovers out there. Doc, you don't just walk into a store and ask for plutonium. Did you rip this off? When could weathermen predict the weather, let alone the future.

            Where does he come from? My equipment, that reminds me, Marty, you better not hook up to the amplifier. There's a slight possibility for overload. Hi, Marty. Go. What's that thing he's on?
            
            Kids, we're gonna have to eat this cake by ourselves, Uncle Joey didn't make parole again. I think it would be nice, if you all dropped him a line. Hey not too early I sleep in Sunday's, hey McFly, you're shoe's untied, don't be so gullible, McFly. Marty, one rejection isn't the end of the world. Listen, woh. Hello, uh excuse me. Sorry about your barn. Y'know this time it wasn't my fault. The Doc set all of his clocks twenty-five minutes slow.
            
            Did you hurt your head? What about George? Precisely. Well, ma, we talked about this, we're not gonna go to the lake, the car's wrecked. I, I don't know.
            
            Stop it. Well, you mean, it makes perfect sense. You want it, you know you want it, and you know you want me to give it to you. No, why, what's a matter? Just say anything, George, say what ever's natural, the first thing that comes to your mind.
            
            About 30 years, it's a nice round number. I don't worry. this is all wrong. I don't know what it is but when I kiss you, it's like kissing my brother. I guess that doesn't make any sense, does it? Yeah, who are you? Great Scott. Let me see that photograph again of your brother. Just as I thought, this proves my theory, look at your brother. You extol me with a lot of confidence, Doc.
            
            ",
            "C'mon, open up, let me out of here, Yo. Well gee, I don't know. Looks like a airplane, without wings. Hi, Marty. Marty, you seem so nervous, is something wrong?

            My insurance, it's your car, your insurance should pay for it. Hey, I wanna know who's gonna pay for this? I spilled beer all over it when that car smashed into me. Who's gonna pay my cleaning bill? Uh no, not hard at all. So anyway, George, now Lorraine, she really likes you. She told me to tell you that she wants you to ask her to the Enchantment Under The Sea Dance. Let's go. Excuse me. Excuse me.
            
            I'm gonna be at the dance. Hey man, the dance is over. Unless you know someone else who could play the guitar. That's true, Marty, I think you should spend the night. I think you're our responsibility. I have to tell you about the future. Right, okay, so right around 9:00 she's gonna get very angry with me.
            
            Alright, let's set your destination time. This is the exact time you left. I'm gonna send you back at exactly the same time. It's be like you never left. Now, I painted a white line on the street way over there, that's where you start from. I've calculated the distance and wind resistance fresh to active from the moment the lightning strikes, at exactly 7 minutes and 22 seconds. When this alarm goes off you hit the gas. Marty, is that you? Pa, what is it? What is it, Pa? Whoa, this is heavy. Can't be. This is nuts. Aw, c'mon.
            
            Well, Marty, I'm almost eighteen-years-old, it's not like I've never parked before. This Saturday night, mostly clear, with some scattered clouds. Lows in the upper forties. Just turn around, McFly, and walk away. Are you deaf, McFly? Close the door and beat it. Well, Marty, I'm almost eighteen-years-old, it's not like I've never parked before. I'm, I'm sorry, Mr. McFly, I mean, I was just starting on the second coat.
            
            Alright, I'm ready. C'mon, c'mon. Don't worry, I'll take care of the lightning, you take care of your pop. By the way, what happened today, did he ask her out? Right. Hello, hello, anybody home? Think, McFly, think. I gotta have time to recopy it. Do your realize what would happen if I hand in my homework in your handwriting? I'd get kicked out of school. You wouldn't want that to happen would you, would you?
            
            "
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
            $article->setBest(false);

            $this->addReference('article-' . $a, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }
}