<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Beer;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Country;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=0;$i<4;$i++) {
            $country = new Country();
            $country->setName($faker->country);
            $country->setAddress($faker->address);
            $country->setEmail($faker->email);
            $manager->persist($country);

        }

        $manager->flush();

        $category = new Category();
        $category->setName('Blonde');
        $category->setDescription($faker->catchPhrase);
        
        $manager->persist($category);

        $category = new Category();
        $category->setName('Ambrée');
        $category->setDescription($faker->catchPhrase);

        $manager->persist($category);
        $manager->flush();
        
        $repoCountry = $manager->getRepository(Country::class);
        $countries = $repoCountry->findAll();    
        
        $repoCategory = $manager->getRepository(Category::class);
        $categories = $repoCategory->findAll();
        
        for ($i = 0; $i < 4; $i++) {
            $beer = new Beer();
            $beer->setName($faker->name);
            $beer->setDescription($faker->company);
            $beer->setPublishedAt($faker->dateTime);  
            $beer->setDegree($faker->randomFloat(1,0,10));
            $beer->setPrice($faker->randomFloat(2,0,50));
            $beer->setRating($faker->randomDigitNotNull);
            $beer->setCountry($countries[rand(0,3)]);
            $beer->addCategory($categories[0]);
            $beer->setStatus($faker->randomElement($array = array ('available','unavailable')));
            
            $manager->persist($beer);
        }    
        
        $beer = new Beer();
        $beer->setName('Ardèche');
        $beer->setDescription($faker->company);
        $beer->setPublishedAt($faker->dateTime);  
        $beer->setDegree($faker->randomFloat(1,0,10));
        $beer->setRating($faker->randomDigitNotNull);
        $beer->setCountry($countries[rand(0,3)]);
        $beer->addCategory($categories[0]);
        $beer->addCategory($categories[1]);
        $beer->setStatus($faker->randomElement($array = array ('available','unavailable')));
        
        $manager->persist($beer);

        $manager->flush();     
        
        for ($i = 0; $i < 5; $i++) {
            $client = new Client();
            $client->setName($faker->name);
            $client->setEmail($faker->email);
            $client->setConso($faker->randomDigit);

            
            $manager->persist($client);
        }   
        
        $manager->flush();     
    }
}
