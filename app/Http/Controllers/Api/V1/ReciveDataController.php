<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ReciveData;
use Illuminate\Http\Request;

class ReciveDataController extends Controller
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
        //

        $validatedData=[
            'type' => $request->input('type'),
            'data' => json_encode($request->input('data')),
        ];
        ReciveData::create($validatedData);

        // Retornar una respuesta
        return response()->json([
            'message' => 'created successfully'#,
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
