<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilFixtures extends Fixture
{
    public const ADMIN_PROFIL_REFERENCE = 'admin-profil';
    public const FORMATEUR_PROFIL_REFERENCE = 'formateur-profil';
    public const APPRENANT_PROFIL_REFERENCE = 'apprenant-profil';
    public const CM_PROFIL_REFERENCE = 'cm-profil';

    public function load(ObjectManager $manager) 
    {
        $profilAdmin = new Profil();
        $profilAdmin ->setLibelle ('ADMIN');
        $profilAdmin ->setIsdeleted (false);
        $manager->persist($profilAdmin);

        $profilFormateur = new Profil();
        $profilFormateur ->setLibelle ('FORMATEUR');
        $profilFormateur ->setIsdeleted (false);
        $manager->persist($profilFormateur);

        $profilApprenant = new Profil();
        $profilApprenant ->setLibelle ('APPRENANT');
        $profilApprenant ->setIsdeleted (false);
        $manager->persist($profilApprenant);

        $profilCm = new Profil();
        $profilCm ->setLibelle ('CM');
        $profilCm ->setIsdeleted (false);
        $manager->persist($profilCm);

        $manager->flush();

        $this->addReference(self::ADMIN_PROFIL_REFERENCE, $profilAdmin);
        $this->addReference(self::FORMATEUR_PROFIL_REFERENCE, $profilFormateur);
        $this->addReference(self::APPRENANT_PROFIL_REFERENCE, $profilApprenant);
        $this->addReference(self::CM_PROFIL_REFERENCE, $profilCm);
    }

    
}