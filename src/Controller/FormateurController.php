<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Service\UploadService;
use App\Service\PutBlobService;
use App\Repository\FormateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
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
   *      methods={"PUT"},
   * )
   */
  public function putFormateur(Request $request, DenormalizerInterface $denormalize, SerializerInterface $serializer, ValidatorInterface $validator, UploadService $uploads, FormateurRepository $repo, PutBlobService $putblob){
    
    //$requestContent = $request->request->all();
    $formateur = $repo->find((int)$request->get("id")); 
    
        $data = $putblob->putData($request, 'avatar');
        foreach ($data as $k => $v) {
            $setter = 'set' . ucfirst($k);
            if (!method_exists($formateur, $setter)) {
                return new Response("La méthode $setter() n'éxiste pas dans l'entité User");
            }
            $formateur->$setter($v);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($formateur);
        $em->flush();

        return new JsonResponse("success", Response::HTTP_CREATED, [], true);

}
}