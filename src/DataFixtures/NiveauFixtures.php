<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Niveau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class NiveauFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_NIVEAU1_REFERENCE = 'admin-niveau1';
    public const ADMIN_NIVEAU2_REFERENCE = 'admin-niveau2';
    public const ADMIN_NIVEAU3_REFERENCE = 'admin-niveau3';

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 

        $niveau1 = new Niveau();
        $niveau1->setLibelle("niveau 1");
        $manager ->persist ($niveau1 );

        $niveau2 = new Niveau();
        $niveau2->setLibelle("niveau 2");
        $manager ->persist ($niveau2);

        $niveau3 = new Niveau();
        $niveau3->setLibelle("niveau 3");
        $manager ->persist ($niveau3);

        $manager ->flush();  


        $this->addReference(self::ADMIN_NIVEAU1_REFERENCE, $niveau1);
        $this->addReference(self::ADMIN_NIVEAU2_REFERENCE, $niveau2);
        $this->addReference(self::ADMIN_NIVEAU3_REFERENCE, $niveau3);
   }

   public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    } 

   
}