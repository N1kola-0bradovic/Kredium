<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use App\Models\CashLoan;
use App\Models\HomeLoan;

class InitiateResourceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a few users
        User::create([
            'name' => 'Nikola Obradovic',
            'email' => 'nikola@test.com',
            'password' => Hash::make('#Test123'),
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@test.com',
            'password' => Hash::make('#Test321'),
        ]);

        //Create a few Clients
        Client::create([
            'first_name' => 'Elon',
            'last_name' => 'Musk',
            'phone' => '111-222',
            'email' => 'elon@test.com'
        ]);

        Client::create([
            'first_name' => 'Bill',
            'last_name' => 'Gates',
            'phone' => '222-333',
            'email' => 'bill@test.com'
        ]);

        //Create a few Products
        CashLoan::create([
            'loan_amount' => 100.00,
            'client_id' => Client::first()->value('id'),
            'user_id' => User::first()->value('id'),
        ]);
        CashLoan::create([
            'loan_amount' => 150.00,
            'client_id' => Client::first()->value('id'),
            'user_id' => User::first()->value('id'),
        ]);
        CashLoan::create([
            'loan_amount' => 200.00,
            'client_id' => Client::latest()->value('id'),
            'user_id' => User::latest()->value('id'),
        ]);
        CashLoan::create([
            'loan_amount' => 250.00,
            'client_id' => Client::latest()->value('id'),
            'user_id' => User::latest()->value('id'),
        ]);

        HomeLoan::create([
            'property_value' => 100.00,
            'down_payment_amount' => 150.00,
            'client_id' => Client::first()->value('id'),
            'user_id' => User::first()->value('id'),
        ]);
        HomeLoan::create([
            'property_value' => 250.00,
            'down_payment_amount' => 200.00,
            'client_id' => Client::first()->value('id'),
            'user_id' => User::first()->value('id'),
        ]);
        HomeLoan::create([
            'property_value' => 300.00,
            'down_payment_amount' => 350.00,
            'client_id' => Client::latest()->value('id'),
            'user_id' => User::latest()->value('id'),
        ]);
        HomeLoan::create([
            'property_value' => 450.00,
            'down_payment_amount' => 400.00,
            'client_id' => Client::latest()->value('id'),
            'user_id' => User::latest()->value('id'),
        ]);
    }
}
