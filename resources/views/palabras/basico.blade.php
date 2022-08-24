@extends('layouts.base')

@section('titulo')
{{ __('Nivel Básico') }}
@endsection

@section('contenido')
<div class="table-responsive-xl">
    <table id="palabras" class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="d-none">ID</th>
                <th scope="col">P_ES</th>
                <th scope="col">P_IN</th>
                <th scope="col">T_ES</th>
                <th scope="col">T_IN</th>
                <th scope="col">F_ES</th>
                <th scope="col">F_IN</th>
                <th scope="col">NIVEL</th>
                <th scope="col">GRABAR</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($palabras as $palabra)
            <tr>
                <td class="d-none">{{$palabra->id}}</td>
                <td>{{$palabra->p_es}}</td>
                <td>{{$palabra->p_in}}</td>
                <td>{{$palabra->t_es}}</td>
                <td>{{$palabra->t_in}}</td>
                <td>{{$palabra->f_es}}</td>
                <td>{{$palabra->f_in}}</td>
                <td>{{$palabra->nivel}}</td>
                <td>
                    <form action="{{ route('palabras.grabar', $palabra->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" @if($palabra->grabar)
                            class="btn btn-success btn-sm">si</button>
                        @else
                        class="btn btn-outline-danger btn-sm">no</button>
                        @endif
                    </form>
                </td>
                <td>
                    <div class="d-flex justify-content-center" role="group">
                        <!-- botón editar -->
                        <a href="{{ route('palabras.edit', $palabra->id) }}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>

                        <!-- botón borrar -->
                        <form action="{{ route('palabras.destroy', $palabra->id)}}" method="POST" class="formEliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-2"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection