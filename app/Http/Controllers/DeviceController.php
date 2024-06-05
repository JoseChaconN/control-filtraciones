<?php

namespace App\Http\Controllers;


use App\Models\Device;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;


class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['collection']=Device::all();
        return view('device.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['device'] = New Device;
        $data['area'] = Area::all();
        return view('device.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DB::transaction(function () use ($request, &$device) {
                // Definir las reglas de validación
                $validatedData = $request->validate([
                    'code' => 'required|string|max:255|unique:devices,code',
                    'name' => 'required|string|max:255',
                    'area_id' => 'required',
                    'regular_flow' => 'required|numeric|min:0',
                    'peak_flow' => 'required|numeric|min:0',
                    'minimum_flow' => 'required|numeric|min:0',
                ],
                [
                    'code.required' => 'El campo código es obligatorio.',
                    'code.unique' => 'El código debe ser único.',
                    'name.required' => 'El campo nombre es obligatorio.',
                    'area_id.required' => 'El campo sector es obligatorio.',
                    'regular_flow.required' => 'El campo flujo regular es obligatorio.',
                    'regular_flow.numeric' => 'El campo flujo regular debe ser un número.',
                    'peak_flow.required' => 'El campo flujo máximo es obligatorio.',
                    'peak_flow.numeric' => 'El campo flujo máximo debe ser un número.',
                    'minimum_flow.required' => 'El campo flujo mínimo es obligatorio.',
                    'minimum_flow.numeric' => 'El campo flujo mínimo debe ser un número.',
                ]);

                // Incluir 'description' en los datos a guardar
                $validatedData['description'] = $request->input('description');
                $validatedData['token']=Str::random(60);
                // Crear una nueva dispositivo con los datos validados
                $device = Device::create($validatedData);
                // Registrar la actividad manualmente
                activity()
                ->performedOn($device)
                ->causedBy(auth()->user())
                ->event('insert')
                ->log('Dispositivo creado!');
            });
            return redirect()->route('device.edit',$device->id)->with('notification_type', 'success')->with('notification_message', 'Dispositivo creado correctamente!');
        }
        catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('device.create')->withErrors($e->validator)->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->route('device.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear el Dispositivo: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        //
        $data['device'] = Device::findOrFail($device->id);
        $data['area'] = Area::all();
        return view('device.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        try {
            // Buscar el dispositivo existente
            $device = Device::findOrFail($device->id);
            // Capturar los datos antiguos
            $old_data = $device->toArray();            
            // Definir las reglas de validación
            $validatedData = $request->validate([
                'code' => 'required|string|max:255|unique:devices,code,' . $device->id,
                'name' => 'required|string|max:255',
                'area_id' => 'required',
                'regular_flow' => 'required|numeric|min:0',
                'peak_flow' => 'required|numeric|min:0',
                'minimum_flow' => 'required|numeric|min:0',
            ],
            [
                'code.required' => 'El campo código es obligatorio.',
                'code.unique' => 'El código debe ser único.',
                'name.required' => 'El campo nombre es obligatorio.',
                'area_id.required' => 'El campo sector es obligatorio.',
                'regular_flow.required' => 'El campo flujo regular es obligatorio.',
                'regular_flow.numeric' => 'El campo flujo regular debe ser un número.',
                'peak_flow.required' => 'El campo flujo máximo es obligatorio.',
                'peak_flow.numeric' => 'El campo flujo máximo debe ser un número.',
                'minimum_flow.required' => 'El campo flujo mínimo es obligatorio.',
                'minimum_flow.numeric' => 'El campo flujo mínimo debe ser un número.',
            ]);
            // Capturar los datos antiguos
            $old_data = $device->toArray();
            // Incluir 'description' en los datos a guardar
            $validatedData['description'] = $request->input('description');

            // Actualizar el dispositivo con los datos validados
            $device->update($validatedData);
            activity()
            ->performedOn($device)
            ->causedBy(auth()->user())
            ->withProperties(['old_data' => $old_data, 'new_data' => $validatedData])
            ->event('update')
            ->log('Sector actualizado');
            // Retornar una respuesta de éxito
            return redirect()->route('device.edit',$device->id)->with('notification_type', 'success')->with('notification_message', 'Dispositivo actualizado correctamente!');

        } catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('device.edit', $device->id)
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return redirect()->route('device.edit', $device->id)
                ->with('notification_type', 'danger')->with('notification_message', 'Error al actualizar el Dispositivo: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        try {
            // Buscar el dispositivo por ID
            $device = Device::findOrFail($device->id);

            // Marcar el dispositivo como eliminada usando SoftDeletes
            $device->delete();

            activity()
            ->performedOn($device)
            ->causedBy(auth()->user())
            ->event('delete')
            ->log('Dispositivo eliminado');
            // Retornar una respuesta de éxito
            return redirect()->route('device.index')->with('notification_type', 'success')->with('notification_message', 'Dispositivo eliminado correctamente!');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return redirect()->route('device.index')->with('notification_type', 'danger')->with('notification_message', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }
}
