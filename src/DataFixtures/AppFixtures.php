<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user1 = new User();
        $user1->setData('Barack - Obama - White House');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setData('Britney - Spears - America');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setData('Leonardo - DiCaprio - Titanic');
        $manager->persist($user3);

        $manager->flush();
    }
}
