<?php
/**
 * Created by PhpStorm.
 * User: charles-emmanuel
 * Date: 2019-01-24
 * Time: 23:18
 * auteur: Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
 */

namespace App\Controller;


use App\Services\AdherentService;
use App\Services\CSVService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    /**
     * @param CSVService $CSVService
     * @param AdherentService $adherentService
     * @param int|null $id
     * @return JsonResponse
     * @Route("/adherents/{id}", name="adherent")
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function adherents( CSVService $CSVService, AdherentService $adherentService, $id = null)
    {
        $reponse = new JsonResponse();
        // on test si le fichier existe
        if ($CSVService->CSVExist()){
            // on récupére tous les adhérents
            if ($id == null) {
                //on test si le fichier est vide
                if ($CSVService->CSVEmpty()){
                    $reponse = $adherentService->getAdherents($CSVService->getAllRows());
                } else {
                    $reponse->setStatusCode(404);
                    $reponse->setContent("Aucun adhérent n’est présent");
                }
            } else {
                // on test si l'adhérent existe
                if ($CSVService->getOneRow($id) != null) {
                    $reponse = $adherentService->getAdherent($CSVService->getOneRow($id));
                } else {
                    $reponse->setStatusCode(404);
                    $reponse->setContent(" Aucun adhérent ne correspond à votre demande");
                }
            }
        }
        else {
            $reponse->setContent("Le fichier d’entrée est introuvable");
            $reponse->setStatusCode(404);
        }
        return $reponse;
    }

}
