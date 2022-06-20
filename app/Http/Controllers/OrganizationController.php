<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;

class OrganizationController extends Controller
{
    public function exportVacationToDoc($id)
    {
        $item = Vacation::find($id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('assets/pattern.docx'));

        $my_template->setValue('full', $item->cadry->staff);   

        try{
            $my_template->saveAs(storage_path('user_1.docx'));
        }catch (Exception $e){
        }

        return response()->download(storage_path('user_1.docx'));
    }
}
