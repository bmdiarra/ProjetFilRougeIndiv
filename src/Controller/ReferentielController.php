<?php

namespace App\Controller;

use App\Repository\ReferentielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ReferentielController extends AbstractController
{
    /**
     * @Route(
     *  path="/api/admin/referentiels/{id}/grpescompetences/{id2}", 
     *  name="getreferentielidgrpescompetencesid", 
     *  methods={"GET"}
     * )
     */
    public function getrefidgrpsrefid(Request $request, DenormalizerInterface $denormalize, ValidatorInterface $validator, ReferentielRepository $repo){
        
        $ref = $repo->findidrefidgrpescomp( (int)$request->get("id"), (int)$request->get("id2"));
        dd($ref);
    }
    


}
