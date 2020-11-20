<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UserController extends AbstractController
{
 /**
 * @Route(
 *      name="addUSer",
 *      path="/api/admin/users",
 *      methods={"POST"},
 * )
 */
    public function addUser(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator){
        $requestContent = $request->request->all();
        
        $avatar = $request->files->get('avatar');
        $requestContent['avatar'] = fopen($avatar->getRealPath(), 'rb');

        $user = $denormalize->denormalize($requestContent, User::class);
        $user->setAvatar($avatar);
        $errors = $validator->validate($user);

      /* if (count($errors) > 0) {
          /*
          * Uses a __toString method on the $errors variable which is a
          * ConstraintViolationList object. This gives us a nice string
          * for debugging.
          */
         /* $errorsString = (string) $errors;

          return new Response($errorsString);
      } */

      $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
      return new Response('The author is valid! Yes!');

    }

}
