<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;// Adding user model
use Illuminate\Support\Facades\Hash;//to check hash Password


class AdminController extends Controller
{
    //login function for the adminstrator
    public function login(Request $request){
        // isMethod to check if the login form submitted
        if($request->isMethod('post')){
            $data = $request->input();
            // checking if admin email and password is correct
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'], 'admin'=> '1'])){
                // directing to dashboard page
                return redirect('/admin/dashboard');

            }else{
                // displaying an error message if directing to dashboard page fails
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');

            }
        }
        return view('admin.admin_login');// return to the view page

    }

    //function for accessing the dashboard on the admin panel
    public function dashboard(){

        return view('admin.dashboard');
    }

    // function for directing to settings page
    public function settings(){

        return view('admin.settings');
    }

    // function for checking the password
    public function chckPassword(Request $request) {
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
                echo "true";die;
            }else {
                echo "false";die;
            }
    }

    // function for updating the password
    public function updatePassword(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<prev>',print_r($data); die;
            $check_password = User::where(['email'=> Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id','1')-> update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success', 'Password Updated Successfully !'); 

            }else {
                return redirect('/admin/settings')->with('flash_message_error', 'Incorrect Current Password!'); 
            }
        }
    }

    //function for logging out of the admin panel
    public function logout(){
        Session::flush();// clearing off all sessions
        // displaying a successful message when the admin logout successfully
        return redirect('/admin')->with('flash_message_success','Logged Out Successfully');
    }
}
