<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Package;
use App\Models\PackageBuy;
use App\Models\Setting;
use App\Models\ShopOwner;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Exports\SalesReportExport;
use App\Models\Page;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email'    => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required'    => 'Email Address is required!',
                'email.email'       => 'Valid Email Address is required',
                'password.required' => 'Password is required!',
            ];

            $request->validate($rules, $customMessages);



            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = Auth::user();
                return redirect('/admin/dashboard');
                // if ($user->type == 'admin' && $user->status == '0') {
                //     Auth::logout();
                //     return redirect()->back()->with('error_message', 'Your admin account is not active');
                // } elseif ($user->type == 'superadmin' || $user->type == 'admin') {
                //     return redirect('/admin/dashboard');
                // } else {
                //     Auth::logout();
                //     return redirect()->back()->with('error_message', 'Unauthorized access');
                // }
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }

        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }

    public function dashboard()
    {
        $totalPackages = Package::all()->count();
        $activePackages = Package::all()->where('status', 'Active')->count();
        $totalShopOwner = ShopOwner::all()->count();
        $recentInquiries = Inquiry::latest()->take(5)->get();
        $salesData = ShopOwner::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, count(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();
        $labels = [];
        $data = [];
        foreach ($salesData as $sale) {
            $labels[] = Carbon::createFromDate($sale->year, $sale->month, 1)->format('M Y');
            $data[] = $sale->total;
        }
        return view('admin.index', compact(
            'totalPackages',
            'activePackages',
            'totalShopOwner',
            'recentInquiries',
            'labels',
            'data'
        ));
    }

    public function delete($type, $id)
    {
        if ($type === "package") {
            $area = Package::findOrFail($id);
            $area->delete();
            return redirect()->back()->with('success_message', "Package delete succesfully");
        } elseif ($type === "owner") {
            $owner = ShopOwner::findOrFail($id);
            $packageBuy = PackageBuy::where('shop_owner_id', $owner->id)->get();
            if ($packageBuy->isNotEmpty()) {
                $packageBuy[0]->delete();
            }
            $owner->delete();
            return redirect()->back()->with('success_message', "ShopOwner deleted successfully");
        } elseif ($type === "user") {
            $owner = User::findOrFail($id);
            $owner->delete();
            return redirect()->back()->with('success_message', "User delete succesfully");
        } elseif ($type === "package_buy") {
            $area = PackageBuy::findOrFail($id);
            $area->delete();
            return redirect()->back()->with('success_message', "Package delete succesfully");
        } elseif ($type === "page") {
            $area = Page::findOrFail($id);
            $area->delete();
            return redirect()->back()->with('success_message', "Page delete succesfully");
        } elseif ($type === "inquiry") {
            $area = Inquiry::findOrFail($id);
            $area->delete();
            return redirect()->back()->with('success_message', "Inquiry delete succesfully");
        } elseif ($type === "transaction") {
            $area = Transaction::findOrFail($id);
            $area->delete();
            return redirect()->back()->with('success_message', "Transaction delete succesfully");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }


    public function adminDetails(Request $request)
    {
        return view('admin.setting.update_admin_detail');
    }

    public function updateAdminDetails(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_mobile' => 'nullable|numeric|digits:10',
            'admin_address' => 'nullable|string|max:500',
            'admin_latitude' => 'nullable|numeric',
            'admin_longitude' => 'nullable|numeric',
            'admin_country' => 'nullable|string|max:255',
            'admin_state' => 'nullable|string|max:255',
            'admin_city' => 'nullable|string|max:255',
            'admin_pincode' => 'nullable|string|max:10',
            'admin_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for the image file
        ]);

        $user = Auth::user(); // Authenticated user

        $user->name = $request->input('admin_name');
        $user->mobile = $request->input('admin_mobile');
        $user->address = $request->input('admin_address');
        $user->country = $request->input('admin_country');
        $user->state = $request->input('admin_state');
        $user->city = $request->input('admin_city');
        $user->postal_code = $request->input('admin_pincode');
        $user->latitude = $request->admin_latitude;
        $user->longitude = $request->admin_longitude;
        if ($request->hasFile('admin_image')) {
            $image = $request->file('admin_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/photos'), $imageName);
            $user->image = $imageName;
        }
        $user->save();
        Session::flash('success_message', 'Admin details updated successfully.');
        return redirect()->back(); // Or you can redirect to a specific route
    }



    public function adminprofile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin.setting.admin_profile', compact('user'));
    }


    public function updateLogo(Request $request)
    {
        // Check if any data is being posted (i.e., if there's any file uploaded)
        if ($request->isMethod('post')) {
            // Validate the uploaded files
            $settings = Setting::where('id', '1')->first();

            $request->validate([
                'admin_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'front_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Handle the Admin Logo
            if ($request->hasFile('admin_logo')) {

                // Handle the uploaded admin logo
                $admin_logo = $request->file('admin_logo');

                $admin_logo_name =  time() . '.' . $admin_logo->getClientOriginalExtension();
                $admin_logo->move(public_path('admin/images/logo'), $admin_logo_name);

                // Delete the old admin logo if it exists
                if (!empty($settings->admin_logo) && file_exists(public_path('admin/images/logo/' . $settings->admin_logo))) {
                    unlink(public_path('admin/images/logo/' . $settings->admin_logo));
                }

                Setting::where('id', '1')->update([
                    'admin_logo' => $admin_logo_name
                ]);
            }

            if ($request->hasFile('front_logo')) {

                // Handle the uploaded front logo
                $front_logo = $request->file('front_logo');
                $front_logo_name =  time() . '.' . $front_logo->getClientOriginalExtension();
                $front_logo->move(public_path('front/images/logo'), $front_logo_name);

                // Delete the old front logo if it exists
                if (!empty($settings->admin_logo) && file_exists(public_path('front/images/logo/' . $settings->front_logo))) {
                    unlink(public_path('front/images/logo/' . $settings->front_logo));
                }
                // Update the front logo path in the database

                Setting::where('id', '1')->update([
                    'front_logo' => $front_logo_name
                ]);
            }
            // dd($settings);
            // Save the changes to the database
            // Return success message and redirect to the logo page
            return redirect()->route('logo')->with('success_message', 'Logos updated successfully!');
        } else {
            $setting = Setting::where('id', '1')->first();
            return view('admin.setting.admin_logo', compact('setting'));
        }
    }
    public function updateAdminPassword(Request $request)
    {
        // Correcting issues in the Skydash Admin Panel Sidebar using Session
        Session::put('page', 'update_admin_password');
        // Handling the update admin password <form> submission (POST request) in update_admin_password.blade.php
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            // Check first if the entered admin current password is corret
            if (Hash::check($data['current_password'], Auth::user()->password)) {
                // Check if the new password is matching with confirm password
                if ($data['confirm_password'] == $data['new_password']) {
                    User::where('id', Auth::user()->id)->update([
                        'password' => bcrypt($data['new_password'])
                    ]);

                    Auth::logout();
                    return redirect('admin/login')->with('success_message', 'Admin Password has been updated successfully!');
                    // return redirect()->back()->with('success_message', 'Admin Password has been updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current admin password is Incorrect!');
            }
        }


        $adminDetails = User::where('email', Auth::user()->email)->first()->toArray(); // 'Admin' is the Admin.php model    // Auth::guard('admin') is the authenticated user using the 'admin' guard we created in auth.php    // https://laravel.com/docs/9.x/eloquent#retrieving-models    // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances


        return view('admin.setting.update_admin_password')->with(compact('adminDetails'));
    }


    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();

        if (Hash::check($data['current_password'], Auth::user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function exportSalesReport(Request $request)
    {
        $salesData = json_decode($request->salesData);
        return Excel::download(new SalesReportExport($salesData), 'sales_report.xlsx');
    }
}