<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Wallet;
use App\Models\WalletDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample users
        $users = [
            [
                'role' => 'Administrator',
                'name' => 'Admin 1',
                'username' => 'root',
                'password' => 'toor',
                'email' => '',
                'address' => 'Address 1',
                'contact' => 9898000000,
                'verified' => true,
            ],
            [
                'role' => 'Customer',
                'name' => 'Customer 1',
                'username' => 'user1',
                'password' => 'pass1',
                'email' => 'mail2@example.com',
                'address' => 'Address 2',
                'contact' => 9898000001,
                'verified' => true,
            ],
            [
                'role' => 'Customer',
                'name' => 'Customer 2',
                'username' => 'user2',
                'password' => 'pass2',
                'email' => 'mail3@example.com',
                'address' => 'Address 3',
                'contact' => 9898000002,
                'verified' => true,
            ],
            [
                'role' => 'Customer',
                'name' => 'Customer 3',
                'username' => 'user3',
                'password' => 'pass3',
                'email' => '',
                'address' => '',
                'contact' => 9898000003,
                'verified' => false,
            ],
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }

        // Create sample items
        $items = [
            ['name' => 'Item 1', 'price' => 25, 'deleted' => true],
            ['name' => 'Item 2', 'price' => 45, 'deleted' => false],
            ['name' => 'Item 3', 'price' => 20, 'deleted' => false],
            ['name' => 'Item 4', 'price' => 15, 'deleted' => true],
            ['name' => 'Item 5', 'price' => 20, 'deleted' => false],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }

        // Create wallets and wallet details for users
        $walletData = [
            ['customer_id' => 1, 'number' => '6155247490533921', 'cvv' => 983, 'balance' => 3430],
            ['customer_id' => 2, 'number' => '1887587142382050', 'cvv' => 772, 'balance' => 1850],
            ['customer_id' => 3, 'number' => '4595809639046830', 'cvv' => 532, 'balance' => 1585],
            ['customer_id' => 4, 'number' => '5475856443351234', 'cvv' => 521, 'balance' => 2000],
        ];

        foreach ($walletData as $data) {
            $wallet = Wallet::create(['customer_id' => $data['customer_id']]);
            WalletDetail::create([
                'wallet_id' => $wallet->id,
                'number' => $data['number'],
                'cvv' => $data['cvv'],
                'balance' => $data['balance'],
            ]);
        }
    }
}
