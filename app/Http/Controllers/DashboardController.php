<?php

namespace App\Http\Controllers;

use App\Models\FlowData;
use App\Models\TempData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function monitoring()
    {
        #$data['flowData'] = FlowData::with(['area', 'device'])->get();

        return view('dashboard.monitoring');
    }

    public function alerts()
    {
        $data['alertsData'] = FlowData::with(['area', 'device'])->get();

        return view('dashboard.alert', $data);
    }

    public function monitoring_temp()
    {
        #$data['flowData'] = FlowData::with(['area', 'device'])->get();

        return view('dashboard.monitoring-temp');
    }
    public function get_chart_monitoring_temp(Request $request)
    {
        #$data['flowData'] = FlowData::with(['area', 'device'])->get();

        #return view('dashboard.monitoring-temp');
        $query = TempData::query();
        
        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $query->whereBetween('created_at', [$request->input('dateFrom'), $request->input('dateTo')]);
        }

        $data = $query->orderBy('created_at', 'desc')->get(['created_at', 'temperature']);

        $response = [
            'labels' => $data->pluck('created_at')->map(function ($date) {
                return $date->format('Y-m-d H:i:s');
            }),
            'values' => $data->pluck('temperature')
        ];

        return response()->json($response);
    }
}
