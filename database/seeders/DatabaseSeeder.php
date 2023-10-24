<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Role;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'bank'
        ]);

        Role::create([
            'name' => 'kantin'
        ]);

        Role::create([
            'name' => 'siswa'
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),                   
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Tenizen bank',
            'username' => 'bank',
            'password' => Hash::make('bank'), 
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Tenizen Marketing',
            'username' => 'kantin',
            'password' => Hash::make('kantin'),
            'role_id' => 3
        ]);
        User::create([
            'name' => 'Tio',
            'username' => 'tio',
            'password' => Hash::make('tio'),
            'role_id' => 4
        ]);
        Student::create([
            'user_id' => 4,
            'nis' => 12345,
            'classroom' => 'XII RPL'
        ]);

        Category::create([
            'name' => 'Minuman'
        ]);
        Category::create([
            'name' => 'Makanan'
        ]);
        Category::create([
            'name' => 'Snack'
        ]);

        Product::create([
            'name' => 'Oasis',
            'price' => 2000,
            'stock' => 100,
            'photo' =>'jdakas',
            'desc' => 'Air Mineral',
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'Nasi Goreng',
            'price' => 7000,
            'stock' => 50,
            'photo' =>'drfgldf',
            'desc' => 'Nasi Goreng',
            'category_id' => 2,
        ]);
        Product::create([
            'name' => 'Gorengan',
            'price' => 3000,
            'stock' => 50,
            'photo' =>'odfg',
            'desc' => 'Gorengan',
            'category_id' => 3,
        ]);

        Wallet::create([
            'user_id' => 4,
            'credit' => 200000,
            'debit' => null,
            'description' => 'pembukaan tabungan'
        ]);
        Wallet::create([
            'user_id' => 4,
            'credit' => null,
            'debit' => 10000,
            'description' => 'peembelian produk'
        ]);
        Wallet::create([
            'user_id' => 4,
            'credit' => null,
            'debit' => 10000,
            'description' => 'peembelian produk'
        ]);
        Transaction::create([
            'user_id' => 4,
            'product_id' => 1,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        Transaction::create([
            'user_id' => 4,
            'product_id' => 2,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);
        Transaction::create([
            'user_id' => 4,
            'product_id' => 3,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        
        $total_debit = 0;
        
        $transactions = Transaction::where('order_code'==
        'INV_12345');
        foreach($transactions as $transaction)
        {
            $total_price = $transaction->price * $transaction->quantity;

            $total_debit += $total_price;
        }
        Wallet::create([
            'user_id' => 4,
            'debit' => $total_debit,
            'description' => 'peembelian produk'
        ]);
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'dibayar'
            ]);
        }
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'diambil'
            ]);
        }
    }
}