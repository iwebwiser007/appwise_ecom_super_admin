<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PackagePurchaseExport implements FromView
{
    protected $packageBuy;

    public function __construct($package_purchase)
    {
        $this->packageBuy = $package_purchase;
    }

    public function view(): View
    {
        return view('front.exports.package_purchase', ['packageBuy' => $this->packageBuy]);
    }
}
