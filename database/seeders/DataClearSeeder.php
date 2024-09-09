<?php

namespace Database\Seeders;

use App\Models\Apps\Visitor;
use App\Models\Apps\VisitorReceipt;
use App\Models\Apps\Zone;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DataClearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Visitor::truncate();
        VisitorReceipt::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = Faker::create();

        // Fetch all zones from the database
        $zones = Zone::all()->pluck('id', 'slug')->toArray();

        for ($i = 0; $i < 1000; $i++) {
            // Pick a random zone slug
            $zoneSlug = array_rand($zones);
            $zoneId = $zones[$zoneSlug];

            // Generate clean values for ic_number and phone
            $cleanIcNumber = $faker->numerify('##########');
            $cleanPhoneNumber = $faker->numerify('##########');

            // Create a visitor
            $visitor = Visitor::create([
                'zone_id'       => $zoneId,
                'name'          => $faker->name,
                'ic_number'     => $cleanIcNumber,
                'phone'         => $cleanPhoneNumber,
                'email'         => $faker->safeEmail,
                'know_platform' => json_encode([$faker->word, $faker->word]),
                'total'         => $faker->numberBetween(1, 1000),
            ]);

            // Generate QR code
            $qrcodeFilePath = public_path('assets/qrcode/' . $visitor->uniq . '.png');
            QrCode::size(500)->format('png')->generate($visitor->uniq, $qrcodeFilePath);
            $filePath = 'assets/qrcode/' . $visitor->uniq . '.png';

            // Update visitor with QR code path
            $visitor->update([
                'qr_code' => $filePath
            ]);

            // Create visitor receipts
            /*for ($j = 0; $j < 5; $j++) {
                // Generate a random image file in a temporary directory
                $tempFile = $faker->image(null, 640, 480, null, false);

                // Ensure the file exists before attempting to copy it
                if (file_exists($tempFile)) {
                    // Generate a new file name with a timestamp and random string
                    $extension = pathinfo($tempFile, PATHINFO_EXTENSION);
                    $randomString = Str::random(6);
                    $filename = now()->format('YmdHis') . '_' . $randomString . '.' . $extension;
                    $destinationPath = public_path('assets/upload/receipts');
                    $filePath = 'assets/upload/receipts/' . $filename;

                    // Create directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Move the file to the correct directory
                    copy($tempFile, $destinationPath . '/' . $filename);
                    unlink($tempFile); // Delete the temporary file after moving

                    // Create a visitor receipt
                    VisitorReceipt::create([
                        'visitor_id' => $visitor->id,
                        'receipt' => $filePath,
                        'amount' => $faker->numberBetween(1, 1000)
                    ]);
                } else {
                    // Handle the case where the file does not exist
                    $this->command->error("Temporary file does not exist: $tempFile");
                }
            }*/
        }
    }
}
