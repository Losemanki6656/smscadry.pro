<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Auth;
use App\Models\UserOrganization;
use App\Models\Cadry;
use App\Models\Department;

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
    public function index()
    {
        $org_id = UserOrganization::where('user_id',Auth::user()->id)->value('organization_id');
        
        $cadry = Cadry::query()
        ->where('organization_id', $org_id)
        ->when(\Request::input('search'),function($query,$search){
            $query->where(function ($query) use ($search) {
                $query->Orwhere('fullname','like','%'.$search.'%');
            });
        });

        $deps = Department::where('organization_id',$org_id)->get();

        return view('home',[
            'cadry' => $cadry->paginate(10),
            'deps' => $deps
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
       $cadry->date_med2 = $request->date_med;
       $cadry->date_vac2 = $request->date_vac;
       $cadry->save();

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
}
