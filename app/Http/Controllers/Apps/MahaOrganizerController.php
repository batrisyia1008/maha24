<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Apps\Visitor;
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

    public function luckyDrawName()
    {
        $visitors = Visitor::all(); // Fetch all visitors or apply any filters needed

        $transformedData = $visitors->map(function ($item) {
            // Ensure the IC number has at least 6 digits
            $icNumber = str_pad($item->ic_number, 6, '0', STR_PAD_LEFT);
            $lastSixDigits = substr($icNumber, -6);

            // Limit the name to a maximum of 30 characters and add ellipsis if needed
            $maxNameLength = 30;
            $name = strlen($item->name) > $maxNameLength ? substr($item->name, 0, $maxNameLength) . '...' : $item->name;

            // Create the formatted name
            $item->formatted_name = $name . ' (' . $lastSixDigits . ')';
            return $item;
        });

        // If you need to convert to an array or pass to a view
        $transformedArray = $transformedData->toArray();

        return response()->json($transformedArray);
    }
}
