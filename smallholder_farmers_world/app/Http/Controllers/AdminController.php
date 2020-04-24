<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;// Adding user model
use App\UsersPhoneNumber;// Adding phoneNumber Model
use Illuminate\Support\Facades\Hash;//to check hash Password
use Twilio\Rest\Client;// Rest API

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

    // SMS PORTAL Code section
 /**
     * Show the forms with users phone number details.
     *
     * @return Response
     */
    public function show()
    {
        $users = UsersPhoneNumber::all();
        return view('admin.smsportal', compact("users"));
    }
    /**
     * Store a new user phone number.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storePhoneNumber(Request $request)
    {
        //run validation on data sent in
        $validatedData = $request->validate([
            'phone_number' => 'required|unique:users_phone_number|numeric',
        ]);
        $user_phone_number_model = new UsersPhoneNumber($request->all());
        $user_phone_number_model->save();
        //$this->sendMessage('User registration successful!!', $request->phone_number);
        //return back()->with(['success' => "{$request->phone_number} registered"]);
        return redirect('/admin/show')->with('flash_message_success','Phone Number Registered Successfully !');
        
    }
    /**
     * Send message to a selected users
     */
    public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        //return back()->with(['success' => "Messages on their way!"]);
        return redirect('/admin/show')->with('flash_message_success', 'Message Sent!');
        
    }
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = env("TWILIO_ACCOUNT_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_PHONE_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }



}
