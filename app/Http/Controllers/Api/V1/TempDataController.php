<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\TempData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TempDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $validatedData = $request->validate([
            'area_id' => 'required',
            'device_id' => 'required',
            #'flow_sensor' => 'required|string',
            #'volumen' => 'required|numeric',
            // Agrega aquí las reglas de validación para otros campos
        ]);
        $validatedData['temperature'] = $request->input('temperature');
        $validatedData['pressure'] = $request->input('pressure');
        $validatedData['humidity'] = $request->input('humidity');
        // Crear un nuevo registro en FlowData
        $tempData = TempData::create($validatedData);

        $device = Device::findOrFail($request->input('device_id'));
        $device->update(['last_connection' => Carbon::now()]);
        // Retornar una respuesta
        return response()->json([
            'message' => 'TempData created successfully'#,
            #'data' => $flowData
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
