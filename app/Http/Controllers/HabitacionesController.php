<?php

namespace App\Http\Controllers;

use App\Models\Habitacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitaciones = Habitacione::paginate(10);

        return view('Habitaciones.index')->with( 'habitaciones' , $habitaciones );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Habitaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHabitacioneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'numero.integer' => 'El campo número debe ser un número entero.',
            'numero.required' => 'El campo número es requerido.',
            'numero.gt' => 'El campo número debe ser mayor que cero.',
            'Tipo.string' => 'El campo Tipo debe ser una cadena de texto.',
            'Tipo.required' => 'El campo Tipo es requerido.',
            'precio.string' => 'El campo precio debe ser una cadena de texto.',
            'precio.required' => 'El campo precio es requerido.',
        ];

        $request->validate([
            'numero' => 'integer|required|gt:0',
            'Tipo' => 'string|required',
            'precio' => 'string|required',
        ], $messages);

        $habitacion = DB::table('habitaciones')
               ->orderBy('id', 'desc')
               ->first();



        $cod_habitacion =  $habitacion->id;
        $ultimos_cuatro_digitos = substr($cod_habitacion, -4);
        $nuevo_numero = (int)$ultimos_cuatro_digitos + 1;
        $nuevo_cod_habitacion = 'cod_Habit ' . str_pad($nuevo_numero, 4, '0', STR_PAD_LEFT);



        $habitacion = new Habitacione();
        $habitacion->id = $nuevo_cod_habitacion;
        $habitacion->numero = $request->input('numero');
        $habitacion->Tipo = $request->input('Tipo');
        $habitacion->precio = $request->input('precio');
        $habitacion->save();


        return redirect()->route('habitaciones.index')->with('susses','Creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function show(Habitacione $habitacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('Habitaciones.edit')->with( 'habitacion' , Habitacione::findOrFail($id) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHabitacioneRequest  $request
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'numero.integer' => 'El campo número debe ser un número entero.',
            'numero.required' => 'El campo número es requerido.',
            'numero.gt' => 'El campo número debe ser mayor que cero.',
            'Tipo.string' => 'El campo Tipo debe ser una cadena de texto.',
            'Tipo.required' => 'El campo Tipo es requerido.',
            'precio.string' => 'El campo precio debe ser una cadena de texto.',
            'precio.required' => 'El campo precio es requerido.',
        ];

        $request->validate([
            'numero' => 'integer|required|gt:0',
            'Tipo' => 'string|required',
            'precio' => 'string|required',
        ], $messages);


        $habitacion = Habitacione::findOrFail($id);
        $habitacion->numero = $request->input('numero');
        $habitacion->Tipo = $request->input('Tipo');
        $habitacion->precio = $request->input('precio');
        $habitacion->save();


        return redirect()->route('habitaciones.index')->with('susses','Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitacione  $habitacione
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $habitacione = Habitacione::findOrFail($id);
        if ($habitacione->reservas()->exists()) {
            return redirect()->route('habitaciones.index')->with('error','No se puede eliminar esta habitación porque tiene reservaciones activas.');
        }

        $habitacione->delete();
        return redirect()->route('habitaciones.index')->with('susses','Habitacion eliminada con exito');
    }
}
