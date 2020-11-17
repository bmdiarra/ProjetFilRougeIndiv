<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder ){
        
        $this->encoder=$encoder;

    }

     public function load(ObjectManager $manager)
    { 

        
        for ($i=0 ; $i < 3 ; $i++) { 
        $user =new User() ;
        $user ->setLogin('ADMIN'.$i);
        $user ->setRoles (array(
                $this->getReference(ProfilFixtures::ADMIN_PROFIL_REFERENCE)->getLibelle(),
            ));
        $password = $this->encoder->encodePassword($user, 'pass1234');
        $user ->setPassword($password);
        $manager ->persist ($user );
        }

        for ($i=0 ; $i < 3 ; $i++) { 
            $user =new User() ;
            $user ->setLogin('FORMATEUR'.$i);
            $user ->setRoles (array(
                    $this->getReference(ProfilFixtures::FORMATEUR_PROFIL_REFERENCE)->getLibelle(),
                ));
            $password = $this->encoder->encodePassword($user, 'pass1234');
            $user ->setPassword($password);
            $manager ->persist ($user );
            }

            for ($i=0 ; $i < 3 ; $i++) { 
                $user =new User() ;
                $user ->setLogin('APPRENANT'.$i);
                $user ->setRoles (array(
                        $this->getReference(ProfilFixtures::APPRENANT_PROFIL_REFERENCE)->getLibelle(),
                    ));
                $password = $this->encoder->encodePassword($user, 'pass1234');
                $user ->setPassword($password);
                $manager ->persist ($user );
                }

                for ($i=0 ; $i < 3 ; $i++) { 
                    $user =new User() ;
                    $user ->setLogin('CM'.$i);
                    $user ->setRoles (array(
                            $this->getReference(ProfilFixtures::CM_PROFIL_REFERENCE)->getLibelle(),
                        ));
                    $password = $this->encoder->encodePassword($user, 'pass1234');
                    $user ->setPassword($password);
                    $manager ->persist ($user );
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