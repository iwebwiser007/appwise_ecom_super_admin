<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesReportExport implements FromView
{
    protected $salesData;

    public function __construct($salesData)
    {
        $this->salesData = $salesData;
    }

    public function view(): View
    {
        return view('front.exports.sales_report', ['salesData' => $this->salesData]);
    }
}
