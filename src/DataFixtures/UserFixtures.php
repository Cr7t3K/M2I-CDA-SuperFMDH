<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPassword($this->passwordHasher->hashPassword(
                    $user,
                    'password'
                ))
            ;

            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }
        $manager->flush();

        $user = new User();
        $user
            ->setEmail('user@mail.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
            ->setIsVerified(true)
        ;
        $this->addReference('user_4', $user);
        $manager->persist($user);

        $admin = new User();
        $admin
            ->setEmail('admin@mail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordHasher->hashPassword($admin, 'adminPassword'))
            ->setIsVerified(true)
        ;
        $this->addReference('admin', $admin);
        $manager->persist($admin);

        $manager->flush();
    }
}
