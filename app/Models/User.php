<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['role', 'name', 'username', 'password', 'email', 'address', 'contact', 'verified', 'deleted'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'customer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'poster_id');
    }

    public function ticketDetails()
    {
        return $this->hasMany(TicketDetail::class, 'user_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
