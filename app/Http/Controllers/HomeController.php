<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        $organization = Organization::find($org_id);
        
        $cadry = Cadry::query()
        ->where('organization_id', $org_id)
        ->when(\Request::input('search'),function($query,$search){
            $query->where(function ($query) use ($search) {
                $query->Orwhere('fullname','like','%'.$search.'%');
            });
        })->with('department');

        $deps = Department::where('organization_id',$org_id)->get();

        if(!$request->paginate) $paginate = 3; else $paginate = $request->paginate;

        return view('home',[
            'cadry' => $cadry->paginate($paginate),
            'deps' => $deps,
            'organization' => $organization
        ]);
    }

    public function add_worker(Request $request)
    {
      // dd($request->all());
       $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

       //$char = ['(', ')', ' ','-','+'];
       //$replace = ['', '', '','',''];
       //$phone = str_replace($char, $replace, $request->phone);

       $cadry = new Cadry();
       $cadry->organization_id = $org_id;
       $cadry->department_id = $request->department_id ?? 0;
       $cadry->fullname = $request->fullname;
       $cadry->phone = $request->phone;
       $cadry->staff = $request->staff;
       $cadry->date_med2 = $request->date_med;
       $cadry->date_vac2 = $request->date_vac;
       $cadry->save();

       $session = new SessionMed();
       $session->organization_id = $org_id;
       $session->user_id = Auth::user()->id;
       $session->cadry_id = $cadry->id;
       $session->status = "Cadry ".$cadry->fullname." Added";
       $session->save();

       return redirect()->back()->with('msg' ,1);
    }

    public function departments()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

        $deps = Department::where('organization_id',$org_id);

        return view('departments',[
            'deps' => $deps->paginate(10)
        ]);
    }

    public function add_department(Request $request)
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

        $dep = new Department();
        $dep->organization_id = $org_id;
        $dep->name = $request->name;
        $dep->save();

       return redirect()->back()->with('msg' ,1);
    }

    public function edit_department(Request $request,$id)
    {
        $dep = Department::find($id);
        $dep->name = $request->name;
        $dep->save();

       return redirect()->back()->with('msg' ,1);
    }
    public function delete_department($id)
    {
        $dep = Department::find($id)->delete();

       return redirect()->back()->with('msg' ,1);
    }

    public function update_med_cadry(Request $request, $id)
    {
        $worker = Cadry::find($id);
        $worker->date_med1 = $worker->date_med1;
        $worker->date_med2 = $request->date_med2;
        $worker->save();

        $session = new SessionMed();
        $session->organization_id = $worker->organization_id;
        $session->user_id = Auth::user()->id;
        $session->cadry_id = $id;
        $session->status = "Date Med Updated to '.$request->date_med2.'";
        $session->save();

        return redirect()->back()->with('msg' ,1);
    }

    public function edit_worker(Request $request,$id)
    {
       $cadry = Cadry::find($id);
       $cadry->department_id = $request->department_id ?? 0;
       $cadry->fullname = $request->fullname;
       $cadry->phone = $request->phone;
       $cadry->staff = $request->staff;
       $cadry->date_med2 = $request->date_med2;
       $cadry->date_vac2 = $request->date_vac2;
       $cadry->save();

       $session = new SessionMed();
       $session->organization_id = $cadry->organization_id;
       $session->user_id = Auth::user()->id;
       $session->cadry_id = $id;
       $session->status = "Cadry Updated";
       $session->save();

       return redirect()->back()->with('msg' ,1);
    }

    public function delete_worker($id)
    {
        $cadry = Cadry::find($id);

        $session = new SessionMed();
        $session->organization_id = $cadry->organization_id;
        $session->user_id = Auth::user()->id;
        $session->cadry_id = $id;
        $session->status = "Cadry ".$cadry->fullname." Deleted";
        $session->save();

        $cadry->delete();

       return redirect()->back()->with('msg' ,1);
    }

    public function archive_sms()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

        $deps = SmsArchive::
        where('organization_id',$org_id)->with('cadry');

        return view('archive_sms',[
            'deps' => $deps->paginate(10)
        ]);
    }

    public function actions()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

        $deps = SessionMed::
        where('organization_id',$org_id)
        ->with('cadry')->with('user');

        return view('actions',[
            'deps' => $deps->paginate(10)
        ]);
    }

    public function send_message(Request $request,$id)
    {   
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        $SmsTokenID = Organization::find($org_id)->sms_token_id;
        $Token = SmsToken::find($SmsTokenID)->sms_token;

        $Worker = Cadry::find($id);

        $char = ['(', ')', ' ','-','+'];
        $replace = ['', '', '','',''];
        $phone = str_replace($char, $replace, $Worker->phone);
    
        $text = $request->textmessage;
    
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://notify.eskiz.uz/api/message/sms/send-batch',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>"{ \"messages\":[ {\"user_sms_id\":\"$id\",\"to\": \"$phone\",\"text\": \"$text\"} ],\"from\":\"4546\",\"dispatch_id\":\"123\"}",
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/json'
            ),
            ));
    
            $response = curl_exec($curl);
    
            $err = curl_error($curl);
            curl_close($curl);
            $json = json_decode($response, true);
    
            if($json['status'] == "success")
            {
                $archive = new SmsArchive();
                $archive->organization_id = $org_id;
                $archive->cadry_id = $id;
                $archive->sms_text = $request->textmessage;
                $archive->save();
            }
            else
            {
                $this->smstoken();
            }

        return redirect()->back()->with('msg' ,1);
    }

    public function smstoken()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        $SmsTokenID = Organization::find($org_id)->sms_token_id;
        $InfoToken = SmsToken::find($SmsTokenID);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://notify.eskiz.uz/api/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "email": "'.$InfoToken->email.'",
            "password": "'.$InfoToken->password.'"
        }
        ',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        $json = json_decode($response, true);
        $x = $json['data'];
      
        $smstoken = SmsToken::find($SmsTokenID);
        $smstoken->sms_token = $x['token'];
        $smstoken->save();
        
        curl_close($curl);

        return redirect()->back();
    }

    public function vacation($id, Request $request)
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        $id_users = UserOrganization::where('organization_id',$org_id)->pluck('user_id')->toArray();
        $users = User::whereIn('id',$id_users)->role('Buxgalter')->get();

        $item = Cadry::find($id);
        $day_vacation = 15;
        $day_cal = 0;
        $date1 = now()->format('Y-m-d');
        $date2 = now()->format('Y-m-d');
        $query = $request->query();

        if($query) {

            if($request->send1) {
                $day_vacation = $day_vacation + $request->lavozim;
                $day_vacation = $day_vacation + $request->staj;
    
                if($request->nogiron) $day_cal = $day_cal + 30;
                if($request->other_30) $day_cal = $day_cal + 30;
                if($request->nogiron_farzand)  $day_vacation = $day_vacation + 3;
                if($request->yosh12)  $day_vacation = $day_vacation + 3;
                if($request->donor)  $day_vacation = $day_vacation + 2;
                if($request->tuy) $day_vacation = $day_vacation + 3;
    
    
                $i = 1; 
                $dateFrom = $request->sana; 
                
                $holidays = Holiday::get();
    
                while ($i <= $day_vacation - 1)
                {
                    $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                    if( Carbon::parse($dateFrom)->dayOfWeek == 0 )  $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                    $i ++ ;
                }
    
                foreach ( $holidays as $holiday){
    
                    if($dateFrom == $holiday->date_holiday){
                        $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                        if( Carbon::parse($dateFrom)->dayOfWeek == 0 )  $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                    }
                }
                return view('vacation_cadry',[
                    'item' => $item,
                    'day_vacation' => $day_vacation,
                    'users' => $users,
                    'date1' => $request->sana,
                    'date2' => $dateFrom
                ]);
            } else if ($request->send2) {
                $yosh = 0; $nogiron = 0; $other_30 = 0; $ogirm = 0; $nogiron_farzand = 0; $yoshfar = 0; $donor = 0; $tuy = 0; $main_days = 15;
                $lavozim = $request->lavozim;

                $day_vacation = $day_vacation + $request->lavozim;
                $day_vacation = $day_vacation + $request->staj;
    
                if($request->yosh) { $day_cal = $day_cal + 30; $yosh = 30; }
                if($request->nogiron) { $day_cal = $day_cal + 30; $nogiron = 30; }
                if($request->other_30) { $day_cal = $day_cal + 30; $other_30 = 30; $main_days = 0;}
                if($request->mehnat) { $ogirm = $request->lavozim; $lavozim = 0;} 

                if($request->nogiron_farzand) { $day_vacation = $day_vacation + 3; $nogiron_farzand = 3; }
                if($request->yosh12) { $day_vacation = $day_vacation + 3; $yoshfar = 3;}
                if($request->donor)  { $day_vacation = $day_vacation + 2; $donor = 2;}
                if($request->tuy) { $day_vacation = $day_vacation + 3; $tuy = 3;} 
    
    
                $i = 1; 
                $dateFrom = $request->sana; 
                
                $holidays = Holiday::get();
    
                while ($i <= $day_vacation - 1)
                {
                    $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                    if( Carbon::parse($dateFrom)->dayOfWeek == 0 )  $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                    $i ++ ;
                }
    
                foreach ( $holidays as $holiday){
    
                    if($dateFrom == $holiday->date_holiday){
                        $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                        if( Carbon::parse($dateFrom)->dayOfWeek == 0 )  $dateFrom = date('Y-m-d', strtotime($dateFrom. ' + 1 days'));
                    }
                } 
                $coun = Vacation::where('cadry_id',$id)->where('status',0)->get();
                if(!$coun->count()) {
                    $vacation = new Vacation();
                    $vacation->organization_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
                    $vacation->user_send_id = Auth::user()->id;
                    $vacation->user_rec_id = $request->user_rec_id;
                    $vacation->cadry_id = $id;
                    $vacation->per1 = $request->period;
                    $vacation->per2 = date('Y-m-d', strtotime($request->period. ' + 1 years'));
                    $vacation->yosh = $yosh;
                    $vacation->nogiron = $nogiron;
                    $vacation->ogirm = $ogirm;
                    $vacation->nogfar = $nogiron_farzand;
                    $vacation->yoshfar = $yoshfar;
                    $vacation->donor = $donor;
                    $vacation->other30 = $other_30;
                    $vacation->klimat = $request->iqlim;
                    $vacation->tuy = $tuy;
                    $vacation->lastdays = $request->qolgan_kun;
                    $vacation->maindays = $main_days;
                    $vacation->resultdays = $day_vacation;
                    $vacation->lavozim = $lavozim;
                    $vacation->staj = $request->staj;
                    $vacation->todate = $request->sana;
                    $vacation->fromdate = $dateFrom;
                    $vacation->date_next = $request->date_next;
                    $vacation->save();
                }
                

                return redirect()->route('submitteds');
            }
        }

        return view('vacation_cadry',[
            'item' => $item,
            'day_vacation' => $day_vacation,
            'users' => $users,
            'date1' => $date1,
            'date2' => $date2
        ]);
    }

    public function holidays()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

        $deps = Holiday::where('organization_id',$org_id);

        return view('holidays',[
            'deps' => $deps->paginate(10)
        ]);
    }

    public function add_holiday(Request $request)
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');

        $dep = new Holiday();
        $dep->organization_id = $org_id;
        $dep->name = $request->name;
        $dep->date_holiday = $request->date_holiday;
        $dep->save();

       return redirect()->back()->with('msg' ,1);
    }

    public function edit_holiday(Request $request,$id)
    {
        $dep = Holiday::find($id);
        $dep->name = $request->name;
        $dep->date_holiday = $request->date_holiday;
        $dep->save();

       return redirect()->back()->with('msg' ,1);
    }
    public function delete_holiday($id)
    {
        $dep = Holiday::find($id)->delete();

       return redirect()->back()->with('msg' ,1);
    }

    public function send_vac(Request $request)
    {
        dd($request->all());
    }
}
