<?php
// app/Http/Controllers/InquiriesController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::all();
        return view('admin.inquiry.inquiry', compact('inquiries'));
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        return redirect()->route('inquiries.index')->with('success_message', 'Inquiry deleted successfully!');
    }

    public function changeStatus($id, $status)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $status;
        $inquiry->save();

        return redirect()->route('inquiries.index')->with('success_message', 'Inquiry status updated!');
    }

    public function InquiryDetails($id)
    {
        $inquiry_detail = Inquiry::where('id', $id)->first();
        return view('admin.inquiry.inquiry_details', compact('inquiry_detail'));
    }


    public function inquiryForm(){
        return view('front.inquiry.inquiry');
    }
}