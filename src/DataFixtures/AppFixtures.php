<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Catalog;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 3; $i++) {
            $catalog = new Catalog();
            $catalog->setName("product number ".$i);
            $catalog->setDescription("this is my description");
            $catalog->setPhoto("we have no photo yet");
            $catalog->setPrice($i);
            $manager->persist($catalog);
        }
        $manager->flush();
    }
}
