<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/json/customers.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Customer::create([
                'email' => $item->email,
                'name'  => $item->name
            ]);
        }
    }
}
