<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['collection']=Area::all();
        return view('area.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['area']= New Area;
        return view('area.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DB::transaction(function () use ($request, &$area) {
                // Definir las reglas de validación
                $validatedData = $request->validate([
                    'code' => 'required|string|max:255|unique:areas,code',
                    'name' => 'required|string|max:255',
                    'regular_flow' => 'required|numeric|min:0',
                    'peak_flow' => 'required|numeric|min:0',
                    'minimum_flow' => 'required|numeric|min:0',
                ],
                [
                    'code.required' => 'El campo código es obligatorio.',
                    'code.unique' => 'El código debe ser único.',
                    'name.required' => 'El campo nombre es obligatorio.',
                    'regular_flow.required' => 'El campo flujo regular es obligatorio.',
                    'regular_flow.numeric' => 'El campo flujo regular debe ser un número.',
                    'peak_flow.required' => 'El campo flujo máximo es obligatorio.',
                    'peak_flow.numeric' => 'El campo flujo máximo debe ser un número.',
                    'minimum_flow.required' => 'El campo flujo mínimo es obligatorio.',
                    'minimum_flow.numeric' => 'El campo flujo mínimo debe ser un número.',
                ]);

                // Incluir 'description' en los datos a guardar
                $validatedData['description'] = $request->input('description');

                // Crear una nueva área con los datos validados
                $area = Area::create($validatedData);
                // Registrar la actividad manualmente
                activity()
                ->performedOn($area)
                ->causedBy(auth()->user())
                ->event('insert')
                ->log('Sector creado!');
            });
            return redirect()->route('area.edit',$area->id)->with('notification_type', 'success')->with('notification_message', 'Sector creado correctamente!');
        }
        catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('area.create')->withErrors($e->validator)->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->route('area.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear el Sector: ' . $e->getMessage())->withInput();
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
        $data['area']= Area::findOrFail($area->id);
        return view('area.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        try {
            // Buscar el área existente
            $area = Area::findOrFail($area->id);
            // Capturar los datos antiguos
            $old_data = $area->toArray();            
            // Definir las reglas de validación
            $validatedData = $request->validate([
                'code' => 'required|string|max:255|unique:areas,code,' . $area->id,
                'name' => 'required|string|max:255',
                'regular_flow' => 'required|numeric|min:0',
                'peak_flow' => 'required|numeric|min:0',
                'minimum_flow' => 'required|numeric|min:0',
            ]);
             // Capturar los datos antiguos
            $old_data = $area->toArray();
            // Incluir 'description' en los datos a guardar
            $validatedData['description'] = $request->input('description');

            // Actualizar el área con los datos validados
            $area->update($validatedData);
            activity()
            ->performedOn($area)
            ->causedBy(auth()->user())
            ->withProperties(['old_data' => $old_data, 'new_data' => $validatedData])
            ->event('update')
            ->log('Sector creado');
            // Retornar una respuesta de éxito
            return redirect()->route('area.edit',$area->id)->with('notification_type', 'success')->with('notification_message', 'Sector actualizado correctamente!');

        } catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('area.edit', $area->id)
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return redirect()->route('area.edit', $area->id)
                ->with('notification_type', 'danger')->with('notification_message', 'Error al crear el Sector: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        try {
            // Buscar el área por ID
            $area = Area::findOrFail($area->id);

            // Marcar el área como eliminada usando SoftDeletes
            $area->delete();

            activity()
            ->performedOn($area)
            ->causedBy(auth()->user())
            ->event('delete')
            ->log('Sector eliminado');
            // Retornar una respuesta de éxito
            return redirect()->route('area.index')->with('notification_type', 'success')->with('notification_message', 'Sector eliminado correctamente!');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return redirect()->route('area.index')->with('notification_type', 'danger')->with('notification_message', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }
}
