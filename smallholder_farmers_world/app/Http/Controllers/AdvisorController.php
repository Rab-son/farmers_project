<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Advisor;

class AdvisorController extends Controller
{

    // Adding Advisor to the system
    public function addAdvisor(Request $request){
        if(Session::get('adminDetails')['advisors_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$advisor = new Advisor;
            $advisor->advisor_name = $data['advisor_name'];
            $advisor->specialty = $data['specialty'];
            $advisor->phone_number = $data['phone_number'];
            $advisor->advisor_location = $data['advisor_location'];
            $advisor->days  = $data['days'];
            $advisor->start_time = $data['start_time'];
            $advisor->end_time = $data['end_time'];
            $advisor->status = $data['status'];
            $advisor->save();
            return redirect('/admin/view-advisors')->with('flash_message_success','Advisor Details Added Successfully');
        } 
        return view('admin.advisors.add_advisor');
    }

    // Displaying Advisors in the system
    public function viewAdvisors(){
        if(Session::get('adminDetails')['advisors_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $advisors = Advisor::orderBy('created_at','desc')->get();
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

}
