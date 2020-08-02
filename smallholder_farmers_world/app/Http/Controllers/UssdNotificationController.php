<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UssdNotification;
use App\Farmer;
use Session;

class UssdNotificationController extends Controller
{

    public function sendNotification(Request $request){
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
    		$data = $request->all();

            if(empty($data['farmer_id'])){
				return redirect()->back()->with('flash_message_error','Phone Number is Missing ');    
			}
			
 	   		$notification = new UssdNotification;
 	   		$notification->farmer_id .= $data['farmer_id'];
 	   		$notification->sender_name = $data['sender_name'];
 	   		if(!empty($data['sent_message'])){
 	   			$notification->sent_message = $data['sent_message'];
 	   		}else{
 	   			$notification->sent_message = '';
 	   		}
 	   		$notification->save();
 	   		//return redirect()->back()->with('flash_message_success', 'Product has been added successfully');
 	   		return redirect('/admin/view-notifications')->with('flash_message_success', 'Notification has been sent successfully');
    	}

    	//Categories drop down start
    	$farmers = Farmer::where(['parent_id'=>0])->get();
    	$farmers_dropdown = "<option value='' selected disabled>Select</option>";
    	foreach($farmers as $far){
    		$farmers_dropdown .= "<option value='".$far->id."'>".$far->phonenumber."</option>";
    		$sub_farmers = Farmer::where(['parent_id'=>$far->id])->get();
    		foreach($sub_farmers as $sub_far){
    			$farmers_dropdown .= "<option value = '".$sub_far->id."'>&nbsp;--&nbsp;".$sub_far->phonenumber."</option>";
    		}
    	}
    	// Categories drop down end

    	return view('admin.notifications.send_notification')->with(compact('farmers_dropdown'));
    }


    public function deleteNotification(Request $request, $id = null){
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($id)){
    		UssdNotification::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Notification Deleted Successfully');
    	}
    }

	public function editNotification(Request $request, $id=null){
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<prev>"; print_r($data); die;
 	   		if(empty($data['sent_message'])){
 	   			$data['sent_message'] = '';
 	   		}

			UssdNotification::where(['id'=>$id])->update(['farmer_id'=>$data['farmer_id'],'sent_message'=>$data['sent_message'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'price'=>$data['price'],'image'=>$filename]);

			return redirect()->back()->with('flash_message_success','Notification Has Been Updated Successfully');
		}

		// Get farmer details
		$notificationDetails = UssdNotification::where(['id'=>$id])->first();
		//farmers drop down start
		$farmers = Farmer::where(['parent_id'=>0])->get();
    	$farmers_dropdown = "<option value='' selected disabled>Select</option>";
    	foreach($farmers as $far){
    		if($far->id==$notificationDetails->farmer_id){
    			$selected = "selected";
    		}else{
    			$selected = "";
    		}
            $farmers_dropdown .= "<option value='".$far->id."' ".$selected.">".$far->full_name."</option>";
    	}
    	// Farmers drop down end
		return view('admin.notifications.edit_notification')->with(compact('notificationDetails','farmers_dropdown'));
	}    	


    public function viewNotifications(Request $request){
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
		$menu_active=3;
		$i=0;
		$notifications = UssdNotification::orderBy('created_at','desc')->get();
    	$notifications = json_decode(json_encode($notifications));
    	foreach($notifications as $key => $val){
    		$phonenumber = Farmer::where(['id'=>$val->farmer_id])->first();
    		$notifications[$key]->phonenumber = $phonenumber->phonenumber;
		}
		foreach($notifications as $key2 => $val2){
    		$full_name = Farmer::where(['id'=>$val2->farmer_id])->first();
    		$notifications[$key2]->full_name = $full_name->full_name;
		}
		

        return view ('admin.notifications.view_notifications')->with(compact('notifications','menu_active','i'));

    }


}
