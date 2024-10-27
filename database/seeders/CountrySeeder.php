<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Fetching all countries data...');

        // Read JSON with data
        $phoneCodesJson = File::get(database_path('seeders/countries-phone-codes.json'));
        $phoneCodes = json_decode($phoneCodesJson, true);

        foreach ($phoneCodes as $countryData) {
            Country::updateOrCreate(
                ['code' => $countryData['code']], // Use 'code' as a unique identifier
                [
                    'name' => $countryData['name'],
                    'dial_code' => $countryData['dial_code'],
                ]
            );
        }

        $this->command->info('Countries seeded successfully');
    }
}
