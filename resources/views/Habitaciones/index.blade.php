@extends('welcome')
@section('contenido')
<div class="container">
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
                    <h2>Listado de Habitaciones</h2>

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

                    @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" role="img" width='16' height='16' aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" /></svg>
                        <div>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif


                    <a class="btn btn-success" href="{{ route('habitaciones.create') }}">Nuevo</a>
                </center>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center">id</th>
                            <th style="text-align: center">Número</th>
                            <th style="text-align: center">Tipo</th>
                            <th style="text-align: center">Precio</th>
                            <th colspan="2" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($habitaciones as $habitacion)
                        <tr>
                            <th style="text-align: center">{{ $habitacion->id }}</th>
                            <th style="text-align: center">{{ $habitacion->numero }}</th>
                            <th style="text-align: center">{{ $habitacion->Tipo }}</th>
                            <th style="text-align: center">{{ $habitacion->precio }}</th>
                            <th style="text-align: right">
                                <a href="{{ route('habitaciones.edit', ['id'=> $habitacion->id]) }}" class="btn btn-info">Ver</a>
                            </th>
                            <th style="text-align: left">
                                <form action="{{ route('habitaciones.destroy', ['id'=> $habitacion->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Eliminar" onclick="return confirmarEliminacion()">
                                </form>
                            </th>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div style="width: 100%">
                <center>
                    {{ $habitaciones->links('pagination::bootstrap-4') }}
                </center>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmarEliminacion() {
        if (confirm('¿Estás seguro que deseas eliminar esta habitación?')) {
            document.getElementById('delete-form').submit();
        } else {
            return false;
        }
    }

</script>
@endsection

