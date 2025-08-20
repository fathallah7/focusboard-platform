<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request) {

        $data = $request->validate([
            'subject' => 'required|string|max:252',
            'message' => 'required|string'
        ]);

            $data['user_id'] = $request->user()->id;
            $message = ContactMessage::create($data);
            return response()->json(['message' => 'sent successfully' , 'data' => $message] , 201);
    }

}
