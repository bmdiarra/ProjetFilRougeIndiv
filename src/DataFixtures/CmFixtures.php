<?php

namespace App\DataFixtures;

use App\Entity\Cm;
use Faker\Factory;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CmFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        $faker = Factory::create('fr_FR');
        
        for ($i=0 ; $i < 3 ; $i++) { 
        $cm =new Cm() ;
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