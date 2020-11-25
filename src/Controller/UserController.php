<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UploadService;
use App\Service\PutBlobService;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UserController extends AbstractController
{
 /**
 * @Route(
 *      path="/api/admin/users",
 *      methods={"POST"},
 * )
 */
    public function addUser(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, UploadService $uploads, ProfilRepository $profilrepo){
        
        $requestContent = $request->request->all();
        $profil = $profilrepo->find((int)$request->get($requestContent["profil_id"]));
        //dd($requestContent["profil"]);
        $avatar = $uploads->upload('avatar', $request);

        $user = $denormalize->denormalize($requestContent, User::class);
        $user->setAvatar($avatar);
        $user->setProfil($profil);
        $errors = $validator->validate($user);

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
        $em->persist($user);
        $em->flush();
      return new Response('The author is valid! Yes!');

    }

  /**
   * @Route(
   *      name="putUSer",
   *      path="/api/admin/users/{id}",
   *      methods={"PUT"},
   * )
   */
  public function putUser(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, UploadService $uploads, UserRepository $repo, PutBlobService $putblob){
     
    $formateur = $repo->find((int)$request->get("id")); 

    //Récuperation de l'objet dans la base de données
   
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
