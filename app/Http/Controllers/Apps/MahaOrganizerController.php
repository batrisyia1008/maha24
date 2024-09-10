<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Apps\Visitor;
use Illuminate\Http\Request;
use App\Models\Apps\Zone;
use Illuminate\Support\Facades\DB;



class MahaOrganizerController extends Controller
{
    public function home(Request $request)
    {
        $startDate = $request->input('start_date');

        $statesdata = [
            'Johor' => Visitor::where('state', 'Johor')->count(),
            'Kedah' => Visitor::where('state', 'Kedah')->count(),
            'Kelantan' => Visitor::where('state', 'Kelantan')->count(),
            'Negeri Sembilan' => Visitor::where('state', 'Negeri Sembilan')->count(),
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
            'Sabah' => Visitor::where('state', 'Sabah')->count(),
            'Putrajaya' => Visitor::where('state', 'Putrajaya')->count(),
        ];

        if ($startDate) {
            $statesdata = [
                'Johor' => Visitor::where('state', 'Johor')->whereDate('created_at', '>=', $startDate)->count(),
                'Kedah' => Visitor::where('state', 'Kedah')->whereDate('created_at', '>=', $startDate)->count(),
                'Kelantan' => Visitor::where('state', 'Kelantan')->whereDate('created_at', '>=', $startDate)->count(),
                'Negeri Sembilan' => Visitor::where('state', 'Negeri Sembilan')->whereDate('created_at', '>=', $startDate)->count(),
                'Melaka' => Visitor::where('state', 'Melaka')->whereDate('created_at', '>=', $startDate)->count(),
                'Pahang' => Visitor::where('state', 'Pahang')->whereDate('created_at', '>=', $startDate)->count(),
                'Perak' => Visitor::where('state', 'Perak')->whereDate('created_at', '>=', $startDate)->count(),
                'Perlis' => Visitor::where('state', 'Perlis')->whereDate('created_at', '>=', $startDate)->count(),
                'Pulau Pinang' => Visitor::where('state', 'Pulau Pinang')->whereDate('created_at', '>=', $startDate)->count(),
                'Sarawak' => Visitor::where('state', 'Sarawak')->whereDate('created_at', '>=', $startDate)->count(),
                'Selangor' => Visitor::where('state', 'Selangor')->whereDate('created_at', '>=', $startDate)->count(),
                'Terengganu' => Visitor::where('state', 'Terengganu')->whereDate('created_at', '>=', $startDate)->count(),
                'Kuala Lumpur' => Visitor::where('state', 'Kuala Lumpur')->whereDate('created_at', '>=', $startDate)->count(),
                'Labuan' => Visitor::where('state', 'Labuan')->whereDate('created_at', '>=', $startDate)->count(),
                'Sabah' => Visitor::where('state', 'Sabah')->whereDate('created_at', '>=', $startDate)->count(),
                'Putrajaya' => Visitor::where('state', 'Putrajaya')->whereDate('created_at', '>=', $startDate)->count(),
                    
            ];
        }

        $genderData = [
            'male' => Visitor::where('gender', 'male')->count(),
            'female' => Visitor::where('gender', 'female')->count(),
        ];

        $todayVisitorsCount = Visitor::whereDate('created_at', today())->count();

        $todaySpending = Visitor::whereDate('created_at', today())->sum('total');

        // $zones = Zone::all(); // Fetch all zones

        // $startDate = $request->input('start_date');
        // $selectedZoneId = $request->input('zone_id');
    
        // // Query for visitors and spending based on the selected zone and date
        // $query = Visitor::query();
    
        // if ($startDate) {
        //     $query->whereDate('created_at', '=', $startDate);
        // }
    
        // if ($selectedZoneId) {
        //     $query->where('zone_id', $selectedZoneId);
        // }
    
        // $visitorCount = $query->count();
        // $totalSpending = $query->sum('total');
       
        $overallVisitorsCount = Visitor::count();

        $overallSpending =  Visitor::sum('total');

        return view('apps.dashboard.index', [
            'statesdata'            => $statesdata,
            'genderData'            => $genderData,
            'todayVisitorsCount'    => $todayVisitorsCount,
            'todaySpending'         => $todaySpending,
            'startDate'             => $startDate,
            // 'zone'                  => $zones,
            'overallVisitorsCount'   => $overallVisitorsCount,
            'overallSpending'       => $overallSpending,


        ]);
    }

    // public function getZoneData(Request $request)
    // {

    //     $zones = Zone::all(); // Fetch all zones

    //     $startDate = $request->input('start_date');
    //     $selectedZoneId = $request->input('zone_id');
    
    //     // Query for visitors and spending based on the selected zone and date
    //     $query = Visitor::query();
    
    //     if ($startDate) {
    //         $query->whereDate('created_at', '=', $startDate);
    //     }
    
    //     if ($selectedZoneId) {
    //         $query->where('zone_id', $selectedZoneId);
    //     }
    
    //     $visitorCount = $query->count();
    //     $totalSpending = $query->sum('total');
    
    //     return view('apps.dashboard.index', [
    //         'zones' => $zones,
    //         'visitorCount' => $visitorCount,
    //         'totalSpending' => $totalSpending,
    //         'selectedZoneId' => $selectedZoneId,
    //         'startDate' => $startDate,
    //     ]);

    // }

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

    public function getZones()
    {
        // Fetch all available zones
        $zones = Zone::all(); // Assuming you have a Zone model

        // Return the list of zones as JSON
        return response()->json($zones);
    }

    public function dailySum(Request $request)
    {
        // Fetch the selected zone and start date
        $zoneId = $request->input('zone_id');
        $startDate = $request->input('start_date');

        // Query visitors for the selected zone
        $visitorsQuery = Visitor::where('zone_id', $zoneId);

        // If a start date is provided, fetch visitors from that date onwards
        if ($startDate) {
            $visitorsQuery->where('created_at', '>=', $startDate);
        }

        // Get the total number of visitors
        $totalVisitors = $visitorsQuery->count();

        // Get the total spending for visitors from the selected zone and start date
        $totalSpending = $visitorsQuery->sum('spending'); // Assuming 'spending' is a field in the Visitor model

        // Return the total visitors and spending as a JSON response
        return response()->json([
            'total_visitors' => $totalVisitors,
            'total_spending' => $totalSpending,
        ]);
    }
}
