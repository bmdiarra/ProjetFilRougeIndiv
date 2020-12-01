<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ReferentielFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        
        for ($i=0 ; $i < 3 ; $i++) { 
        $ref =new Referentiel() ;
        $ref ->setLibelle('ref'.$i);
        $ref->addGroupecompetence($this->getReference(GroupeCompetenceFixtures::ADMIN_GRPECOMPETENCE1_REFERENCE));
        $manager ->persist ($ref );
        }

        $manager ->flush();  
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            NiveauFixtures::class,
            GroupeCompetenceFixtures::class
        );
    } 

   
}