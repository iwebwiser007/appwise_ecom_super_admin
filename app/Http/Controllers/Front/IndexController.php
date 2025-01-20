<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\ShopOwner;
use App\Models\PackageBuy;
use App\Models\Page;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', 'Active')->get();
        $users = User::where('id', '1')->get();
        return view('front.index', compact('packages', 'users'));
    }

    public function saveOwnerDetails(Request $request, $id)
    {
        // return $request;
        // $validated = $request->validate([
        //     'name' => 'required|string',
        //     // 'shop_name' => 'required|string',
        //     // 'domain' => 'required|string',
        //     // // 'address' => 'required|string',
        //     // 'package_id' => 'required|integer',
        //     // // 'price' => 'required|numeric',
        //     // 'status' => 'active'
        // ]);
        // return "hello";
        // $owner = ShopOwner::create($validated);
        // return $request;
        $owner = ShopOwner::create([
            'name' => $request->owner_name,
            'shop_name' => $request->shop_name,
            'email' => $request->shop_email,
            'phone' => $request->shop_phone,
            'domain' => $request->domain ?? "",
            'address' => $request->address,
            'package_id' => $id,
            // 'price' => 'required|numeric',
            'status' => 'active'
        ]);
        // return $owner;
        $owner_id = $owner->id;
        // Redirect to the payment page
        return redirect()->route('package.payment', ['id' => $id, 'owner_id' => $owner_id]);
    }

    public function paymentPage($id, Request $request)
    {
        $package = Package::findOrFail($id);
        $owner_id = $request->owner_id;
        return view('front.payment_page', compact('package', 'owner_id'));
    }

    public function processPayment(Request $request, $id)
    {
        // Retrieve the package details
        $package = Package::find($id);
        $owner_id = $request->owner_id;
        $price = $package->price; // Price dynamically fetched from the database

        // Capture request data (useful for logging, debugging, etc.)
        $requestData = $request->all();
        \Log::info('Payment Request Data:', $requestData);

        if ($request->payment_method === 'cod') {
            // Handle Cash on Delivery (COD) payment
            PackageBuy::create([
                'package_id' => $request->package_id,
                'shop_owner_id' => $owner_id,
                'package_name' => $package->name,
                'number_of_section' => $package->number_of_section,
                'number_of_category' => $package->number_of_category,
                'number_of_product' => $package->number_of_product,
                'price' => $price,
                'days' => $package->days,
            ]);

            // Return success view for COD
            return view('front.payment_success', ['message' => 'Order placed successfully with Cash on Delivery!']);
        } elseif ($request->payment_method === 'payfast') {
            // Redirect to PayFast with dynamic data
            return redirect()->route('payfast', [
                'package_id' => $package->id,
                'owner_id' => $owner_id,
                'price' => $price,
                'payment_method' => 'payfast',
                'package_name' => $package->name
            ]);
        }

        // Handle invalid payment method
        return back()->withErrors(['error' => 'Invalid payment method selected']);
    }

    public function termAndCondition()
    {
        $page = Page::where('id', '2')->first();
        return view('front.pages.term_&_condition', compact('page'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('id', '3')->first();
        return view('front.pages.privacy_policy', compact('page'));
    }
}
