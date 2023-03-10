<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\TemplateDocxEngine;

class GeneratorController extends Controller
{
    public function generate(){
        //Parametros

        $data = (object) array(
            "nombre" => 'René',
            "app" => 'Corona',
            "apm" => 'Valdes',
            "sexo" => "M",
            "fechaNacimiento" => "10/03/1989",
            "nss" => "001100110011",
            "curp" => "COVR890310HMNRLN04",
            "rfc" => "COVR890310QX4",
            "email" => "isc.corona@upn164.edu.mx",
            "domicilio" => "Ignacio Ramirez Norte #9",
            "colonia" => "Miguel Hidalgo",
            "cp" => "61500",
            "ciudad" => "Zitácuaro",
            "estado" => "Michoacán",
            "telefono" => "7151149542",
            "nombreCarrera" => "Licenciatura en Intervención Educativa",
            "modalidadCarrera" => "Presencial",
            "nombreResponsableServiciosEscolares" => "ISC. David Alejandro Gálvez Garduño",
            "fechaExpedicion" => "03/03/2023",
        );

        /* *********************************************************************** */

        $formato = "formato_recepcion_documental_2023.docx";
        $document = new TemplateDocxEngine($formato, $data);
        return $document->create();
    }

    
}
