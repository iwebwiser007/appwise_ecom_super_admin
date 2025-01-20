<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Inquiry;
use App\Models\ShopOwner;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{

    public function inquiryForm()
    {
        return view('front.inquiry.inquiry');
    }

    public function inquirySubmit(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'address' => 'required',
                'message' => 'required',

            ];

            $customMessages = [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required',
                'email.email'       => 'Valid Email Address is required',
                'phone.required' => 'Phone is required.',
                'phone.numeric'  => 'Valid Mobile is required',
                'address.required' => 'Address is required',
                'message.required' => 'Message is required',
            ];

            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Inquiry::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'message' => $data['message']
            ]);

            $email = "sales@appwise.co.za";

            $messageData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'user_message' => $data['message']
            ];

            \Illuminate\Support\Facades\Mail::send('emails.inquiry', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('New Inquiry Received');
            });

            return redirect()->back()->with('success_message', 'Inquiry submitted successfully!');
        } else {
            return view("front.inquiry.inquiry");
        }
    }
}
