<?php

namespace Database\Seeders;

use App\Models\Apps\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        DB::table('zones')->truncate();
        Schema::enableForeignKeyConstraints();

        $zones = [
            [
                'name'        => 'KINGDOM OF AGROFOOD',
                'description' => null,
            ],
            [
                'name'        => 'HALL A',
                'description' => null,
            ],
            [
                'name'        => 'KRAFTANGAN MALAYSIA',
                'description' => null,
            ],
            [
                'name'        => 'PAVILION AGRO MADANI',
                'description' => null,
            ],
            [
                'name'        => 'HALL B-LOWER GROUND',
                'description' => null,
            ],
            [
                'name'        => 'HALL C',
                'description' => null,
            ],
            [
                'name'        => 'HALL DG',
                'description' => null,
            ],
            [
                'name'        => 'HALL D1',
                'description' => null,
            ],
            [
                'name'        => 'HALL D2 ( LEFT SIDE)',
                'description' => null,
            ],
            [
                'name'        => 'HALL D2 (RIGHT SIDE)',
                'description' => null,
            ],
            [
                'name'        => 'MARQUEE TENT KLUSTER AGRO BUSINESS',
                'description' => null,
            ],
            [
                'name'        => 'AMPHITHEATER',
                'description' => null,
            ],
            [
                'name'        => 'RHYTHM OF THE FARMERS (ROTF)',
                'description' => null,
            ],
            [
                'name'        => 'GLAMPING & MOTORHOME',
                'description' => null,
            ],
            [
                'name'        => 'MAJLIS BELIA MALAYSIA (MBM)',
                'description' => null,
            ],
            [
                'name'        => 'MYSTICAL GARDEN',
                'description' => null,
            ],
            [
                'name'        => 'ASTANA PAVILION',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN ORKID',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN FLORIKULTUR',
                'description' => null,
            ],
            [
                'name'        => 'PAVILION NEGERI',
                'description' => null,
            ],
            [
                'name'        => 'JABATAN WILAYAH PERSEKUTUAN',
                'description' => null,
            ],
            [
                'name'        => 'KEMENTERIAN KEMAJUAN DESA DAN WILAYAH (KKDW)',
                'description' => null,
            ],
            [
                'name'        => 'MAGICAL NIGHT & 3D WATER SHOW',
                'description' => null,
            ],
            [
                'name'        => 'FLOATING MARKET',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN SAYUR',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN HERBA',
                'description' => null,
            ],
            [
                'name'        => 'TROPICAL GARDEN CAFE',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN PERIKANAN',
                'description' => null,
            ],
            [
                'name'        => 'JUALAN IKAN SEGAR & PRODUK INDUSTRI ASAS TANI',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN PADI',
                'description' => null,
            ],
            [
                'name'        => 'KIDS ATTRACTION',
                'description' => null,
            ],
            [
                'name'        => 'FOOD TRUCK',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN AGRO FOOD NANAS ( ZON 1 : VIBES AT LAMAN NANAS)',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN AGRO FOOD NANAS (ZON 2 : PINEAPPLE HEALING LAKES)',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN AGRO FOOD NANAS ( ZON 3 : LADANG LAMAN AGRO- FOOD NANAS)',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN MEKANISASI',
                'description' => null,
            ],
            [
                'name'        => 'LAMAN TERNAKAN',
                'description' => null,
            ],
            [
                'name'        => 'WEB SITE',
                'description' => null,
            ],
        ];

        foreach ($zones as $zone) {
            $filePath        = null;
            $zoneName       = Str::slug($zone['name']);

            $num_str        = sprintf("%06d", mt_rand(1, 999999));
            $uniq           = 'MAHA24_ZONE_' . strtoupper($num_str) . '_' . $zoneName;
            $qrcodeFilePath = public_path('assets/qrcode/' . $uniq . '.png');

            // $urlGenerate    = URL::to('?zone=' . $zoneName);
            $urlGenerate    = 'https://maha2024.online/?zone=' . $zoneName;

            // QrCode::size(500)->format('png')->generate($urlGenerate, $qrcodeFilePath);
            // $filePath = 'assets/qrcode/' . $uniq . '.png';

            Zone::create([
                'uniq'        => $uniq,
                'slug'        => $zoneName,
                'name'        => $zone['name'],
                'description' => $zone['description'],
                'qr_code'     => $filePath,
            ]);
        }
    }
}
