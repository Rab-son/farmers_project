<?php

namespace App\Http\Controllers;
use App\UsersPhoneNumber;// Adding phoneNumber Model
use Twilio\Rest\Client;// Rest API
use Illuminate\Http\Request;
use Session;

class SmsesController extends Controller
{
/**
 * Store a new user phone number.
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
        $this->sendMessage('User registration successful!!', $request->phone_number);
        return back()->with(['success' => "{$request->phone_number} registered"]);
    }
    /**
     * Show the forms with users phone number details.
     * @return Response
     */
    public function show()
    {
        if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }

        $users = UsersPhoneNumber::all(); //query db with model
       // return view('welcome', compact("users")); //return view with data
        return view('admin.smses.show_phonenumber')->with(compact('users'));
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    private function sendMessage($message, $recipients)
    {
        if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
                ['from' => $twilio_number, 'body' => $message] );
    }

    /**
     * Send message to a selected users
     */
    public function sendCustomMessage(Request $request)
    {
        if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }

        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }

}
