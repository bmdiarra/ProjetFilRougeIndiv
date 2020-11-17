<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
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

        /* $profils = ["ADMIN", "FORMATEUR", "APPRENANT", "CM"];
        foreach ($profils as $key => $libelle) {
        $profil =new Profil() ;
        $profil ->setLibelle ($libelle );
        $manager ->persist ($profil );
        }
        $manager ->flush(); */
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            UserFixtures::class
        );
    }
}