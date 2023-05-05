@extends('welcome')
@section('contenido')
<div class="container"  style="width: 40%">
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
                    <h2>Registro de Habitaciones</h2>

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
            <form action="{{ route('habitaciones.store') }}" method="POST" id="delete-form">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Número de habitación</span>
                    <input   type="number" class="form-control" name="numero" id="numero" value="{{ old('numero') }}" aria-describedby="basic-addon1">

                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Tipo</span>
                    <select  class="form-select" name="Tipo" id="Tipo" aria-label="Default select example">
                        <option value="">Seleccione</option>
                        <option @if(old('Tipo')=='Individual' ) selected
                            @else

                            @endif value="Individual">Individual</option>
                        <option @if(old('Tipo')=='Doble' ) selected @else
                            @endif value="Doble">Doble</option>
                        <option @if(old('Tipo')=='Suite' ) selected @else
                            @endif value="Suite">Suite</option>
                        <option @if(old('Tipo')=='Economica' ) selected @else
                            @endif value="Economica">Economica</option>
                    </select>
                </div>


                <div class="input-group mb-3">
                    <input  type="text" name='precio' id='precio' value="{{ old('precio')  }}" class="form-control">
                    <span class="input-group-text">.00</span>

                </div>
                <div class="row">
                    <div class="col-3">
                        <a href="#" id="btn_volver" onclick="window.history.back();" class="btn btn-secondary">Volver</a>
                    </div>
                    <div class="col-3">
                        <button type="submit" id="btn_actualizar" onclick="return actualozizarConfirmacion()" class="btn btn-info">Crear</button>
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
        if (confirm('¿Estás seguro que deseas crear este nuevo registro?')) {
            document.getElementById('delete-form').submit();
        } else {
            return false;
        }
    }

</script>
@endsection

