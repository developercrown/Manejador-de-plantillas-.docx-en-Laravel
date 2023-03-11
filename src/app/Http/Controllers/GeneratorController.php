<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\TemplateDocxEngine;
use Carbon\Carbon;

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
            "fechaExpedicion" => Carbon::now()->format('d/m/Y'),
        );

        /* *********************************************************************** */

        $formato = "formato_recepcion_documental_2023.docx";
        $document = new TemplateDocxEngine($formato, $data, "formato de entrega documental", "formatos");
        $outputPath = $document->create();
        return $outputPath;

        // Download result file
        // return response()->download($outputPath);//->deleteFileAfterSend(true);
    }

    public function parse(){
        $formato = "";
        // $result = public_path() . "/" .$formato;
        $document = new TemplateDocxEngine("formato de entrega documental - 2023-03-10 21:41:44.docx", null, "formato de entrega documental", "public");
        return $document->docToPdf();
    }


}
