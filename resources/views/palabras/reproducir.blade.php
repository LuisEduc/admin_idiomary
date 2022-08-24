<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reproducir audio de las palabras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">

                <a class="btn btn-primary btn-sm my-2 ms-2" href="{{ route('palabras.create') }}" role="button">Crear</a>
                <a class="btn btn-secondary btn-sm my-2 ms-2" href="{{ route('palabras.index') }}" role="button">Todas</a>
                <div class="btn-group">
                    <button class="btn btn-success btn-sm my-2 ms-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nivel
                    </button>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('palabras.basico') }}" role="button">Básico</a>
                        <a class="dropdown-item" href="{{ route('palabras.medio') }}" role="button">Medio</a>
                        <a class="dropdown-item" href="{{ route('palabras.avanzado') }}" role="button">Avanzado</a>
                    </ul>
                </div>
                <a class="btn btn-danger btn-sm my-2 ms-2" href="{{ route('palabras.reproducir') }}" role="button">Grabar</a>
                <div class="d-flex justify-content-center">
                    <button id="btnplay" type="button" class="btn btn-success my-2 me-2 px-5">PLAY</button>
                    <button id="btnstop" type="button" class="btn btn-outline-danger my-2 ms-2 px-5">STOP</button>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="mt-1 me-2">Spanish</div>
                    <select class="select-voz form-select form-select-sm" id="voz_es"></select>
                </div>
                <div class="d-flex justify-content-center my-2">
                    <div class="mt-1 me-2">English</div>
                    <select class="select-voz form-select form-select-sm" id="voz_in"></select>
                </div>
                <div class="table-responsive-xl">
                    <table id="palabras" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="d-none">ID</th>
                                <th scope="col">P_ES</th>
                                <th scope="col">P_IN</th>
                                <th scope="col">PRON</th>
                                <th scope="col">T_ES</th>
                                <th scope="col">T_IN</th>
                                <th scope="col">F_ES</th>
                                <th scope="col">F_IN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($palabras as $palabra)
                            <tr>
                                <td class="d-none">{{$palabra->id}}</td>
                                <td class="p_es">{{$palabra->p_es}}</td>
                                <td class="p_in">{{$palabra->p_in}}</td>
                                <td class="pron_aprox">{{$palabra->pron_aprox}}</td>
                                <td class="t_es">{{$palabra->t_es}}</td>
                                <td class="t_in">{{$palabra->t_in}}</td>
                                <td class="f_es">{{$palabra->f_es}}</td>
                                <td class="f_in">{{$palabra->f_in}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('/js/reproducir.js')}}"></script>