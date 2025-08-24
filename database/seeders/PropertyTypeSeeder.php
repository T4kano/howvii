<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/json/property_types.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            PropertyType::create([
                'name'     => $item->name,
            ]);
        }
    }
}
