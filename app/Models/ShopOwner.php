<?php

// app/Models/ShopOwner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOwner extends Model
{
    use HasFactory , SoftDeletes;

    // protected $fillable = [
    //     'name',
    //     'shop_name',
    //     'domain',
    //     'package_id',
    //     'status',
    //     'start_date',
    //     'end_date',
    // ];

    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
