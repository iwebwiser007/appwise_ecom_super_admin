<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBuy extends Model
{
    use SoftDeletes;
    public $table = 'package_buy';
    protected $guarded = [];

    public function shopOwner()
    {
        return $this->belongsTo(ShopOwner::class);
    }
}
