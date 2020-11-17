<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Profil;
use App\Entity\User;

class AppFixtures extends Fixture
{
    /* public function load(ObjectManager $manager)
    { */
        // $product = new Product();
        // $manager->persist($product);

     /*    $manager->flush();
    } */

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 

        $profils = ["ADMIN", "FORMATEUR", "APPRENANT", "CM"];
        foreach ($profils as $key => $libelle) {
        $profil =new Profil() ;
        $profil ->setLibelle ($libelle );
        $manager ->persist ($profil );
        }
        $manager ->flush();
    
   }
}