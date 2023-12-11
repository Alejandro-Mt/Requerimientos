<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificacionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function stnotify($idSC,$message){
        $url = 'https://servicionotificaciones-preproduction-mb3clvz7ya-uc.a.run.app/api/v1/messagenotification';
        $data = [
            "reasonId" => 0,
            "notificationTypeId" => 0,
            "parameters" => "SMART PLANNER|$message|$idSC|68|1|6",
            "userIdAct" => 1,
            "url" => "",
            "scheduledDate" => null,
            "xml" => "",
            "html" => "",
            "type" => "",
            "path" => "",
            "fileName" => ""
        ];
    
        try {
            $response = Http::post($url, $data);
    
            // Verifica el código de respuesta y toma acciones apropiadas
            if ($response->successful()) {
                // Acciones si la solicitud fue exitosa
                return $response->json();
            } else {
                // Acciones si la solicitud falló
                return $response->status();
            }
        } catch (\Exception $e) {
            // Captura de excepciones si ocurre algún error en la solicitud
            return $e->getMessage();
        }
    }
}
