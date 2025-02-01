<?php

namespace App\Console\Commands;

use App\Models\PackageBuy;
use Illuminate\Support\Facades\Log;

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
        $packages = PackageBuy::with('shopOwner')->where('status', 'active')->orWhere('status', 'expired')->get();
    
        foreach ($packages as $package) {
            $expiryDate = Carbon::parse($package->created_at)->addDays($package->days);
            
            // Check if package has expired or is active
            if (Carbon::now()->greaterThanOrEqualTo($expiryDate)) {
                if ($package->status !== 'expired') {
                    $package->status = 'expired';
                    $package->save();

                    $email = $package->shopOwner->email; 
                    
                    $messageData = [
                        'email'        => $email,
                        'name'         => $package->shopOwner->name,  
                        'package_id'     => $package->id,               
                        'packageDetail' => $package, 
                        'reminderType' => 'expired'
                         
                    ];
    
                   
                        \Illuminate\Support\Facades\Mail::send('emails.package_expiry', $messageData, function ($message) use ($email) {
                            $message->to($email)->subject("Your Package is Expired");
                        });


                }
            } else {
                if ($package->status === 'expired') {
                    $package->status = 'active';
                    $package->save();
                }

                $remainingDays = Carbon::now()->diffInDays($expiryDate);

    
                if ($remainingDays <= 5 && $remainingDays >= 0) {
                    $email = $package->shopOwner->email; 
                    
                    $messageData = [
                        'email'        => $email,
                        'name'         => $package->shopOwner->name,  
                        'package_id'     => $package->id,               
                        'packageDetail' => $package,  
                        'remainingDays' => $remainingDays,  
                        'reminderType' => 'before_expiry'                
                    ];
    
                   
                        \Illuminate\Support\Facades\Mail::send('emails.package_expiry', $messageData, function ($message) use ($email) {
                            $message->to($email)->subject("Your Package is Expiring Soon");
                        });
                   
                }
            }
        }
    }
}


