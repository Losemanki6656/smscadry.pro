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
}
