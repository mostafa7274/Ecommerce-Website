<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        // Ensure this method retrieves messages and returns a view
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }
}
