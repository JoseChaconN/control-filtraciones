<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['user'] = User::all();
        return view('user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['user'] = New User;
        return view('user.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         try {
            DB::transaction(function () use ($request, &$user) {
                $validatedData = $request->validate([
                    'email' => 'required|string|max:255|unique:users,email',
                    'name' => 'required|string|max:255',                   
                ],
                [
                    'email.required' => 'El campo email es obligatorio.',
                    'email.unique' => 'El email debe ser único.',
                    'name.required' => 'El campo nombre es obligatorio.',
                ]);

                // Incluir 'description' en los datos a guardar
                $validatedData['password']=Hash::make('oneplaceone');
                // Crear una nueva usuario con los datos validados
                $User = User::create($validatedData);
            });
        }catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('user.create')->withErrors($e->validator)->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->route('user.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear el Usuario: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $data['user'] = User::findOrFail($user->id);
        return view('user.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        try {
            // Buscar el usuario existente
            $user = User::findOrFail($user->id);
            // Capturar los datos antiguos
            $old_data = $user->toArray();            
            // Definir las reglas de validación
            $validatedData = $request->validate([
                'email' => 'required|string|max:255|unique:users,email,' . $user->id,
                'name' => 'required|string|max:255',                   
            ],
            [
                'email.required' => 'El campo email es obligatorio.',
                'email.unique' => 'El email debe ser único.',
                'name.required' => 'El campo nombre es obligatorio.',
            ]);
            // Capturar los datos antiguos
            $old_data = $user->toArray();
            // Actualizar el usuario con los datos validados
            $user->update($validatedData);
            activity()
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['old_data' => $old_data, 'new_data' => $validatedData])
            ->event('update')
            ->log('Usuario actualizado');
            // Retornar una respuesta de éxito
            return redirect()->route('user.edit',$user->id)->with('notification_type', 'success')->with('notification_message', 'Usuario actualizado correctamente!');

        } catch (ValidationException $e) {
            // Capturar errores de validación
            return redirect()->route('user.edit', $user->id)
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return redirect()->route('user.edit', $user->id)
                ->with('notification_type', 'danger')->with('notification_message', 'Error al actualizar el Usuario: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Buscar el Usuario por ID
            $user = User::findOrFail($user->id);

            // Marcar el usuario como eliminada usando SoftDeletes
            $user->delete();

            activity()
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->event('delete')
            ->log('Usuario eliminado');
            // Retornar una respuesta de éxito
            return redirect()->route('user.index')->with('notification_type', 'success')->with('notification_message', 'Usuario eliminado correctamente!');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return redirect()->route('user.index')->with('notification_type', 'danger')->with('notification_message', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }
}
