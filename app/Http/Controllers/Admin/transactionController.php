<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionExport;

class transactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->type == "export") {
                $transaction = json_decode($request->transaction);
                return Excel::download(new TransactionExport($transaction), 'transaction.xlsx');
            } else {
                $query = Transaction::query();
                if ($request->filled('start_date') && $request->filled('end_date')) {
                    $query->whereBetween('created_at', [
                        $request->start_date,
                        $request->end_date
                    ]);
                }
                $transactions = $query->get();
                return view('admin.transactions.transaction', compact('transactions'));
            }
        }

        $transactions = Transaction::all();
        return view('admin.transactions.transaction', compact('transactions'));
    }
}
