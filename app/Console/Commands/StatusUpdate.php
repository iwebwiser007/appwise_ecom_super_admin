<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ShopOwner;

use Illuminate\Support\Carbon;

class StatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:statusUpdate';

    /**
     * The console command description.
     * 
     * 
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
 $owners = ShopOwner::with('package')->where('status', 'active')->get();
    
 foreach ($owners as $shopOwner) {
     $createdAt = Carbon::parse($shopOwner->created_at);
     $currentDate = Carbon::now();
     $elapsedDays = $createdAt->diffInDays($currentDate);
     $remainingDays = $shopOwner->package->days - $elapsedDays;
     if ($remainingDays <= 0) {
         $shopOwner->status = 'inactive';
         $shopOwner->save(); 
     }
     \Log::info($remainingDays);
 }        

    }
}
