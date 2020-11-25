<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Service\UploadService;
use App\Repository\FormateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FormateurController extends AbstractController
{
    
    /**
     * @Route("/api/formateurs", name="postFormateurs", methods={"POST"})
     */
    public function postFormateurs(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, UploadService $uploads)
    {
        $requestContent = $request->request->all();
        $avatar = $uploads->upload('avatar', $request);

        $formateur = $denormalize->denormalize($requestContent, Formateur::class);
        $formateur->setAvatar($avatar);
        $errors = $validator->validate($formateur);

        if ($errors != NULL) {
          /*
          * Uses a __toString method on the $errors variable which is a
          * ConstraintViolationList object. This gives us a nice string
          * for debugging.
          */
         $errorsString = (string) $errors;

          return new Response($errorsString);
      }

      $em = $this->getDoctrine()->getManager();
        $em->persist($formateur);
        $em->flush();
      return new Response('The author is valid! Yes!');
    }


  /**
   * @Route(
   *      name="putFormateurs",
   *      path="/api/formateurs/{id}",
   *      methods={"POST"},
   * )
   */
  public function putFormateur(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, UploadService $uploads, FormateurRepository $repo){
      
    $requestContent = $request->request->all();
    $formateur = $repo->find((int)$request->get("id"));
    $avatar = $uploads->upload('avatar', $request);

    $formateur = $denormalize->denormalize($requestContent, Formateur::class);
    $formateur->setAvatar($avatar);

    $errors = $validator->validate($formateur);
    
     // if (count($errors) > 0)
      if ($errors != NULL) {
          
          /* Uses a __toString method on the $errors variable which is a
          * ConstraintViolationList object. This gives us a nice string
          * for debugging.
          */
         $errorsString = (string) $errors;

          return new Response($errorsString);
      }

    $em = $this->getDoctrine()->getManager();
    $em->persist($formateur);
    $em->flush();
    return new Response('The author is valid! Yes!');

  }

}
