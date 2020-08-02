<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;
use Session;
use App\Admin;

class Adminlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('adminSession'))){
            return redirect('/admin');
        }else{
            // Get Admin/Sub Admin Details 
            $adminDetails = Admin::where('username',Session::get('adminSession'))->first();
            $adminDetails = json_decode(json_encode($adminDetails),true);
            if($adminDetails['type']=="Admin"){
                $adminDetails['farmers_access']=1; 
                $adminDetails['markets_access']=1; 
                $adminDetails['suppliers_access']=1; 
                $adminDetails['advisors_access']=1; 
                $adminDetails['ussd_notifications_access']=1; 

            }
            Session::put('adminDetails',$adminDetails);
            /*echo "<pre>"; print_r(Session::get('adminDetails')); die;*/

            // Get Current Path
            $currentPath= Route::getFacadeRoot()->current()->uri();

            if($currentPath=="admin/view-farmers" && Session::get('adminDetails')['farmers_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/add-farmer" && Session::get('adminDetails')['farmers_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/view-advisors" && Session::get('adminDetails')['advisors_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/add-advisor" && Session::get('adminDetails')['advisors_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/add-markets" && Session::get('adminDetails')['markets_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/view-markets" && Session::get('adminDetails')['markets_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/view-suppliers" && Session::get('adminDetails')['suppliers_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/add-market" && Session::get('adminDetails')['suppliers_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/send-notification" && Session::get('adminDetails')['ussd_notifications_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/view-notifications" && Session::get('adminDetails')['ussd_notifications_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/show-phonenumber" && Session::get('adminDetails')['ussd_notifications_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/view-admins" && Session::get('adminDetails')['type']=="Sub Admin"){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath=="admin/add-admin" && Session::get('adminDetails')['type']=="Sub Admin"){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            
            

        }
        return $next($request);
    }
}
