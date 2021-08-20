<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Notifications\sendContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class contactController extends Controller
{
    //
    public function contact(Request $request){
        $this->validate($request, [
            'name' => ['string', 'required'],
            'email' => ['email', 'required'],
            'message' => ['required'],
        ]);

        $contact = Contact::create($request->all());
        Notification::route('mail', 'info@4mconsulting.co.ke')->notify(new sendContact($contact));
        return redirect(route('index'))->with('success', 'Thank you for contacting us. We will be in touch');
    }
}
