<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = [
            'user_id' => 1,
            'name' => 'miftah',
            'email' => 'customer@example.com',
            'telp' => '081949123456',
            'address' => 'Indramayu',
            'instansi' => 'Polindra'
        ];

        if (!Customer::where('email', $adminUser['email'])->exists()) {
            Customer::create($adminUser);
        }
    }
}
