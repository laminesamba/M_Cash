<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        
        $role = new Role();
        $role->setLibelle('SUP_ADMIN');
        $manager->persist($role);
        $user= new User();
        $user->setPassword($this->encoder->encodePassword($user, "laminho92"));
        $user->setPrenom('Mahomed');
        $user->setNom('samba');
        $user->setUsername('lamine');
        $user->setRole($role);
        $user->setRoles(['ROLE_'.$role->getLibelle()]);
        $user->setIsActive(true);
        $manager->persist($role);
        $manager->persist($user);
        $manager->flush();
    }
}
