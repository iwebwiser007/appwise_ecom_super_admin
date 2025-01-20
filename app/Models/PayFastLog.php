<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayFastLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'logs', 'data',
       ];
}
