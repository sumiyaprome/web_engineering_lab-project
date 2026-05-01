<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['customer_id'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function walletDetails()
    {
        return $this->hasMany(WalletDetail::class);
    }
}
