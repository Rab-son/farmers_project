<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    // View Chats 
    public function viewChats(Request $request){  
        return view ('admin.chats.view_chats');
    }
}
