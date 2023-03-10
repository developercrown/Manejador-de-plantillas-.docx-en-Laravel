<?php
    namespace App\Classes;

    use PhpOffice\PhpWord\TemplateProcessor;
    use Illuminate\Support\Facades\Storage;
    use Carbon\Carbon;

    class TemplateDocxEngine{

        public string $format;
        public object $data;
        public string $outputFilename;
        public $storage;

        public function __construct(string $format, object $data, string $outputFilename = "document"){
            $this->format = $format;
            $this->data = $data;
            $this->outputFilename = $outputFilename;
            $this->storage = Storage::disk('formatos');
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

            // Download result file
            return response()->download($result)->deleteFileAfterSend(true);
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

