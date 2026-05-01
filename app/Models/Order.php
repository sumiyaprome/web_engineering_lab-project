<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'address', 'description', 'date', 'payment_type', 'total', 'status', 'deleted'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
