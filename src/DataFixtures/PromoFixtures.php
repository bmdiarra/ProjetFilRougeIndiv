<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        
        for ($i=0 ; $i < 3 ; $i++) { 
        $promo =new Promo() ;
        $promo ->setLibelle('promo'.$i);
        
        $manager ->persist ($promo );
        }

        $manager ->flush();  
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            NiveauFixtures::class
        );
    } 

   
}