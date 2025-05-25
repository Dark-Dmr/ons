<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Writer\HTML;


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
    $docPath = $file->getRealPath();

    try {
        $phpWord = IOFactory::load($docPath);
        $writer = new HTML($phpWord);
        ob_start();
        $writer->save('php://output');
        $htmlContent = ob_get_clean();

        // Store HTML as string in JSON format
        $jsonContent = json_encode($htmlContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } catch (\Throwable $e) {
        return back()->withErrors(['document' => 'Failed to process document: ' . $e->getMessage()]);
    }

    Content::create([
        'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
        'text' => $jsonContent,
    ]);

    return redirect(route('contents.index'));
}






}
