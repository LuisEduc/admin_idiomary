<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Palabra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <form action="{{ route('palabras.update', $palabra->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Palabra español:</label>
                            <input name="p_es" class="form-control rounded" type="text" value="{{ $palabra->p_es }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Palabra inglés:</label>
                            <input name="p_in" class="form-control rounded" type="text" value="{{ $palabra->p_in }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Tipo español:</label>
                            <select name="t_es" id="t_es" class="form-control rounded" type="text" >
                                <option value="sustantivo" @if($palabra->t_es=='sustantivo') selected='selected' @endif>Sustantivo</option>
                                <option value="adjetivo" @if($palabra->t_es=='adjetivo') selected='selected' @endif>Adjetivo</option>
                                <option value="verbo" @if($palabra->t_es=='verbo') selected='selected' @endif>Verbo</option>
                                <option value="adverbio" @if($palabra->t_es=='adverbio') selected='selected' @endif>Adverbio</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Tipo inglés:</label>
                            <select name="t_in" id="t_in" class="form-control rounded" type="text" >
                                <option value="noun" @if($palabra->t_in=='noun') selected='selected' @endif>Noun</option>
                                <option value="adjective" @if($palabra->t_in=='adjective') selected='selected' @endif>Adjective</option>
                                <option value="verb" @if($palabra->t_in=='verb') selected='selected' @endif>Verb</option>
                                <option value="adverb" @if($palabra->t_in=='adverb') selected='selected' @endif>Adverb</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Frase español:</label>
                            <input name="f_es" class="form-control rounded" type="text" value="{{ $palabra->f_es }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Frase inglés:</label>
                            <input name="f_in" class="form-control rounded" type="text" value="{{ $palabra->f_in }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">nivel:</label>
                            <select name="nivel" class="form-control rounded" type="text" >
                                <option value="basico" @if($palabra->nivel=='basico') selected='selected' @endif>Básico</option>
                                <option value="medio" @if($palabra->nivel=='medio') selected='selected' @endif>Medio</option>
                                <option value="avanzado" @if($palabra->nivel=='avanzado') selected='selected' @endif>Avanzado</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Grabar:</label>
                            <select name="grabar" class="form-control rounded" type="text" value="{{ $palabra->grabar }}" >
                                <option value="0" @if($palabra->grabar) selected='selected' @endif>No</option>
                                <option value="1" @if($palabra->grabar) selected='selected' @endif>Sí</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1 mx-auto my-auto">
                            <audio controls src="/audio/{{ $palabra->audio }}" id="audioSeleccionado"></audio>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Actualizar Audio</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center py-2'>
                                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13c0-1.104 1.12-2 2.5-2s2.5.896 2.5 2zm9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2z" />
                                            <path fill-rule="evenodd" d="M14 11V2h1v9h-1zM6 3v10H5V3h1z" />
                                            <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4V2.905z" />
                                        </svg>
                                        <p class='text-sm text-gray-400 group-hover:text-purple-600 py-2 tracking-wider'>Seleccione el audio</p>
                                    </div>
                                    <input name="audio" id="audio" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4'>
                        <a href="{{ route('palabras.index') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<!-- Script para ver la imagen antes de CREAR UN NUEVO PRODUCTO -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(e) {
        $('#audio').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#audioSeleccionado').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

    $("#t_es").on('change', function() {
    var value = $(this).val();
    if (value == "sustantivo") {
        $("#t_in").val("noun");
    } else if (value == "adjetivo") {
        $("#t_in").val("adjective");
    } else if (value == "verbo") {
        $("#t_in").val("verb");
    } else if (value == "adverbio") {
        $("#t_in").val("adverb");
    }
    });

    $("#t_in").on('change', function() {
    var value = $(this).val();
    if (value == "noun") {
        $("#t_es").val("sustantivo");
    } else if (value == "adjective") {
        $("#t_es").val("adjetivo");
    } else if (value == "verb") {
        $("#t_es").val("verbo");
    } else if (value == "adverb") {
        $("#t_es").val("adverbio");
    }
    });

</script>