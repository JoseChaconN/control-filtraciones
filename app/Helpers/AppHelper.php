<?php

namespace App\Helpers;

use Carbon\Carbon;

class AppHelper
{
    public static function getConnectionStatus($latestFlowData)
    {
        if (empty($latestFlowData)) {
            return '<span class="badge bg-danger">Desconectado</span>';
        }
        /*if ($latestFlowData->isEmpty()) {
            return '<span class="badge bg-danger">Desconectado</span>';
        }*/

        $lastFlowData = $latestFlowData;#->first();
        $latestFlowDataTime = Carbon::parse($lastFlowData->created_at);

        return $latestFlowDataTime->diffInMinutes() <= 5 ? '<span class="badge bg-success">Conectado</span>' : '<span class="badge bg-danger">Desconectado</span>';
    }
    public static function getLastUpdate($latestFlowData)
    {
        if (empty($latestFlowData)) {
            return 'No existe información';
        }
        /*if ($latestFlowData->isEmpty()) {
            return 'No existe información';
        }*/

        $lastFlowData = $latestFlowData;#->first();
        $currentTime = Carbon::now();
        $time = Carbon::parse($lastFlowData->created_at);
        $diffInMinutes = $time->diffInMinutes($currentTime);
        $diffInHours = $time->diffInHours($currentTime);
        $diffInDays = $time->diffInDays($currentTime);

        if ($diffInMinutes < 60) {
            return floor($diffInMinutes) . ' minutos';
        } elseif ($diffInHours < 24) {
            return floor($diffInHours) . ' horas';
        } else {
            return $time->format('d-m-Y H:i:s');
        }
    }
}