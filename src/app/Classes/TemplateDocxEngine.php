<?php
    namespace App\Classes;

    use PhpOffice\PhpWord\TemplateProcessor;
    use PhpOffice\PhpWord\PhpWord;
    use PhpOffice\PhpWord\IOFactory;
    use TCPDF;
    use Illuminate\Support\Facades\Storage;
    use Carbon\Carbon;

    class TemplateDocxEngine{

        public string $format;
        public $data;
        public string $outputFilename;
        public $storage;

        public function __construct(
            string $format = "",
            $data,
            string $outputFilename = "document",
            string $documentPath = "public"
        ){
            $this->format = $format;
            $this->data = $data;
            $this->outputFilename = $outputFilename;
            $this->storage = Storage::disk($documentPath);
        }

        public function create(){
            $templateFile = $this->storage->path($this->format);

            $result = public_path() . "/" . (Storage::url($this->outputFilename . " - " . Carbon::now()->toDateTimeString()).'.docx');

            // Load original file source
            $template = new TemplateProcessor($templateFile);

            // Replace content values on template with entered values from data variable
            $this->replaceValuesOnTemplate($template, $this->data);

            // Save modified file
            $template->saveAs($result);

            return $result;
        }

        public function docToPdf(){
            $filepath = $this->storage->path($this->format);

            $template = new TemplateProcessor($filepath);

            $template->saveAs(storage_path('app/temp.docx'));

            // Crear una instancia de TCPDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Agregar una página al PDF
            $pdf->AddPage();

            return var_dump($template);
            // Obtener el contenido HTML del documento .docx
            $html = $template->getHtml();

            // Escribir el contenido HTML en el PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Guardar el archivo PDF en disco
            $pdfFile = storage_path('app/' . pathinfo($filename, PATHINFO_FILENAME) . '.pdf');
            $pdf->Output($pdfFile, 'F');


            return $filepath;
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

    // $htmlFile = storage_path('app/' . uniqid() . '.html');
    // $template->saveAs($htmlFile, 'HTML');

    // // Crear una instancia de Dompdf
    // $dompdf = new Dompdf();

    // // Cargar el archivo HTML
    // $html = file_get_contents($htmlFile);
    // $dompdf->loadHtml($html);
    // // Configurar las opciones de Dompdf
    // $dompdf->setPaper('A4', 'portrait');

    // // Renderizar el PDF
    // $dompdf->render();


    // // Guardar el PDF
    // $pdfFile = storage_path('app/' . uniqid() . '.pdf');
    // file_put_contents($pdfFile, $dompdf->output());

    // // Eliminar el archivo HTML temporal
    // unlink($htmlFile);
