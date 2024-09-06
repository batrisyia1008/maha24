<?php

namespace App\Http\Controllers\Maha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahaController extends Controller
{
    public function welcome(){
        return response()->view('maha.welcome');
    }

    public function register(){
        return response()->view('maha.register');
    }

    public function qrcode(){
        return response()->view('maha.qr');
    }
}
