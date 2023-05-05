<?php

namespace App\Http\Controllers;

use App\Models\Habitacione;
use App\Models\Huespede;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reservas::paginate(10);

        return view('reservas.index')->with( 'reservas' , $reservas );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $huespedes = Huespede::all();
        $habitaciones = Habitacione::all();
        return view('Reservas.create',['huespedes' => $huespedes,'habitaciones'=>$habitaciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validamos los campos del objeto utilizando las reglas de validación de Laravel
        $request->validate([
            'Huespedes_id' => 'required|string',
            'Habitacion_id' => 'required|string',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'Numero_de_huespedes' => 'required|integer',

        ], [
            // Mensajes personalizados para cada regla de validación
            'Huespedes_id.required' => 'El campo Huespedes_id es requerido.',
            'Huespedes_id.string' => 'El campo Huespedes_id debe ser un string.',
            'Habitacion_id.required' => 'El campo Habitacion_id es requerido.',
            'Habitacion_id.string' => 'El campo Habitacion_id debe ser un string.',
            'fecha_entrada.required' => 'El campo fecha_entrada es requerido.',
            'fecha_entrada.date' => 'El campo fecha_entrada debe ser una fecha válida.',
            'fecha_salida.required' => 'El campo fecha_salida es requerido.',
            'fecha_salida.date' => 'El campo fecha_salida debe ser una fecha válida.',
            'fecha_salida.after' => 'La fecha de salida debe ser posterior a la fecha de entrada.',
            'Numero_de_huespedes.required' => 'El campo Numero_de_huespedes es requerido.',
            'Numero_de_huespedes.integer' => 'El campo Numero_de_huespedes debe ser un numero Entero.',
        ]);


        $habitacion = DB::table('reservas')
               ->orderBy('id', 'desc')
               ->first();


        if(isset($habitacion->id)){
            $cod_habitacion =  $habitacion->id;
            $ultimos_cuatro_digitos = substr($cod_habitacion, -4);
            $nuevo_numero = (int)$ultimos_cuatro_digitos + 1;
            $nuevo_cod_habitacion = 'cod_Reser ' . str_pad($nuevo_numero, 4, '0', STR_PAD_LEFT);
        }else{
            $nuevo_cod_habitacion = 'cod_Reser 0001';
        }




        $habitacion = new Reservas();
        $habitacion->id = $nuevo_cod_habitacion;
        $habitacion->fecha_entrada = $request->input('fecha_entrada');
        $habitacion->fecha_salida = $request->input('fecha_salida');
        $habitacion->Huespedes_id = $request->input('Huespedes_id');
        $habitacion->Habitacion_id = $request->input('Habitacion_id');
        $habitacion->Numero_de_huespedes = $request->input('Numero_de_huespedes');
        $habitacion->save();


        return redirect()->route('reservas.index')->with('susses','Creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function show(Reservas $reservas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $huespedes = Huespede::all();
        $habitaciones = Habitacione::all();

        return view('Reservas.edit',['huespedes' => $huespedes,'habitaciones'=>$habitaciones])->with( 'reserva' , Reservas::findOrFail($id) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservasRequest  $request
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validamos los campos del objeto utilizando las reglas de validación de Laravel
        $request->validate([
            'Huespedes_id' => 'required|string',
            'Habitacion_id' => 'required|string',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'Numero_de_huespedes' => 'required|integer',

        ], [
            // Mensajes personalizados para cada regla de validación
            'Huespedes_id.required' => 'El campo Huespedes_id es requerido.',
            'Huespedes_id.string' => 'El campo Huespedes_id debe ser un string.',
            'Habitacion_id.required' => 'El campo Habitacion_id es requerido.',
            'Habitacion_id.string' => 'El campo Habitacion_id debe ser un string.',
            'fecha_entrada.required' => 'El campo fecha_entrada es requerido.',
            'fecha_entrada.date' => 'El campo fecha_entrada debe ser una fecha válida.',
            'fecha_salida.required' => 'El campo fecha_salida es requerido.',
            'fecha_salida.date' => 'El campo fecha_salida debe ser una fecha válida.',
            'fecha_salida.after' => 'La fecha de salida debe ser posterior a la fecha de entrada.',
            'Numero_de_huespedes.required' => 'El campo Numero_de_huespedes es requerido.',
            'Numero_de_huespedes.integer' => 'El campo Numero_de_huespedes debe ser un numero Entero.',
        ]);


        $habitacion = Reservas::findOrFail($id);
        $habitacion->fecha_entrada = $request->input('fecha_entrada');
        $habitacion->fecha_salida = $request->input('fecha_salida');
        $habitacion->Huespedes_id = $request->input('Huespedes_id');
        $habitacion->Habitacion_id = $request->input('Habitacion_id');
        $habitacion->Numero_de_huespedes = $request->input('Numero_de_huespedes');
        $habitacion->save();


        return redirect()->route('reservas.index')->with('susses','Creado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservas = Reservas::findOrFail($id);

        $reservas->delete();

        return redirect()->route('reservas.index')->with('susses','La reserva se ha eliminada con exito');
    }
}
