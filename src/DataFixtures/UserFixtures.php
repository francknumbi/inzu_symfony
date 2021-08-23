<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private UserPasswordHasher $hasher;
    //private UserPasswordHasherInterface $
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->hasher= $userPasswordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('demo');
        $user->setPassword($this->hasher->hashPassword($user,'demo'));
        $manager->persist($user);
        $manager->flush();
    }
}
