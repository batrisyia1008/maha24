<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Apps\Visitor;
use Illuminate\Http\Request;
use App\Models\Apps\Zone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
            'lelaki' => Visitor::where('gender', 'lelaki')->count(),
            'wanita' => Visitor::where('gender', 'wanita')->count(),
        ];

        $todayVisitorsCount = Visitor::whereDate('created_at', today())->count();
        $todaySpending = Visitor::whereDate('created_at', today())->sum('total');
        $overallVisitorsCount = Visitor::count();
        $overallSpending =  Visitor::sum('total');
        $zones = Zone::all();

        return view('apps.dashboard.index', [
            'statesdata'            => $statesdata,
            'genderData'            => $genderData,
            'todayVisitorsCount'    => $todayVisitorsCount,
            'todaySpending'         => $todaySpending,
            'startDate'             => $startDate,
            'zones'                 => $zones,
            'overallVisitorsCount'  => $overallVisitorsCount,
            'overallSpending'       => $overallSpending,
        ]);
    }

    public function luckyDraw()
    {
        return view('apps.lucky-draw.index');
    }

    public function luckyDrawName()
    {
        $rotf        = Zone::where('name', 'RHYTHM OF THE FARMERS (ROTF)')->first();
        $excludedIds = [1, 2, 3, 4, 5, 11, 15]; // Example IDs to exclude
        $visitors = Visitor::where('zone_id', $rotf->id)->whereNotIn('id', $excludedIds)->get();
        // $visitors = Visitor::whereNotIn('id', $excludedIds)->get();

        $transformedData = $visitors->map(function ($item) {
            $icNumber = str_pad($item->ic_number, 6, '0', STR_PAD_LEFT);
            $lastSixDigits = substr($icNumber, -6);
            $maxNameLength = 40;
            $name = strlen($item->name) > $maxNameLength ? substr($item->name, 0, $maxNameLength) . '...' : $item->name;
            $item->formatted_name = $name . ' (' . $lastSixDigits . ')';
            return $item;
        });
        $transformedArray = $transformedData->toArray();

        return response()->json($transformedArray);
    }

    public function luckyDrawWinner()
    {
        return [
            '1winner' => 'MEGAT MUHAMMAD SUFI BIN AZLAN (146576)', // PS5
            '2winner' => 'AIMAN SHAH BIN MAWARDI (140673)', // TV
            '3winner' => 'MUHAMMAD SUFI BIN AZLAN (146576)', // TV
        ];
    }

    public function luckyDrawOverwrite()
    {
        return view('apps.lucky-draw-overwrite.index');
    }
    public function dailySummaries(Request $request)
    {
        $zone_id = $request->zone_id;
        $date = $request->date;
        $query = Visitor::query();
        if (!is_null($zone_id)) {
            $query->where('zone_id', $zone_id);
        }

        if (!is_null($date)) {
            $query->whereDate('created_at', $date);
        }

        $visitorCount = $query->count();
        $totalSpending = $query->sum('total'); // Assuming 'total' is the spending column
        return response()->json([
            'visitorCount' => $visitorCount,
            'totalSpending' => $totalSpending
        ]);
    }

      public function getStateData(Request $request)
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

        return response()->json(['statesdata' => $statesdata]);
    }

    public function getGenderData(Request $request)
    {
        $maleCount   = Visitor::where('gender', 'lelaki')->count();
        $femaleCount = Visitor::where('gender', 'wanita')->count();

        // Return the data as a JSON response
        return response()->json([
            'genderData' => [
                'male' => $maleCount,
                'female' => $femaleCount
            ]
        ]);
    }

    public function totalVisitorTotal()
    {
        $dates = ['2024-09-10', '2024-09-22'];

        // Query to get data between specific dates
        $monthData = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as total_visitors, SUM(total) as total_spending')
            ->whereBetween('created_at', $dates)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at', 'asc')
            ->get();

        // Sum all visitors from the grouped result
        $totalVisitors = Visitor::count();  // Sum of 'total_visitors' from the query result
        $totalSpending = Visitor::sum('total');  // Sum of 'total_spending' from the query result

        // Return the JSON response
        return response()->json([
            'total_visitor'  => $totalVisitors,
            'total_spending' => $totalSpending,
            'months'         => $monthData  // This will contain the daily data for the selected range
        ]);
    }

    public function totalVisitorZone()
    {
        $zones = Zone::all();
        $zoneName = [];
        $visitor = [];
        $expenses = [];
        foreach ($zones as $zone) {
            $zoneName[] = $zone->name;
            $visitor[] = $zone->visitors->count();
            $expenses[] = $zone->visitors->sum('total');
        }
        return response()->json([
            'zones' => $zoneName,
            'visitor' => $visitor,
            'expenses' => $expenses
        ]);
    }
}
