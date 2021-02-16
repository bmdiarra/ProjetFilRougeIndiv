<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Profil;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public const ADMIN_APPRENANT1_REFERENCE = 'admin-apprenant1';

    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        $faker = Factory::create('fr_FR');
        
        for ($i=0 ; $i < 2 ; $i++) { 
        $apprenant =new Apprenant() ;
        $apprenant ->setUsername('APPRENANT'.$i);
        $apprenant ->setProfil ($this->getReference(ProfilFixtures::APPRENANT_PROFIL_REFERENCE));
        $apprenant ->setPrenom ($faker->firstName);
        $apprenant ->setNom ($faker->lastName);
        //$apprenant ->setIsdeleted ('no');
        $password = $this->encoder->encodePassword($apprenant, 'pass1234');
        $apprenant ->setPassword($password);
        $manager ->persist ($apprenant );
        }

        //for ($i=3 ; $i < 5 ; $i++) { 
            $apprenant =new Apprenant() ;
            $apprenant ->setUsername('APPRENANT3');
            $apprenant ->setProfil ($this->getReference(ProfilFixtures::APPRENANT_PROFIL_REFERENCE));
            $apprenant ->setPrenom ($faker->firstName);
            $apprenant ->setNom ($faker->lastName);
            $apprenant ->setStatut ("attente");
            //$apprenant ->setIsdeleted ('no');
            $password = $this->encoder->encodePassword($apprenant, 'pass1234');
            $apprenant ->setPassword($password);
            $manager ->persist ($apprenant );
            $this->addReference(self::ADMIN_APPRENANT1_REFERENCE, $apprenant);
            

        $manager ->flush();  

        //$this->addReference(self::ADMIN_APPRENANT1_REFERENCE, )
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class
        );
    } 

   
}