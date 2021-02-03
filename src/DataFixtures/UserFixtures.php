<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@jsirecipe.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, 'userpassword'
        ));
        $user->setPseudo('Jeanne');
        $user->setRoles(['ROLE_USER']);
        $this->addReference('user', $user);
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('admin@jsirecipe.com');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin, 'adminpassword'
        ));
        $admin->setPseudo('Admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
    }
}
