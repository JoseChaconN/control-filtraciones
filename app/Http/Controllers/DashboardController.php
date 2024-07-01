<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\FlowData;
use Illuminate\Http\Request;
use App\Helpers\DeviceHelper;
use App\Models\Area;
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
        $data['areas'] = Area::all();
        $data['devices'] = Device::with(['area', 'latestFlowData'])->get();
        $data['devices_map'] = [];
        foreach ($data['devices'] as $device) {
            if(!empty($device->longitude) && !empty($device->latitude)){
                $latestFlowData = $device->latestFlowData;
                $data['devices_map'][] = [
                    'area_id' => $device->area_id,
                    'name' => $device->name,
                    'longitude' => $device->longitude,
                    'latitude' => $device->latitude,
                    'connection_status' => $latestFlowData ? \App\Helpers\AppHelper::getConnectionStatus($latestFlowData) : 'Sin Información',
                    'latest_flow_data' => $latestFlowData ? number_format($latestFlowData->flow_sensor,2).'LPM' : 'Sin Información',
                    'last_connection' => $latestFlowData ? \App\Helpers\AppHelper::getLastUpdate($latestFlowData) : 'Sin Información',
                ];
            }
        }
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
