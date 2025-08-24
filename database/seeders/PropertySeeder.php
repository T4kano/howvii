<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/json/properties.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Property::create([
                'property_type_id' => $item->property_type_id,
                'description'      => $item->description,
                'address'          => $item->address,
                'name'             => $item->name
            ]);
        }
    }
}
