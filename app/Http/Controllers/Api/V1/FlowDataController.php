<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\FlowData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlowDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = FlowData::all();
        return response()->json(['data' => 1], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validar la solicitud
        $validatedData = $request->validate([
            'area_id' => 'required',
            'device_id' => 'required',
            #'flow_sensor' => 'required|string',
            #'volumen' => 'required|numeric',
            // Agrega aquí las reglas de validación para otros campos
        ]);
        $validatedData['volumen'] = $request->input('volumen');
        $validatedData['flow_sensor'] = $request->input('flow_sensor');
        // Crear un nuevo registro en FlowData
        $flowData = FlowData::create($validatedData);

        $device = Device::findOrFail($request->input('device_id'));
        $device->update(['last_connection' => Carbon::now()]);
        // Retornar una respuesta
        return response()->json([
            'message' => 'FlowData created successfully'#,
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
