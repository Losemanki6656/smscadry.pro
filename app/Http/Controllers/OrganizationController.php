<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function exportVacationToDoc()
    {

        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('assets/pattern.docx'));

        $my_template->setValue('nomer', "123");   

        try{
            $my_template->saveAs(storage_path('user_1.docx'));
        }catch (Exception $e){
        }

        return response()->download(storage_path('user_1.docx'));
    }
}
