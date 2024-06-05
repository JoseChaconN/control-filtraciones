<?php

namespace App\Http\Controllers;

use App\Models\FlowData;
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
}
