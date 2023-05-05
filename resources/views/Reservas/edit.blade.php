@extends('welcome')
@section('contenido')
<div class="container" style="width: 40%">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <br>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            <div style="width: 100%">
                <center>
                    <h2>Editar Reservaciones</h2>

                    @if(session('susses'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" role="img" width='16' height='16' aria-label="Success:">
                            <use xlink:href="#check-circle-fill" /></svg>
                        <div>
                            {{ session('susses') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session()->has('errors'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach (session()->get('errors')->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                </center>
            </div>

        </div>
        <div class="card-body">
            <form action="{{ route('reservas.update', ['id'=>$reserva->id]) }}" method="POST" id="delete-form">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Huesped</span>
                    <select disabled  class="form-select" name="Huespedes_id" id="Huespedes_id" aria-label="Default select example">
                        <option value="">Seleccione</option>
                        @foreach ($huespedes as $huesped)
                        <option @if(old('Huespedes_id')==$reserva->Huespedes_id ) selected @else @if($huesped->id == $reserva->Huespedes_id)
                            selected
                            @else

                            @endif
                            @endif value="{{ $huesped->id }}">{{ $huesped->nombre.' '.$huesped->apellido }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Habitacion</span>
                    <select disabled  class="form-select" name="Habitacion_id" id="Habitacion_id" aria-label="Default select example">
                        <option value="">Seleccione</option>
                        @foreach ($habitaciones as $habitacion)
                        <option @if(old('Huespedes_id')==$reserva->Habitacion_id ) selected @else @if($habitacion->id == $reserva->Habitacion_id)
                            selected
                            @else

                            @endif
                            @endif value="{{ $habitacion->id }}">{{ 'Numero: '.$habitacion->numero.' Tipo de Habitacion: '.$habitacion->Tipo. ' Precio: '.$habitacion->precio }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Fecha Entrada</span>
                    <input  readonly disabled type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" value="{{ old('fecha_entrada') ? old('fecha_entrada'): $reserva->fecha_entrada  }}" aria-describedby="basic-addon1">

                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Fecha Salida</span>
                    <input readonly disabled type="date" class="form-control" name="fecha_salida" id="fecha_salida" value="{{ old('fecha_salida') ? old('fecha_salida'): $reserva->fecha_salida  }}" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Numero de Huespedes</span>
                    <input readonly disabled type="number" class="form-control" name="Numero_de_huespedes" id="Numero_de_huespedes" value="{{ old('Numero_de_huespedes') ? old('Numero_de_huespedes'): $reserva->Numero_de_huespedes  }}" aria-describedby="basic-addon1">
                </div>


                <div class="row">
                    <div class="col-3">
                        <a href="#" id="btn_volver" onclick="window.history.back();" class="btn btn-secondary">Volver</a>
                        <button type="button" style="display: none" onclick="editar_cancelar()" id="btn_cancelar" class="btn btn-danger">Cancelar</button>
                    </div>
                    <div class="col-3">
                        <button type="button" id="btn_editar" onclick="editar()" class="btn btn-primary">Editar</button>
                        <button type="submit" style="display: none" id="btn_actualizar" onclick="return actualozizarConfirmacion()" class="btn btn-info">Actualizar</button>
                    </div>
                    <div class="col-6">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function actualozizarConfirmacion() {
        if (confirm('¿Estás seguro que deseas actualizar esta registro?')) {
            document.getElementById('delete-form').submit();
        } else {
            return false;
        }
    }

    function editar() {
        document.getElementById('Numero_de_huespedes').readOnly = false;
        document.getElementById('fecha_entrada').readOnly = false;
        document.getElementById('fecha_salida').readOnly = false;


        document.getElementById('Numero_de_huespedes').disabled = false;
        document.getElementById('fecha_entrada').disabled = false;
        document.getElementById('fecha_salida').disabled = false;
        document.getElementById('Huespedes_id').disabled = false;
        document.getElementById('Habitacion_id').disabled = false;

        document.getElementById('btn_cancelar').style.display = 'block';
        document.getElementById('btn_actualizar').style.display = 'block';

        document.getElementById('btn_volver').style.display = 'none';
        document.getElementById('btn_editar').style.display = 'none';
    }

    function editar_cancelar() {
        document.getElementById('Numero_de_huespedes').readOnly = true;
        document.getElementById('fecha_entrada').readOnly = true;
        document.getElementById('fecha_salida').readOnly = true;


        document.getElementById('Numero_de_huespedes').disabled = true;
        document.getElementById('fecha_entrada').disabled = true;
        document.getElementById('fecha_salida').disabled = true;
        document.getElementById('Huespedes_id').disabled = true;
        document.getElementById('Habitacion_id').disabled = true;

        document.getElementById('btn_cancelar').style.display = 'none';
        document.getElementById('btn_actualizar').style.display = 'none';

        document.getElementById('btn_volver').style.display = 'block';
        document.getElementById('btn_editar').style.display = 'block';
    }

</script>
@endsection

