<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletDetail extends Model
{
    protected $fillable = ['wallet_id', 'number', 'cvv', 'balance'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
