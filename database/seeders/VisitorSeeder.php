<?php

namespace Database\Seeders;

use App\Models\Apps\Visitor;
use App\Models\Apps\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datavisitors = [
            [
                'ic_number'     => '860618565848',
                'name'          => 'MICHELLE KONG',
                'phone'         => '0193636821',
                'email'         => 'mkms86@gmail.com',
                'state'         => 'kuala lumpur',
                'gender'        => 'wanita',
                'know_platform' => [
                    'social_media',
                    'emails',
                    'events_calendar',
                    'celebrity',
                ],
                'total'         => '100.00',
            ],
            [
                'ic_number'     => '971225145715',
                'name'          => 'RIDZWAN BIN RASUL',
                'phone'         => '0192950273',
                'email'         => 'ridzwaaan@gmail.com',
                'state'         => 'kuala lumpur',
                'gender'        => 'lelaki',
                'know_platform' => [
                    'social_media',
                    'emails',
                    'events_calendar',
                    'celebrity',
                ],
                'total'         => '100.00',
            ],
        ];

        $rotf = Zone::where('name', 'RHYTHM OF THE FARMERS (ROTF)')->first();

        foreach ($datavisitors as $datavisitor) {
            $visitor = Visitor::create([
                'zone_id'       => $rotf->id,
                'name'          => $datavisitor['name'],
                'ic_number'     => $datavisitor['ic_number'],
                'phone'         => $datavisitor['phone'],
                'email'         => $datavisitor['email'],
                'know_platform' => json_encode($datavisitor['know_platform']),
                'total'         => $datavisitor['total'],
                'state'         => $datavisitor['state'],
                'gender'        => $datavisitor['gender'],
            ]);

            $qrcodeFilePath = public_path('assets/qrcode/' . $visitor->uniq . '.png');
            QrCode::size(500)->format('png')->generate($visitor->uniq, $qrcodeFilePath);
            $filePath = 'assets/qrcode/' . $visitor->uniq . '.png';

            // Update visitor with QR code path
            $visitor->update([
                'qr_code' => $filePath
            ]);
        }
    }
}
