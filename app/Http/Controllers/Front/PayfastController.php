<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageBuy;
use App\Models\PackageLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\PayFastLog;
use App\Models\ShopOwner;
use App\Models\Transaction;
use App\Services\PackageLogicService;
use Illuminate\Support\Str;

class PayfastController extends Controller
{

    protected $packageLogicService;

    public function __construct(PackageLogicService $packageLogicService)
    {
        $this->packageLogicService = $packageLogicService;
    }

    public function payFast(Request $request)
    {
        $package_id = $request->package_id;
        $package_name = $request->package_name;
        $price = $request->price;
        $owner_id = $request->owner_id;

        Session::put('payfast_data', [
            'package_id' => $package_id,
            'package_name' => $package_name,
            'price' => $price,
            'owner_id' => $owner_id
        ]);

        $passphrase = 'jt7NOE43FZPn';
        $merchant_id = '10000100';
        $merchant_key = '46f0cd694581a';

        // $passphrase = 'Appwiseisno1';
        // $merchant_id = '17557494';
        // $merchant_key = '5i2mnu7g9frwg';

        $return_url = route('payfastsuccess');
        $cancel_url = route('payfastcancel');
        $notify_url = route('payfastnotify');

        $data = array(
            'merchant_id' => $merchant_id,
            'merchant_key' => $merchant_key,
            'return_url' => $return_url,
            'cancel_url' => $cancel_url,
            'notify_url' => $notify_url,
            // 'name_first' => Auth::user()->name,
            // 'name_last' => Auth::user()->name,
            // 'email_address' => Auth::user()->email,
            'm_payment_id' => $package_id,
            'amount' => number_format($price, 2, '.', ''),
            'item_name' => $package_name,
        );

        // PayFastLog::create([
        //     'logs' => 'PayFast Payment Initiated',
        //     'data' => json_encode($data),
        // ]);

        $signature = $this->generateSignature($data, $passphrase);
        $data['signature'] = $signature;

        $testingMode = true;

        $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        $htmlForm = '<form action="https://' . $pfHost . '/eng/process" method="post" id="payfastform">';
        foreach ($data as $name => $value) {
            $htmlForm .= '<input name="' . $name . '" type="hidden" value=\'' . $value . '\' />';
        }
        // $htmlForm .= '<input type="submit" id="payfastbtn" value="Pay Now" />';
        $htmlForm .= '</form>';

        return view('front.payfast.form')->with(['htmlForm' => $htmlForm]);
    }

    public function payFastSuccess(Request $request)
    {
        $payfastData = Session::get('payfast_data');
        PayFastLog::create([
            'logs' => 'PayFast Payment Success',
            'data' => json_encode($request->all())
        ]);

        if (!$payfastData) {
            return view('front.payment_error', ['message' => 'Payment data not found.']);
        }

        $package = Package::where('id', '=', $payfastData['package_id'])->first();

        $transaction_id = 'PF' . strtoupper(Str::random(12));

        PackageBuy::create([
            'package_id' => $payfastData['package_id'],
            'shop_owner_id' => $payfastData['owner_id'],
            'package_name' => $payfastData['package_name'],
            'price' => $payfastData['price'],
            'number_of_section' => $package['number_of_section'],
            'number_of_category' => $package['number_of_category'],
            'number_of_product' => $package['number_of_product'],
            'days' => $package['days'],
            'status' => 'active',
            'payment_method' => "PayFast",
        ]);

        Transaction::create([
            'owner_id' => $payfastData['owner_id'],
            'transaction_id' => $transaction_id,
            'package_name' => $payfastData['package_name'],
            'amount' => $payfastData['price'],
            'payment_method' => 'PayFast',

        ]);

        $shopOwner = ShopOwner::where('id', $payfastData['owner_id'])->first();

        $data = [
            "package_id" => $package->id,
            "name" => $package->name,
            "number_of_section" => $package->number_of_section,
            "number_of_category" => $package->number_of_category,
            "number_of_product" => $package->number_of_product,
            "price" => $package->price,
            "days" => $package->days
        ];

        $data = json_encode($data);
        $paylog = PackageLog::create([
            'logs' => $data
        ]);

        // $domainUrl = 'http://localhost/appwise';
        $domainUrl = $shopOwner['domain'];

        $response = $this->packageLogicService->sendPackageUpgradeData($domainUrl, $data);

        return view('front.payment_success', ['message' => 'Payment successful!']);
    }



    public function payFastCancel(Request $request)
    {
        PayFastLog::create([
            'logs' => 'PayFast Payment Cancelled',
            'data' => json_encode($request->all())
        ]);
        return redirect('/home');
        // return view('front.payment_cancelled', ['message' => 'Payment was cancelled.']);
    }

    public function payFastNotify(Request $request)
    {
        PayFastLog::create([
            'logs' => 'PayFast Payment Notification',
            'data' => json_encode($request->all())
        ]);

        return response()->json(['status' => 'success']);
    }

    function generateSignature($data, $passPhrase = null)
    {
        // Create parameter string
        $pfOutput = '';
        foreach ($data as $key => $val) {
            if ($val !== '') {
                $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
            }
        }

        // Remove last ampersand
        $getString = substr($pfOutput, 0, -1);
        if ($passPhrase !== null) {
            $getString .= '&passphrase=' . urlencode(trim($passPhrase));
        }

        return md5($getString);
    }
}
