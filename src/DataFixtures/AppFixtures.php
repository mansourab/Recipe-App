<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        
        for($i = 0; $i < 50; $i++) {
            
            $recipe = new Recipe();

            $recipe
                ->setTitle($faker->sentence())
                ->setContent($faker->paragraph())
                ->setCreatedAt($faker->dateTime())
                ->setUpdatedAt($faker->dateTime())
            ;

            $manager->persist($recipe);

        }
        
        $manager->flush();
    }
}
