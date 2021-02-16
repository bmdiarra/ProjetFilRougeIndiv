<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GroupeFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public const ADMIN_GROUPE1_REFERENCE = 'admin-groupe1';

    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        
        for ($i=0 ; $i < 2 ; $i++) { 
        $groupe =new Groupe() ;
        $groupe ->setStatut('principal');
        $manager ->persist ($groupe );
        }

        $groupe3 =new Groupe() ;
        $groupe3 ->setStatut('principal');
        $groupe3 ->addApprenant($this->getReference(ApprenantFixtures::ADMIN_APPRENANT1_REFERENCE));
        $manager ->persist ($groupe3 );

        $manager ->flush();  

        $this->addReference(self::ADMIN_GROUPE1_REFERENCE, $groupe3);
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            NiveauFixtures::class,
            ApprenantFixtures::class
        );
    } 

   
}