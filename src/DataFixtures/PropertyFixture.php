<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $properties = Array();
        $facker = Factory::create('fr_FR');
        for($i =0; $i <100;$i++){
            $properties[$i] = new Property();
            $properties[$i]
                ->setTitle(ucfirst($facker->words(3,true)))
                ->setDescription(ucfirst($facker->sentence( 3,true)))
                ->setRooms($facker->numberBetween(2,10))
                ->setBedrooms($facker->numberBetween(1,9))
                ->setSurface($facker->numberBetween(20,350))
                ->setFloor($facker->numberBetween(0,15))
                ->setPrice($facker->numberBetween(100000,1000000))
                ->setHeat($facker->numberBetween(0,count(Property::HEAT)-1))
                ->setCity($facker->city)
                ->setAddress($facker->city)
                ->setPostalCode($facker->postcode)
                ->setSold(false);
            $manager->persist($properties[$i]);
        }
        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);
    }
}
