<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        
        for ($i=0 ; $i < 3 ; $i++) { 
        $admin =new Admin() ;
        $admin ->setUsername('ADMIN'.$i);
        $admin ->setProfil ($this->getReference(ProfilFixtures::ADMIN_PROFIL_REFERENCE));
        $password = $this->encoder->encodePassword($admin, 'pass1234');
        $admin ->setPassword($password);
        $manager ->persist ($admin );
        }

        $manager ->flush();  
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    } 

   
}