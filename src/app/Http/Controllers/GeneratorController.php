<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

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

        $storage = Storage::disk('formatos');

        $templateFile = $storage->path("formato_recepcion_documental_2023.docx");

        $resultado = public_path() . Storage::url(Carbon::now()->toDateTimeString().'.docx');

        // Cargar el archivo original
        $template = new TemplateProcessor($templateFile);

        // Reemplaza los valores contenidos en la plantilla con los valores ingresados en la variable datos
        $this->replaceValuesOnTemplate($template, $data);

        // Guardar el archivo modificado
        $template->saveAs($resultado);

        // Descargar el archivo modificado
        return response()->download($resultado)->deleteFileAfterSend(true);
    }

    public function replaceValuesOnTemplate($template, $data){
        foreach ($data as $clave => $valor) {
            $this->remplaceTemplateValue($template, $clave, $valor);
        }
    }

    public function remplaceTemplateValue($template, $column, $value){
        $template->setValue($column, $value);
    }
}
