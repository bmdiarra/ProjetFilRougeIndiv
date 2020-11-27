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

class CompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_COMPETENCE1_REFERENCE = 'admin-competence1';
    public const ADMIN_COMPETENCE2_REFERENCE = 'admin-competence2';
    public const ADMIN_COMPETENCE3_REFERENCE = 'admin-competence3';

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 
        $groupecompetence = new GroupeCompetence();
        $groupecompetence->setLibelle("Groupe Competence 1");
        $manager->persist($groupecompetence);
        $manager->flush();
         
        $competence1 =new Competence() ;
        $competence1->setLibelle("Competence1");
        $competence1->setDescription("Description1");
        $competence1->setArchivage(false);
        $competence1->setNiveaux($this->getReference(NiveauFixtures::ADMIN_NIVEAU1_REFERENCE));
        $competence1->addGroupescompetence($groupecompetence);
        $manager ->persist ($competence1 );

        $competence2 =new Competence() ;
        $competence2->setLibelle("Competence2");
        $competence2->setDescription("Description2");
        $competence2->setArchivage(false);
        $competence1->setNiveaux($this->getReference(NiveauFixtures::ADMIN_NIVEAU2_REFERENCE));
        $manager ->persist ($competence2 );

        $competence3 =new Competence() ;
        $competence3->setLibelle("Competence2");
        $competence3->setDescription("Description2");
        $competence3->setArchivage(false);
        $manager ->persist ($competence3 );

        $manager ->flush();  

        $this->addReference(self::ADMIN_COMPETENCE1_REFERENCE, $competence1);
        $this->addReference(self::ADMIN_COMPETENCE2_REFERENCE, $competence2);
        $this->addReference(self::ADMIN_COMPETENCE3_REFERENCE, $competence3);
        
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
            NiveauFixtures::class
        );
    } 

   
}