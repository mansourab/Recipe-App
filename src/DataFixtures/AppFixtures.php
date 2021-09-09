<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);

        
        for($i = 0; $i < 12; $i++) {
            
            $post = new Post();

            $post->setTitre($faker->sentence());
            $post->setDescription($faker->paragraph());

            $manager->persist($post);
        }
        
        $manager->flush();
    }
}
