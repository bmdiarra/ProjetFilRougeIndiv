<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        
        
        for ($i=0 ; $i < 3 ; $i++) { 
        $cm =new Competences() ;
        $cm ->setUsername('CM'.$i);
        $cm ->setProfil ($this->getReference(ProfilFixtures::CM_PROFIL_REFERENCE));
        $cm ->setPrenom ($faker->firstName);
        $cm ->setNom ($faker->lastName);
       // $cm ->setIsdeleted ('no');
        $password = $this->encoder->encodePassword($cm, 'pass1234');
        $cm ->setPassword($password);
        $manager ->persist ($cm );
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