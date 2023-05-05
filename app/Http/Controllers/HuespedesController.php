<?php

namespace App\Http\Controllers;



use App\Models\Huespede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HuespedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Huespedes = Huespede::paginate(10);

        return view('Huespedes.index')->with( 'huespedes' , $Huespedes );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Huespedes.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHuespedesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El campo apellido debe ser una cadena de caracteres.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.digits' => 'El campo teléfono debe tener 8 dígitos.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
            'telefono.unique' => 'El teléfono ya está registrado.'
        ];

        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo_electronico' => 'required|email|unique:huespedes,correo_electronico',
            'telefono' => 'required|digits:8|unique:huespedes,telefono'
        ], $messages);

        $habitacion = DB::table('huespedes')
               ->orderBy('id', 'desc')
               ->first();


        $cod_habitacion =  $habitacion->id;
        $ultimos_cuatro_digitos = substr($cod_habitacion, -4);
        $nuevo_numero = (int)$ultimos_cuatro_digitos + 1;
        $nuevo_cod_habitacion = 'cod_Huesp ' . str_pad($nuevo_numero, 4, '0', STR_PAD_LEFT);



        $habitacion = new Huespede();
        $habitacion->id = $nuevo_cod_habitacion;
        $habitacion->nombre = $request->input('nombre');
        $habitacion->apellido = $request->input('apellido');
        $habitacion->correo_electronico = $request->input('correo_electronico');
        $habitacion->telefono = $request->input('telefono');
        $habitacion->save();


        return redirect()->route('huespedes.index')->with('susses','Creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function show(Huespede $huespedes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Huespedes.edit')->with( 'Huesped' , Huespede::findOrFail($id) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHuespedesRequest  $request
     * @param  \App\Models\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El campo apellido debe ser una cadena de caracteres.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.digits' => 'El campo teléfono debe tener 8 dígitos.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
            'telefono.unique' => 'El teléfono ya está registrado.'
        ];

        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo_electronico' => 'required|email|unique:huespedes,correo_electronico,'.$id,
            'telefono' => 'required|digits:8|unique:huespedes,telefono,'.$id
        ], $messages);



        $habitacion = Huespede::findOrFail($id);
        $habitacion->nombre = $request->input('nombre');
        $habitacion->apellido = $request->input('apellido');
        $habitacion->correo_electronico = $request->input('correo_electronico');
        $habitacion->telefono = $request->input('telefono');
        $habitacion->save();

        return redirect()->route('huespedes.index')->with('susses','Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $huespedes = Huespede::findOrFail($id);
        if ($huespedes->reservas()->exists()) {
            return redirect()->route('huespedes.index')->with('error','No se puede eliminar a este huesped porque tiene reservaciones activas.');
        }


        $huespedes->delete();
        return redirect()->route('huespedes.index')->with('susses','El Huesped se eliminada con exito');
    }
}
