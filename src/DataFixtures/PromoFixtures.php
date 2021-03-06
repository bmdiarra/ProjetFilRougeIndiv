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
    public const ADMIN_PROMO3_REFERENCE = 'admin_promo3_reference';

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        
        for ($i=0 ; $i < 2 ; $i++) { 
        $promo =new Promo() ;
        $promo ->setLibelle('promo'.$i);
        
        $manager ->persist ($promo );

        }

        $promo3 =new Promo() ;
        $promo3 ->setLibelle('promo'.$i);
        $promo ->setGroupes($this->getReference(GroupeFixtures::ADMIN_GROUPE1_REFERENCE));
        $manager ->persist ($promo3 );

        $manager ->flush();  

        $this->addReference(self::ADMIN_PROMO3_REFERENCE, $promo3);
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            NiveauFixtures::class,
            GroupeFixtures::class
        );
    } 

   
}