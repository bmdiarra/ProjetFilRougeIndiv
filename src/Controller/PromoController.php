<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromoController extends AbstractController
{
    /**
     * @Route(
     *  path="/api/admin/promo/principal", 
     *  name="getpromosprincipal", 
     *  methods={"GET"}
     * )
     */
    public function getpromogrpeprincipal(Request $request, PromoRepository $repo){
        
        $ref = $repo->findByGroupePrincipal("principal");
        return $this->json($ref, Response::HTTP_OK, [], );
    }

    /**
     * @Route(
     *  path="/api/admin/promo/apprenants/attente", 
     *  name="getpromosidapprenantsattente", 
     *  methods={"GET"}
     * )
     */
    public function findByApprAttente(Request $request, PromoRepository $repo){
        
        $ref = $repo->findByApprenantAttente("attente");
        return $this->json($ref, Response::HTTP_OK, [], );
    }
    

    /**
     * @Route(
     *  path="/api/admin/promo/{id}/principal", 
     *  name="getpromosidprincipal", 
     *  methods={"GET"}
     * )
     */
    public function getpromoidgrpeprincipal(Request $request, PromoRepository $repo){
        
        $ref = $repo->findByidGroupePrincipal((int)$request->get("id"), "principal");
        return $this->json($ref, Response::HTTP_OK, [], );
    }
    

    /**
     * @Route(
     *  path="/api/admin/promo/{id}/apprenants/attente", 
     *  name="getpromosidapprenantsattente", 
     *  methods={"GET"}
     * )
     */
    public function findByidApprAttente(Request $request, PromoRepository $repo){
        
        $ref = $repo->findByidApprenantAttente((int)$request->get("id"), "attente");
        return $this->json($ref, Response::HTTP_OK, [], );
    }
    
    /**
     * @Route(
     *  path="/api/admin/promo/{id}/groupes/{id2}/apprenants", 
     *  name="getpromosidgrpeidapprenants", 
     *  methods={"GET"}
     * )
     */
    public function getByidGrpidAppr(Request $request, PromoRepository $repo){
        
        $ref = $repo->findByidGrpidAppr((int)$request->get("id"), (int)$request->get("id2"));
        return $this->json($ref, Response::HTTP_OK, [], );
    }

}
