<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\FlowData;
use Illuminate\Http\Request;
use App\Helpers\DeviceHelper;
use Carbon\Carbon;

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
    public function devices()
    {
        $data['devices'] = Device::with(['area', 'latestFlowData'])->get();
        return view('dashboard.devices', $data);
    }
    public function device_detail(Request $request,Device $device)
    {
        $data['flowData'] = [];
        if ($request->has(['start_date', 'end_date'])) {
            $query = $device->flowData()->latest();
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
            $data['flowData'] = $query->get();
        }
        
        $data['device'] = $device;
        return view('dashboard.device-detail', $data);
    }
}
