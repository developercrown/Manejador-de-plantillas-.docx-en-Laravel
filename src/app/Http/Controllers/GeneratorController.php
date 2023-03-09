<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

class GeneratorController extends Controller
{
    public function generate(){
        $archivoOriginal = public_path() . Storage::url('formato.docx');
        $archivoModificado = public_path() . Storage::url(Carbon::now()->toDateTimeString().'.docx');

        // Cargar el archivo original
        $template = new TemplateProcessor($archivoOriginal);

        // Modificar el contenido del archivo
        $template->setValue('nombre', 'Rene Corona Valdes');
        $template->setValue('edad', '34');

        // Guardar el archivo modificado
        $template->saveAs($archivoModificado);

        // Descargar el archivo modificado
        return response()->download($archivoModificado)->deleteFileAfterSend(true);
    }
}
