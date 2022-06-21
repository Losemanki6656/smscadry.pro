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

        $my_template->setValue('nomer', 1);   
        $my_template->setValue('full', $item->cadry->fullname);   
        $my_template->setValue('work', $item->cadry->staff);  
        $my_template->setValue('sex', $item->cadry->department->name);   
        $my_template->setValue('data1', $item->per1);       
        $my_template->setValue('data2', $item->per2);      
        $my_template->setValue('maind', $item->maindays);     
        $my_template->setValue('day0', $item->lavozim); 
        $my_template->setValue('day1', $item->ogirm);
        $my_template->setValue('day2', $item->staj); 
        $my_template->setValue('day3', $item->yoshfar);
        $my_template->setValue('day5', $item->donor);  
        $my_template->setValue('day6', $item->yosh); 
        $my_template->setValue('day7', $item->nogiron); 
        $my_template->setValue('klimat', $item->klimat); 
        $my_template->setValue('day4', $item->resultdays); 
        $my_template->setValue('data3', $item->todate); 
        $my_template->setValue('data4', $item->fromdate); 
        $my_template->setValue('otprav', $item->user_send->name); 
        $my_template->setValue('poluch', $item->user_rec->name); 

        try{
            $my_template->saveAs(storage_path('user_1.docx'));
        }catch (Exception $e){
        }

        return response()->download(storage_path('user_1.docx'));
    }
}
