<?php
    namespace App\Classes;

    use \Carbon\Carbon;
    use Illuminate\Support\Facades\Storage;

    include_once('tbs_class.php'); 
    include_once('plugins/tbs_plugin_opentbs.php'); 

    class TBSClass{

        public function create(){
            $TBS = new clsTinyButStrong; 
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

            // //Parametros

            $nombre = 'René';
            $app = 'Corona';
            $apm = 'Valdes';

            $sexo = "M";

            //Fecha de nacimiento
            $fechaNacimiento = "10/03/1989";
            

            $nss = "001100110011";
            $curp = "COVR890310HMNRLN04";
            $rfc = "COVR890310QX4";
            $email = "isc.corona@upn164.edu.mx";
            $domicilio = "Ignacio Ramirez Norte #9";
            $colonia = "Miguel Hidalgo";
            $cp = "61500";
            $ciudad = "Zitácuaro";
            $estado = "Michoacán";
            $telefono = "7151149542";
            
            $nombreCarrera = "Licenciatura en Intervención Educativa";
            $modalidadCarrera = "Presencial";

            $nombreResponsableServiciosEscolares = "ISC. David Alejandro Gálvez Garduño";

            $fechaExpedicion = "03/03/2023";

            // //Cargando template
            // $template = 'formato_mejorado.docx';
            $template = 'formato_mejorado.docx';
            $storage = Storage::disk('public');
            $file = $storage->url($template);
            return $file;
            $TBS->LoadTemplate($file, OPENTBS_ALREADY_UTF8);
            
            // //NOMBRE APP APM
            // $TBS->MergeField('pro.nombre', $nombre);
            // $TBS->MergeField('pro.app', $app);
            // $TBS->MergeField('pro.apm', $apm);

            // // $TBS->MergeField('pro.fechaRegistro', $fechaRegistro); //Fecha de registro del documento
            // $TBS->MergeField('pro.sexo', $sexo); // M / F

            // //Fecha de nacimiento
            // $TBS->MergeField('pro.fechaNacimiento', $fechaNacimiento);
            
            // $TBS->MergeField('pro.nss', $nss);
            // $TBS->MergeField('pro.curp', $curp);
            // $TBS->MergeField('pro.rfc', $rfc);
            // $TBS->MergeField('pro.email', $email);

            // $TBS->MergeField('pro.domicilio', $domicilio);
            // $TBS->MergeField('pro.colonia', $colonia);
            // $TBS->MergeField('pro.cp', $cp);
            // $TBS->MergeField('pro.ciudad', $ciudad);
            // $TBS->MergeField('pro.estado', $estado);
            // $TBS->MergeField('pro.telefono', $telefono);
            

            // $TBS->MergeField('pro.nombreCarrera', $nombreCarrera);
            // $TBS->MergeField('pro.modalidadCarrera', $modalidadCarrera);
            
            // $TBS->MergeField('pro.nombreResponsableServiciosEscolares', $nombreResponsableServiciosEscolares);
            
            // $TBS->MergeField('pro.fechaExpedicion', $fechaExpedicion);



            // $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

            // $save_as = 'Solicitud de registro oficial para aspirantes en la UPN 164.docx';
            // $TBS->Show(OPENTBS_DOWNLOAD, $save_as);
            $timestamp = Carbon::now()->toDateTimeString();
            return "hello $timestamp";
        }

        public function debug(){
            return "lol";
        }
    }