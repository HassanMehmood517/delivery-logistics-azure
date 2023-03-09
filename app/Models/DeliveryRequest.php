<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function store()
    {
        return $this->belongsTo(User::class, 'store_id', 'id');
    }

    public function deliveryBoy()
    {
        return $this->belongsTo(User::class, 'delivery_boy_id', 'id');
    }

}
