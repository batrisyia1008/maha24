<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apps\Visitor;

class MahaOrganizerController extends Controller
{
    public function home()
    {
        $statesdata = [
            'Johor' => Visitor::where('state', 'Johor')->count(),
            'Kedah' => Visitor::where('state', 'Kedah')->count(),
            'Kelantan' => Visitor::where('state', 'Kelantan')->count(),
            'NegeriSembilan' => Visitor::where('state', 'NegeriSembilan')->count(),
            'Melaka' => Visitor::where('state', 'Melaka')->count(),
            'Pahang' => Visitor::where('state', 'Pahang')->count(),
            'Perak' => Visitor::where('state', 'Perak')->count(),
            'Perlis' => Visitor::where('state', 'Perlis')->count(),
            'Pulau Pinang' => Visitor::where('state', 'Pulau Pinang')->count(),
            'Sarawak' => Visitor::where('state', 'Sarawak')->count(),
            'Selangor' => Visitor::where('state', 'Selangor')->count(),
            'Terengganu' => Visitor::where('state', 'Terengganu')->count(),
            'Kuala Lumpur' => Visitor::where('state', 'Kuala Lumpur')->count(),
            'Labuan' => Visitor::where('state', 'Labuan')->count(),
            'Sabah' => Visitor::where('state', 'sabah')->count(),
            'Putrajaya' => Visitor::where('state', 'Putrajaya')->count(),
        ];
    
        return view('apps.dashboard.index', compact('statesdata'));
    }

    public function luckyDraw()
    {
        return view('apps.lucky-draw.index');
    }
}
