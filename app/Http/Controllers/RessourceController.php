<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class RessourceController extends Controller
{
    //
    function getRealTimeReportId($client, $objetId, $dateDebut, $dateFin) {

        $response = $client->request('GET', '/v2/reports/trip', [
            'query' => [
                'objectId' => $objetId,
                'startTime' => $dateDebut,
                'endTime' => $dateFin
            ]
        ]);

        $data = json_decode($response->getBody()->getContents());

        // Récupérer l'id du premier rapport
        $reportId = $data[0]->id;

        return $reportId;

    }

}
