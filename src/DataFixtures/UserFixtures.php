<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Fred');
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$QgijFoIys6e9EU0eW7iRkA$dAk9ydZ2jrsot6v2c52hkKyrraHG0jLyF7N9d+coCQg');

        $manager->persist($user);

        $user = new User();
        $user->setUsername('Lilie');
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$UlCqVpe5YzsfYgErrw9ihA$0W1qwHe0j84fQQQzON7d/gwCorCqmU74h4acqapoDzE');

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('Admin');
        $admin->setPassword('$argon2id$v=19$m=65536,t=4,p=1$oA9CECG/jrh/aY39TNe1Ow$lVweMb8glzuVCo9VjEA/tFCdqttdhIHeouokr6kkFqk');
        $admin->setRoles(['ROLE_ADMIN']);


        $manager->persist($admin);

        $manager->flush();
    }
}