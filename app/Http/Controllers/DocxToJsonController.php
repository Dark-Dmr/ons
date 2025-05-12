<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class DocxToJsonController extends Controller
{
    public function showForm()
    {
        return view('uploadDocx');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:docx'
        ]);

        $path = $request->file('document')->store('documents');

        $docPath = storage_path('app/' . $path);
        $phpWord = IOFactory::load($docPath);

        $text = '';

foreach ($phpWord->getSections() as $section) {
    foreach ($section->getElements() as $element) {
        if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
            $text .= $element->getText() . "\n";

        } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            foreach ($element->getElements() as $subElement) {
                if ($subElement instanceof \PhpOffice\PhpWord\Element\Text) {
                    $text .= $subElement->getText();
                }
            }
            $text .= "\n";

        } elseif ($element instanceof \PhpOffice\PhpWord\Element\ListItem) {
            $text .= '- ' . $element->getText() . "\n";

        } else {
            $text .= "[Unsupported element: " . get_class($element) . "]\n";  // ask Naz on to show you the lang stuff for error
        }

    }
   }
  }
}

 $lines = array_filter(array_map('trim', explode("\n", $text)));
 $json = json_encode($lines, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
