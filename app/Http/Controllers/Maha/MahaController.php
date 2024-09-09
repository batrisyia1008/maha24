<?php

namespace App\Http\Controllers\Maha;

use App\Http\Controllers\Controller;
use App\Models\Apps\Zone;
use App\Models\Apps\Visitor;
use App\Models\Apps\VisitorReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MahaController extends Controller
{
    public function welcome(Request $request)
    {
        if ($request->has('zone')) {
            $zone = $request->query('zone');
            $data = Zone::where('slug', $zone)->firstOrFail();
            Session::put('zoneData', $data);
            return response()->view('maha.welcome');
        } else {
            return response()->view('maha.welcome');
        }
    }

    public function register(){
        $data     = Session::get('zoneData');
        if (is_null($data)) {
            $data = Zone::where('slug', 'web-site')->first();
            Session::put('zoneData', $data);
        }
        $response = Http::get(route('maha.state'));
        $states   = $response->json();
        return response()->view('maha.register', [
            'zone'   => $data,
            'states' => $states
        ]);
    }

    public function registerPost(Request $request){
        $validated = $request->validate([
            'full_name'                 => 'required|string|max:255',
            'identification_card_number' => [
                'required',
                'string',
                'max:255',
                'unique:visitors,ic_number'
            ],
            'phone_number'              => 'required|string|max:255',
            'email'                     => 'required|email',
            'state'                     => 'required',
            'gender'                    => 'required',
            'know_platform'             => 'required|array',
            'know_platform.*'           => 'string',
            'resits.*'                  => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:25000',
            'receipt_amounts.*'         => 'nullable|numeric',
            'total'                     => 'required|numeric'
        ]);

        $cleanIcNumber    = preg_replace('/[^0-9]/', '', $request->input('identification_card_number'));
        $cleanPhoneNumber = preg_replace('/[^0-9]/', '', $request->input('phone_number'));

        $visitor = Visitor::create([
            'zone_id'       => $request->input('zone'),
            'name'          => strtoupper($request->input('full_name')),
            'ic_number'     => $cleanIcNumber,
            'phone'         => $cleanPhoneNumber,
            'email'         => $request->input('email'),
            'state'         => $request->input('state'),
            'gender'        => $request->input('gender'),
            'know_platform' => json_encode($request->input('know_platform')),
            'total'         => $request->input('total'),
        ]);

        // Generate QR code
        $qrcodeFilePath = public_path('assets/qrcode/' . $visitor->uniq . '.png');
        QrCode::size(500)->format('png')->generate($visitor->uniq, $qrcodeFilePath);
        $filePath = 'assets/qrcode/' . $visitor->uniq . '.png';

        // Update visitor with QR code path
        $visitor->update([
            'qr_code' => $filePath
        ]);

        if ($request->hasFile('resits')) {
            foreach ($request->file('resits') as $index => $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $randomString = Str::random(6);
                    $filename = now()->format('YmdHis') . '_' . $randomString . '.' . $extension;
                    $file->move(public_path('assets/upload/receipts'), $filename);
                    $filePath = 'assets/upload/receipts/' . $filename;

                    VisitorReceipt::create([
                        'visitor_id' => $visitor->id,
                        'receipt' => $filePath,
                        'amount' => $request->input('receipt_amounts.' . $index, 0)
                    ]);
                }
            }
        }

        Session::forget('zoneData');
        return response()->view('maha.qr', [
            'data' => $visitor
        ]);
    }

    public function state()
    {
        return response()->json([
            'Johor',
            'Kedah',
            'Kelantan',
            'Melaka',
            'Negeri Sembilan',
            'Pahang',
            'Perak',
            'Perlis',
            'Pulau Pinang',
            'Sarawak',
            'Selangor',
            'Terengganu',
            'Kuala Lumpur',
            'Labuan',
            'Sabah',
            'Putrajaya',
        ]);
    }
}
