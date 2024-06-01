<?php

namespace App\Http\Controllers;

use App\Config\AlertConfig;
use App\Models\Alert;
use App\Models\Device;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon\Carbon; // Asegúrate de importar Carbon para manejar las fechas


class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['collection']=Alert::all();
        $data['channels'] = collect(AlertConfig::CHANNELS);
        $data['types'] = collect(AlertConfig::TYPES);
        $data['levels'] = collect(AlertConfig::LEVELS);
        return view('alert.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['alert'] = New Alert;
        $data['area'] = Area::all();
        $data['device'] = Device::all();
        $data['channels'] = AlertConfig::CHANNELS;
        $data['types'] = AlertConfig::TYPES;
        $data['levels'] = AlertConfig::LEVELS;
        return view('alert.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DB::transaction(function () use ($request, &$alert) {
                // Definir las reglas de validación
                $validatedData = $request->validate([
                    'code' => 'required|string|max:255|unique:alerts,code',
                    'message' => 'required|string|max:255',
                    'level' => 'required',
                    'type' => 'required',
                    'channel' => 'required',
                ],
                [
                    'code.required' => 'El campo código es obligatorio.',
                    'code.unique' => 'El código debe ser único.',
                    'message.required' => 'El campo nombre es obligatorio.',
                    'level.required' => 'El campo Nivel de Alerta es obligatorio.',
                    'type.required' => 'El campo Tipo de Alerta es obligatorio.',
                    'channel.required' => 'El campo Canales de notificación es obligatorio.',
                ]);
                // Incluir 'description' en los datos a guardar
                $validatedData['channel'] = json_encode($request->input('channel'));
                $validatedData['description'] = $request->input('description');

                // Crear una nueva dispositivo con los datos validados
                $alert = Alert::create($validatedData);
                $currentTime = Carbon::now();

                if ($request->has('areas')) {
                    foreach ($request->areas as $areaId) {
                        $area = Area::find($areaId);
                        $area->alerts()->attach($alert->id,['created_at' => $currentTime]);
                    }
                }

                if ($request->has('devices')) {
                    foreach ($request->devices as $deviceId) {
                        $device = Device::find($deviceId);
                        $device->alerts()->attach($alert->id,['created_at' => $currentTime]);
                    }
                }
                
                // Registrar la actividad manualmente
                activity()
                ->performedOn($alert)
                ->causedBy(auth()->user())
                ->event('insert')
                ->log('Dispositivo creado!');
            });
            return redirect()->route('alert.edit',$alert->id)->with('notification_type', 'success')->with('notification_message', 'Alerta creada correctamente!');
        }
        catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('alert.create')->withErrors($e->validator)->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->route('alert.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear la Alerta: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Alert $alert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alert $alert)
    {
        //
        $data['alert'] = Alert::findOrFail($alert->id);
        $data['area'] = Area::all();
        $data['device'] = Device::all();
        $data['channels'] = AlertConfig::CHANNELS;
        $data['types'] = AlertConfig::TYPES;
        $data['levels'] = AlertConfig::LEVELS;
        return view('alert.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alert $alert)
    {
        //
        try {
            DB::transaction(function () use ($request, &$alert) {
                #$alert = Alert::findOrFail($alert->id);

                $validatedData = $request->validate([
                    'code' => 'required|string|max:255|unique:alerts,code,' . $alert->id,
                    'message' => 'required|string|max:255',
                    'level' => 'required',
                    'type' => 'required',
                    'channel' => 'required',
                ],
                [
                    'code.required' => 'El campo código es obligatorio.',
                    'code.unique' => 'El código debe ser único.',
                    'message.required' => 'El campo nombre es obligatorio.',
                    'level.required' => 'El campo Nivel de Alerta es obligatorio.',
                    'type.required' => 'El campo Tipo de Alerta es obligatorio.',
                    'channel.required' => 'El campo Canales de notificación es obligatorio.',
                ]);
                // Incluir 'description' en los datos a guardar
                $validatedData['channel'] = json_encode($request->input('channel'));
                $validatedData['description'] = $request->input('description');

                // Capturar los datos antiguos
                $old_data = $alert->toArray();

                // Actualizar el dispositivo con los datos validados
                $alert->update($validatedData);
                $timestamp = ['created_at' => now()];

                $alert->areas()->sync(
                    collect($request->input('areas', []))->mapWithKeys(fn($id) => [$id => $timestamp])->toArray()
                );

                $alert->devices()->sync(
                    collect($request->input('devices', []))->mapWithKeys(fn($id) => [$id => $timestamp])->toArray()
                );

                activity()
                ->performedOn($alert)
                ->causedBy(auth()->user())
                ->withProperties(['old_data' => $old_data, 'new_data' => $validatedData])
                ->event('update')
                ->log('Alert actualizado');
            });
            // Retornar una respuesta de éxito
            return redirect()->route('alert.edit',$alert->id)->with('notification_type', 'success')->with('notification_message', 'Alerta actualizada correctamente!');
        }
        catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('alert.edit',$alert->id)->withErrors($e->validator)->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->route('alert.edit',$alert->id)->with('notification_type', 'danger')->with('notification_message', 'Error al actualizar la Alerta: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alert $alert)
    {
        //
        try {
            $alert = Alert::findOrFail($alert->id);
            
            // Eliminar las relaciones en la tabla pivote
            $alert->areas()->detach();
            $alert->devices()->detach();
            
            // Eliminar la alerta
            $alert->delete();
            activity()
            ->performedOn($alert)
            ->causedBy(auth()->user())
            ->event('delete')
            ->log('Alerta eliminado');
            return redirect()->route('alerts.index')->with('success', 'Alerta eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('alerts.index')->with('error', 'Error al eliminar la alerta: ' . $e->getMessage());
        }
    }
}
