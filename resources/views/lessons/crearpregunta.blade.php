<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lección') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <form action="{{ route('preguntas.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mt-4">
                        @for($index = 0; $index <= $preguntas - 1; $index++) <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">pregunta {{$index}}:</label>
                            <input name="id_lesson[]" value="{{$id_lesson}}" type="hidden" />
                            <input name="id_pregunta[]" value="{{$index}}" type="hidden" />
                            <input name="pregunta[]" class="form-control rounded mb-3" type="text" placeholder="Pregunta" />
                            <small>Opciones</small>
                            <input name="opcion1[]" class="form-control rounded mb-1" type="text" placeholder="Opcion 0" />
                            <input name="opcion2[]" class="form-control rounded mb-1" type="text" placeholder="Opcion 1" />
                            <input name="opcion3[]" class="form-control rounded mb-1" type="text" placeholder="Opcion 2" />
                            <small>Respuesta</small>
                            <input name="respuesta[]" class="form-control rounded mb-1" type="number" placeholder="Número de opción" />
                    </div>
                    @endfor
            </div>
            <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4'>
                <a href="{{ route('lessons.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>

<script>
    window.addEventListener("beforeunload", (event) => {
        event.returnValue = true;
    });
</script>