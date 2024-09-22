<?php

namespace Database\Seeders;

use App\Models\Apps\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class AndaLusiaParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // Visitor::truncate();
        // Schema::enableForeignKeyConstraints();

        // Path to your JSON file
        $jsonFile = database_path('data/maha_zone_data.json');

        // Read the file content
        $jsonContent = File::get($jsonFile);

        // Decode the JSON into an array
        $visitors = json_decode($jsonContent, true);

        // Loop through each visitor and insert into the database
        foreach ($visitors as $visitorData) {
            $cleanIcNumber = $this->cleanIcNumber($visitorData['ic_number'] ?? null);
            $cleanPhoneNumber = $this->cleanPhoneNumber($visitorData['phone'] ?? null);

            Visitor::create([
                'zone_id'   => $visitorData['zone_id'],  // Since zone_id is part of the JSON data
                'name'      => strtoupper($visitorData['name'] ?? 'Unknown'),
                'ic_number' => $cleanIcNumber,
                'phone'     => $cleanPhoneNumber,
                'email'     => $visitorData['email'] ?? null,
            ]);
        }
    }

    // Clean the IC Number (you can define your cleaning logic here)
    private function cleanIcNumber($icNumber)
    {
        return preg_replace('/[^0-9]/', '', $icNumber); // Keep only digits
    }

    // Clean the Phone Number (define your own cleaning logic)
    private function cleanPhoneNumber($phone)
    {
        return preg_replace('/[^0-9]/', '', $phone); // Keep only digits
    }
}
