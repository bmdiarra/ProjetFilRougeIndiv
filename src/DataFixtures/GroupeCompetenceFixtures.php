<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use App\DataFixtures\NiveauFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GroupeCompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_GRPECOMPETENCE1_REFERENCE = 'admin-grpecompetence1';

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        $groupecompetence = new GroupeCompetence();
        $groupecompetence->setLibelle("Groupe Competence 1");
        $groupecompetence->addCompetence($this->getReference(CompetenceFixtures::ADMIN_COMPETENCE1_REFERENCE));
        $manager->persist($groupecompetence);
        $manager->flush();
         

        $manager ->flush();  

        $this->addReference(self::ADMIN_GRPECOMPETENCE1_REFERENCE, $groupecompetence);
        
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            NiveauFixtures::class,
            CompetenceFixtures::class,
        );
    } 

   
}