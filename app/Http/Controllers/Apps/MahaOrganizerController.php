<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahaOrganizerController extends Controller
{
    public function home()
    {
        return view('apps.dashboard.index');
    }

    public function luckyDraw()
    {
        return view('apps.lucky-draw.index');
    }
}
