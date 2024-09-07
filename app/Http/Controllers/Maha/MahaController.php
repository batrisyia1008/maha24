<?php

namespace App\Http\Controllers\Maha;

use App\Http\Controllers\Controller;
use App\Models\Apps\Zone;
use App\Models\Apps\Visitor;
use App\Models\Apps\VisitorReceipt;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MahaController extends Controller
{
    public function welcome(){
        return response()->view('maha.welcome');
    }

    public function register(Request $request){
        $slug = $request->query('zone');
        $zone = Zone::where('slug', $slug)->firstOrFail();
        return response()->view('maha.register', [
            'zone' => $zone
        ]);
    }

    public function registerPost(Request $request){
        $validated = $request->validate([
            'full_name'                 => 'required|string|max:255',
            'identification_card_number' => 'required|string|max:255',
            'phone_number'              => 'required|string|max:255',
            'email'                     => 'nullable|email',
            'know_platform'             => 'required|array',
            'know_platform.*'           => 'string',
            'resits.*'                  => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'receipt_amounts.*'         => 'nullable|numeric',
            'total'                     => 'required|numeric'
        ]);

        $cleanIcNumber    = preg_replace('/[^0-9]/', '', $request->input('identification_card_number'));
        $cleanPhoneNumber = preg_replace('/[^0-9]/', '', $request->input('phone_number'));

        $visitor = Visitor::create([
            'zone_id'       => $request->input('zone'),
            'name'          => $request->input('full_name'),
            'ic_number'     => $cleanIcNumber,
            'phone'         => $cleanPhoneNumber,
            'email'         => $request->input('email'),
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
                    $path = $file->store('receipts');
                    VisitorReceipt::create([
                        'visitor_id' => $visitor->id,
                        'receipt' => $path,
                        'amount' => $request->input('receipt_amounts.' . $index, 0)
                    ]);
                }
            }
        }

        return response()->view('maha.qr', [
            'data' => $visitor
        ]);
    }
}
