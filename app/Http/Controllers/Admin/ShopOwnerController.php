<?php


namespace App\Http\Controllers\Admin;

use App\Models\ShopOwner;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageBuy;
use Carbon\Carbon;
use App\Services\PackageLogicService;

class ShopOwnerController extends Controller
{
    protected $packageLogicService;

    public function __construct(PackageLogicService $packageLogicService)
    {
        $this->packageLogicService = $packageLogicService;
    }

    public function index()
    {
        $shopOwners = ShopOwner::all();
        return view('admin.shop-owner.shop_owner', compact('shopOwners'));
    }

    public function addEditShopOwner(Request $request, $id = null)
    {
        $shopOwner = $id ? ShopOwner::find($id) : null;
        $packages = Package::all();

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'shop_name' => 'required|string|max:255',
                'domain' => 'nullable|string|max:255',
                'package_id' => 'required|exists:packages,id',
                'status' => 'required|in:active,inactive,suspended',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required'
            ]);

            $package = Package::find($validated['package_id']);

            $days = $package->days ?? 0;
            $startDate = $validated['start_date'] ?? now()->toDateString();
            $endDate = Carbon::parse($startDate)->addDays($days)->toDateString();
            $validated['start_date'] = $startDate;
            $validated['end_date'] = $endDate;
            if ($shopOwner) {
                $shopOwner->update($validated);
                $message = 'Shop Owner updated successfully.';
            } else {
                $shopOwner = ShopOwner::create($validated);
                $message = 'Shop Owner added successfully.';

                PackageBuy::create([
                    'package_id' => $package->id,
                    'shop_owner_id' => $shopOwner->id,
                    'package_name' => $package->name,
                    'number_of_section' => $package->number_of_section,
                    'number_of_category' => $package->number_of_category,
                    'number_of_product' => $package->number_of_product,
                    'price' => $package->price,
                    'days' => $package->days,
                    'status' => $shopOwner->status,
                ]);
            }
            return redirect()->route('admin.shopOwners')->with('success_message', $message);
        }
        return view('admin.shop-owner.add_edit_shop_owner', compact('shopOwner', 'packages'));
    }

    public function deleteShopOwner($id)
    {
        $shopOwner = ShopOwner::findOrFail($id);
        $shopOwner->delete();
        return redirect()->route('admin.shopOwners')->with('success_message', 'Shop Owner deleted successfully.');
    }

    public function getSalesStatistics()
    {
        $salesData = ShopOwner::whereNotNull('created_at')
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, count(*) as total')
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
        return view('admin.dashboard', compact('labels', 'data'));
    }

    public function changeOwnerStatus(Request $request)
    {

        ShopOwner::where('id', $request->owner_id)->update([
            "status" => $request->status
        ]);

        PackageBuy::where('shop_owner_id', $request->owner_id)->update([
            "status" => $request->status
        ]);
        return response()->json(['success' => true]);
    }


    public function showShopOwner($id)
    {
        $shopOwnerDetails = ShopOwner::with('package')->find($id);
        return view('admin.shop-owner.show_shop_owner', compact('shopOwnerDetails'));
    }

    public function salesReport()
    {
        $shopOwners = ShopOwner::all();
        return view('admin.sales.shop_owners', compact('shopOwners'));
        // return "hello";
    }

    public function shopSaleReports(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $shopOwner = ShopOwner::where('id', $id)->first();
            $owner_id = $shopOwner['id'];

            $data = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'type' => 'filter'
            ];

            $data = json_encode($data);
            $domainUrl = $shopOwner['domain'];

            $response = $this->packageLogicService->saleReports($domainUrl, $data);

            $salesData = $response['order'];

            if (isset($response['error']) && $response['error']) {
                return response()->json([
                    'message' => 'Failed to upgrade package.',
                    'details' => $response['message'],
                ], 500);
            }

            return view('admin.sales.sales-report', [
                'salesData' => $salesData,
                'owner_id' => $owner_id
            ]);
        } else {
            $data = [
                "id" => '1'
            ];

            $shopOwner = ShopOwner::where('id', $id)->first();
            $owner_id = $shopOwner['id'];

            $domainUrl = $shopOwner['domain'];

            if (empty($domainUrl)) {
                // return redirect()->back()->with('error_message', 'domain name is required');
                return redirect()->back()->with('error_message', 'Please provide domain name.');
            }

            // $domainUrl = 'http://localhost/appwise';

            $response = $this->packageLogicService->saleReports($domainUrl, $data);

            if (!empty($response['order'])) {
                $salesData = $response['order'];
            } else {
                return redirect()->back()->with('error_message', 'Domain Name Not Found.');
            }

            $salesData = $response['order'];

            if (isset($response['error']) && $response['error']) {
                return response()->json([
                    'message' => 'Failed to upgrade package.',
                    'details' => $response['message'],
                ], 500);
            }



            return view('admin.sales.sales-report', [
                'salesData' => $salesData,
                'owner_id' => $owner_id
            ]);
        }
    }

    public function orders(Request $request) {}
}
