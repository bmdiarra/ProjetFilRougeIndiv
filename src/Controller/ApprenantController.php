<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Service\UploadService;
use App\Service\PutBlobService;
use App\Repository\ApprenantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ApprenantController extends AbstractController
{

    /**
     * @Route("/api/apprenants", name="postApprenants")
     */
    public function postApprenants(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, UploadService $uploads)
    {
        $requestContent = $request->request->all();
        $avatar = $uploads->upload('avatar', $request);

        $apprenant = $denormalize->denormalize($requestContent, Apprenant::class);
        $apprenant->setAvatar($avatar);
        $errors = $validator->validate($apprenant);

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
        $em->persist($apprenant);
        $em->flush();
      return new Response('The author is valid! Yes!');
    }


  /**
   * @Route(
   *      name="putApprenants",
   *      path="/api/apprenants/{id}",
   *      methods={"PUT"},
   * )
   */
  public function putApprenant(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, UploadService $uploads, ApprenantRepository $repo, PutBlobService $putblob ){
      
   // $requestContent = $request->request->all();
    $apprenant = $repo->find((int)$request->get("id"));
    //$avatar = $uploads->upload('avatar', $request);


    
    $data = $putblob->putData($request, 'avatar');
    foreach ($data as $k => $v) {
        $setter = 'set' . ucfirst($k);
        if (!method_exists($apprenant, $setter)) {
            return new Response("La méthode $setter() n'éxiste pas dans l'entité User");
        }
        $apprenant->$setter($v);
    }
    $em = $this->getDoctrine()->getManager();
    $em->persist($apprenant);
    $em->flush();

    return new JsonResponse("success", Response::HTTP_CREATED, [], true);

  }
}


/* 
$apprenant = $denormalize->denormalize($requestContent, Apprenant::class);
$apprenant->setAvatar($avatar);

$errors = $validator->validate($apprenant);
 */
 // if (count($errors) > 0)
 // if ($errors != NULL) {
      
      /* Uses a __toString method on the $errors variable which is a
      * ConstraintViolationList object. This gives us a nice string
      * for debugging.
      */
  /*    $errorsString = (string) $errors;

      return new Response($errorsString);
  }

$em = $this->getDoctrine()->getManager();
$em->persist($apprenant);
$em->flush();
return new Response('The author is valid! Yes!');
 */