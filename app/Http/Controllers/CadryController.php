<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOrganization;
use App\Models\Cadry;
use App\Models\Department;
use App\Models\SessionMed;
use App\Models\Organization;
use App\Models\SmsToken;
use App\Models\SmsArchive;
use App\Models\Holiday;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CadryImport;
use DateTime;
use Auth;

class CadryController extends Controller
{
 
    public function submitteds()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        $submitteds = Vacation::
        where('organization_id',$org_id)
        ->where('status',0)
        ->orderBy('updated_at','asc')->with(['cadry','user_send','user_rec']);

        return view('submitteds',[
            'submitteds' => $submitteds->paginate(10)
        ]);
    }

    public function accepteds()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        $accepteds = Vacation::
        where('organization_id',$org_id)
        ->where('status', 1)
        ->orderBy('updated_at','asc');

        return view('accepteds',[
            'accepteds' => $accepteds->paginate(10)
        ]);
    }

    public function success_vacation($id)
    {
        $submit = Vacation::find($id);
        $submit->status = 1;
        $submit->save();

        return redirect()->back()->with('msg' ,1);
    }

    
    public function warningVacation($id)
    {
        $war = Vacation::find($id);
        $war->status_bux = 1;
        $war->save();
        
        return redirect()->back()->with('msg' ,2);
    }

    public function excelimport()
    {
        return view('excelimport');
    }

    public function excelimportsuccess(Request $request)
    {
        set_time_limit(600);

        $collections = Excel::toCollection(new CadryImport, $request->file('ecel'));
        
            $arr = $collections[0];
            $x = 0;
            $y = 0;
            $a = [];

            foreach ($arr as $row) { 
            $cadry = Cadry::create([
                    'organization_id' => 1,
                    'department_id' => 0,
                    'fullname' => $row[0] ?? '',
                    'phone' => $row[4] ?? '',
                    'staff' => $row[1] ?? '',
                    'date_med2' => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]))->format('Y-m-d'),
                ]);

                $x ++;
            }

        dd($x);

    }
}
