<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Profil;
use App\Entity\Formateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormateurFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        $faker = Factory::create('fr_FR');
        
        for ($i=0 ; $i < 3 ; $i++) { 
        $formateur =new Formateur() ;
        $formateur ->setUsername('FORMATEUR'.$i);
        $formateur ->setProfil ($this->getReference(ProfilFixtures::FORMATEUR_PROFIL_REFERENCE));
        $formateur ->setPrenom ($faker->firstName);
        $formateur ->setNom ($faker->lastName);
      //  $formateur ->setIsdeleted ('no');
        $password = $this->encoder->encodePassword($formateur, 'pass1234');
        $formateur ->setPassword($password);
        $manager ->persist ($formateur );
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