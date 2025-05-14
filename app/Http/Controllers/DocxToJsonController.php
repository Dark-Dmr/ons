<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class DocxToJsonController extends Controller
{

public function showForm(){
    return view('contents.uploadDocx');
}



public function convert(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:docx'
        ]);

        $file = $request->file('document');
        $docPath = $file->getRealPath(); // Use real path from temp upload

        try {
            $phpWord = IOFactory::load($docPath);
        } catch (\Exception $e) {
            return back()->withErrors(['document' => 'Failed to load Word document: ' . $e->getMessage()]);
        }

        $text = '';

        try {
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    try {
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
                            $text .= $element->getText() . "\n";
                        } else {
                            $text .= "\n"; // Leave a blank line for unsupported elements
                        }
                    } catch (\Throwable $e) {
                        $text .= "\n"; // Skip individual element errors
                        continue;
                    }
                }
            }
        } catch (\Throwable $e) {
            return back()->withErrors(['document' => 'Error while reading content: ' . $e->getMessage()]);
        }

        // Convert plain text into an array of lines
        $lines = explode("\n", $text); // Keeps blank lines!

        // Encode the text as JSON
        $jsonContent = json_encode($lines, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        // Save as JSON text
        $document = Content::create([
            'tittle' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'text' => $jsonContent
        ]);

        return redirect(route('contents.index'));
    }


}
