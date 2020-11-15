<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Advisor;
use App\District;
use App\EPAs;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AdvisorController extends Controller
{

    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('epas')->where('id', $id)->get());
    }

    // Adding Advisor to the system
    public function addAdvisor(Request $request){
        $district=District::all();//get data from table
        if(Session::get('adminDetails')['advisors_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$advisor = new Advisor;
            $advisor->advisor_name = $data['advisor_name'];
            $advisor->specialty = $data['specialty'];
            $advisor->phone_number = $data['phone_number'];
            $advisor->advisor_district = $data['district_id'];
            $advisor->advisor_epa = $data['epaname'];
           // $advisor->advisor_location = $data['advisor_location'];
            $advisor->days  = $data['days'];
            $advisor->start_time = $data['start_time'];
            $advisor->end_time = $data['end_time'];
            $advisor->status = $data['status'];
            $advisor->save();
            return redirect('/admin/view-advisors')->with('flash_message_success','Advisor Details Added Successfully');
        } 
        return view('admin.advisors.add_advisor')->with(compact('district'));;
    }

    // Displaying Advisors in the system
    public function viewAdvisors(){
        if(Session::get('adminDetails')['advisors_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $advisors = Advisor::orderBy('created_at','desc')->get();

        $advisors = json_decode(json_encode($advisors));
        /*
    	foreach($advisors as $key => $val){
    		$epaname = epas::where(['ep_id'=>$val->advisor_epa])->first();
    		$advisors[$key]->epaname = $epaname->epaname;
        }*/
        foreach($advisors as $key => $val){
    		$districtname = District::where(['id'=>$val->advisor_district])->first();
    		$advisors[$key]->districtname = $districtname->districtname;
        }



        return view('admin.advisors.view_advisors')->with(compact('advisors','menu_active','i'));
    }

    // Updating Advisors Details in the system
    public function editAdvisor(Request $request, $id = null){
        if(Session::get('adminDetails')['advisors_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $advisorDetails = Advisor::where(['id'=>$id])->first();
        if($request->isMethod('post')){
    		$data = $request->all();
            Advisor::where(['id'=>$id])->update(['advisor_name'=>$data['advisor_name'],
                                                  'specialty'=>$data['specialty'],
                                                  'phone_number'=>$data['phone_number'],
                                                  'advisor_location'=>$data['advisor_location'],
                                                  'days'=>$data['days'],
                                                  'start_time'=>$data['start_time'],
                                                  'end_time'=>$data['end_time'],
                                                  'status'=>$data['status']
    			]);
    		return redirect('/admin/view-advisors')->with('flash_message_success','Advisor Details Updated Successfully');
        }
        return view('admin.advisors.edit_advisor')->with(compact('advisorDetails'));
    }

    // Deleting Advisor Details in the system
    public function deleteAdvisor(Request $request, $id = null){
        if(Session::get('adminDetails')['advisors_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($id)){
    		Advisor::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Advisor Details Deleted Successfully');
    	}
    }

    // View Farmer Charts
    public function viewAdvisorCharts(){

        $current_month_advisors = Advisor::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_advisors = Advisor::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_advisors = Advisor::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
       
        
        return view('admin.advisors.view_advisors_charts')->with(compact('current_month_advisors','last_month_advisors','last_to_last_month_advisors'));;
        
    }


}
