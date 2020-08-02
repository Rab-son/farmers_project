<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;// Adding user model
use App\Farmer;// Adding Farmer Model
use App\Supplier;
use App\Advisor;
use App\Market;
use App\UssdNotification;
use App\Admin;
use Illuminate\Support\Facades\Hash;//to check hash Password


class AdminController extends Controller
{
    //login function for the adminstrator
    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->input();
            $adminCount = Admin::where(['username' => $data['username'], 'password' => md5($data['password']),'status'=>1])->count(); 
            if($adminCount > 0){
                //echo "Success"; die;
                Session::put('adminSession', $data['username']);
                return redirect('/admin/dashboard');
        	}else{
                //echo "failed"; die;
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
        	}
    	}
    	return view('admin.admin_login');
    }


    //function for accessing the dashboard on the admin panel
    public function dashboard($id=null){
        // counting items in the database
        $farmerCount = Farmer::paginate();
        $supplierCount = Supplier::paginate();
        $advisorCount = Advisor::paginate();
        $marketCount = Advisor::paginate();
        $ussdNotificationCount = UssdNotification::paginate();
        
        return view('admin.dashboard')->with(compact('farmerCount','supplierCount','advisorCount','marketCount','ussdNotificationCount'));;
    }

    // function for directing to settings page
    public function settings(){

        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    // function for checking the password
    public function chkPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $adminCount = Admin::where(['username' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count(); 
            if ($adminCount == 1) {
                //echo '{"valid":true}';die;
                echo "true"; die;
            } else {
                //echo '{"valid":false}';die;
                echo "false"; die;
            }

    }
    // function for updating the password
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $adminCount = Admin::where(['username' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();

            if ($adminCount == 1) {
                // here you know data is valid
                $password = md5($data['new_pwd']);
                Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success', 'Password updated successfully.');
            }else{
                return redirect('/admin/settings')->with('flash_message_error', 'Current Password entered is incorrect.');
            }

            
        }
    }


    // function to view Admins available in the system
    public function viewAdmins(Request $request) {
        if(Session::get('adminDetails')['type']=="Sub Admin"){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $admins = Admin::orderBy('created_at','desc')->get();
        return view('admin.admins.view_admins')->with(compact('admins','menu_active','i'));
    }

    // function to add Admins  in the system
    public function addAdmin(Request $request) {
        if(Session::get('adminDetails')['type']=="Sub Admin"){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$adminCount = Admin::where('username',$data['username'])->count();
            if($adminCount>0){
                return redirect()->back()->with('flash_message_error','Admin / Sub Admin Already Exists! Please Choose Another');
            }else{                if(empty($data['status'])){
                    $data['status'] = 0;
                }

                if($data['type']=="Admin"){
                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $data['status'];
                    $admin->save();
                    return redirect()->back()->with('flash_message_success','Adminstrator Added Successfully !');
                
                }else if($data['type']=="Sub Admin"){
                    if(empty($data['farmers_access'])){
                        $data['farmers_access'] = 0;
                    }
                    if(empty($data['markets_access'])){
                        $data['markets_access'] = 0;
                    }
                    if(empty($data['suppliers_access'])){
                        $data['suppliers_access'] = 0;
                    }
                    if(empty($data['advisors_access'])){
                        $data['advisors_access'] = 0;
                    }
                    if(empty($data['ussd_notifications_access'])){
                        $data['ussd_notifications_access'] = 0;
                    }
                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $data['status'];
                    $admin->farmers_access = $data['farmers_access'];
                    $admin->markets_access = $data['markets_access'];
                    $admin->suppliers_access = $data['suppliers_access'];
                    $admin->advisors_access = $data['advisors_access'];
                    $admin->ussd_notifications_access = $data['ussd_notifications_access'];
                    $admin->save();
                    return redirect()->back()->with('flash_message_success','Sub Adminstrator Added Successfully !');
                }
            }
        }
        return view('admin.admins.add_admin');
    }

    // function to edit Admins in the system
    public function editAdmin(Request $request , $id){
        $adminDetails = Admin::where('id',$id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            if($data['type']=="Admin"){
                Admin::where('username',$data['username'])->update(['password'=>md5($data['password']), 'status'=>$data['status']]);
                return redirect()->back()->with('flash_message_success','Admin Adminstrator Updated Successfully !');
            
            }else if($data['type']=="Sub Admin"){
                if(empty($data['farmers_access'])){
                    $data['farmers_access'] = 0;
                }
                if(empty($data['markets_access'])){
                    $data['markets_access'] = 0;
                }
                if(empty($data['suppliers_access'])){
                    $data['suppliers_access'] = 0;
                }
                if(empty($data['advisors_access'])){
                    $data['advisors_access'] = 0;
                }
                if(empty($data['ussd_notifications_access'])){
                    $data['ussd_notifications_access'] = 0;
                }
                Admin::where('username',$data['username'])->update(['password'=>md5($data['password']),'status'=>$data['status'] ,'farmers_access'=>$data['farmers_access'],
                'markets_access'=>$data['markets_access'],'suppliers_access'=>$data['suppliers_access'],
                'advisors_access'=>$data['advisors_access'],'ussd_notifications_access'=>$data['ussd_notifications_access']]);
                return redirect()->back()->with('flash_message_success','Sub Admin Adminstrator Updated Successfully !');
            }

            

        }
        return view('admin.admins.edit_admin')->with(compact('adminDetails'));
        
    }
    // function to edit Admins in the system
    public function approveAdmin(Request $request , $id){
        $menu_active=3;
        $i=0;
        $admins = Admin::orderBy('created_at','desc')->get();
        $adminDetails = Admin::where('id',$id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            if($data['type']=="Admin"){
                Admin::where('username',$data['username'])->update(['status'=>$data['status']]);
                return redirect()->back()->with('flash_message_success',' Adminstrator Is Now Approved !');
            
            }else if($data['type']=="Sub Admin"){
                if(empty($data['farmers_access'])){
                    $data['farmers_access'] = 0;
                }
                if(empty($data['markets_access'])){
                    $data['markets_access'] = 0;
                }
                if(empty($data['suppliers_access'])){
                    $data['suppliers_access'] = 0;
                }
                if(empty($data['advisors_access'])){
                    $data['advisors_access'] = 0;
                }
                if(empty($data['ussd_notifications_access'])){
                    $data['ussd_notifications_access'] = 0;
                }
                Admin::where('username',$data['username'])->update(['status'=>$data['status'] ,'farmers_access'=>$data['farmers_access'],
                'markets_access'=>$data['markets_access'],'suppliers_access'=>$data['suppliers_access'],
                'advisors_access'=>$data['advisors_access'],'ussd_notifications_access'=>$data['ussd_notifications_access']]);
                return redirect()->back()->with('flash_message_success','Sub Admin Is Now Approved !');
            }

            

        }
        return view('admin.admins.approve_admin')->with(compact('admins','adminDetails','menu_active','i'));
        
    }
    // Deleting Admin Details in the system
    public function deleteAdmin(Request $request, $id = null){
        if(Session::get('adminDetails')['type']=="Sub Admin"){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        if(!empty($id)){
            Admin::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Admin Details Deleted Successfully');
        }
    }
    //Admin Register
    public function adminRegister(Request $request){
    	if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data); die;
    		$adminCount = Admin::where('username',$data['username'])->count();
            if($adminCount>0){
                return redirect('/admin/admin-register')->with('flash_message_error','Admin / Sub Admin Already Exists! Please Choose Another !');
            }else{
                if(empty($data['status'])){
                    $data['status'] = 0;
                }
                if($data['type']=="Admin"){
                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $data['status'];
                    $admin->save();
                    return redirect('/admin')->with('flash_message_success','Admin Adminstrator Added Successfully !');
                
                }else if($data['type']=="Sub Admin"){
                    if(empty($data['farmers_access'])){
                        $data['farmers_access'] = 0;
                    }
                    if(empty($data['markets_access'])){
                        $data['markets_access'] = 0;
                    }
                    if(empty($data['suppliers_access'])){
                        $data['suppliers_access'] = 0;
                    }
                    if(empty($data['advisors_access'])){
                        $data['advisors_access'] = 0;
                    }
                    if(empty($data['ussd_notifications_access'])){
                        $data['ussd_notifications_access'] = 0;
                    }
                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $data['status'];
                    $admin->farmers_access = $data['farmers_access'];
                    $admin->markets_access = $data['markets_access'];
                    $admin->suppliers_access = $data['suppliers_access'];
                    $admin->advisors_access = $data['advisors_access'];
                    $admin->ussd_notifications_access = $data['ussd_notifications_access'];
                    $admin->save();
                    return redirect('/admin')->with('flash_message_success','Sub Admin Adminstrator Added Successfully !');
                }
            }
        }

        return view('admin.admins.admin_signup');
         
    }
    //Admin Login Register
    public function adminLoginRegister(Request $request){

        return view('admin.admins.admin_signup');
         
    }
    // Database Notification
    public function index()
    {
        $notifications = unreadNotifications;

        return view('admin.dashboard', compact('notifications'));
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    //function for logging out of the admin panel
    public function logout(){
        Session::flush();// clearing off all sessions
        // displaying a successful message when the admin logout successfully
        return redirect('/admin')->with('flash_message_success','Logged Out Successfully');
    }

}
