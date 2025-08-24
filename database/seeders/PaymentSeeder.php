<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/json/payments.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Payment::create([
                'property_id' => $item->property_id,
                'customer_id' => $item->customer_id,
                'paid_at'     => $item->paid_at,
                'amount'      => $item->amount
            ]);
        }
    }
}
