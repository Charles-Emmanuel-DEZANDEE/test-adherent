<?php
/**
 * Created by PhpStorm.
 * User: charles-emmanuel
 * Date: 2019-01-25
 * Time: 01:24
 * auteur: Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
 */

namespace App\Services;


use Symfony\Component\HttpFoundation\JsonResponse;

class AdherentService
{
    /**
     * retourne les adhérents et le nombre d'adhérents
     *
     * @param $adherents
     * @return JsonResponse
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function getAdherents ($adherents) {
        $data= [];
        $data['nombre'] = count($adherents);
        $data['adherents'] = $adherents;
        $reponse = new JsonResponse();
        $reponse->setStatusCode(200);
        $reponse->setContent(json_encode($data));
        return $reponse;
    }

    /**
     * retourne un adhérent
     *
     * @param $row
     * @return JsonResponse
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function getAdherent ($row) {

        $reponse = new JsonResponse();
        $reponse->setStatusCode(200);
        $reponse->setContent(json_encode($row));
        return $reponse;
    }
}
