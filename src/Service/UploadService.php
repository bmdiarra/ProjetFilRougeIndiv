<?php
namespace App\Service;

use App\Entity\Profil;
use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ProfilPersister implements ContextAwareDataPersisterInterface
{
    private $em;

    public function __construct(EntityManagerInterface $entitymenager ){
        $this->em = $entitymenager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profil;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data
      //$em = $this->getDoctrine()->getManager();
      $this->em->persist($data);
      $this->em->flush();

      return $data;
    }

    public function remove($data, array $context = [])
    {
      // call your persistence layer to delete $data
      //$em = $this->getDoctrine()->getManager();
      $data->setIsdeleted(true);
      
      $this->em->flush();

      return $data;
    }
}