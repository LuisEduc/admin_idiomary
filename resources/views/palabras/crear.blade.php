<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Palabra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <form action="{{ route('palabras.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Palabra español:</label>
                            <input name="p_es" class="form-control rounded" type="text"/>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Palabra inglés:</label>
                            <input name="p_in" class="form-control rounded" type="text"/>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Tipo español:</label>
                            <select name="t_es" id="t_es" class="form-control rounded" type="text" >
                                <option value="sustantivo">Sustantivo</option>
                                <option value="adjetivo">Adjetivo</option>
                                <option value="verbo">Verbo</option>
                                <option value="adverbio">Adverbio</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Tipo inglés:</label>
                            <select name="t_in" id="t_in" class="form-control rounded" type="text" >
                                <option value="noun">Noun</option>
                                <option value="adjective">Adjective</option>
                                <option value="verb">Verb</option>
                                <option value="adverb">Adverb</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Frase español:</label>
                            <input name="f_es" class="form-control rounded" type="text"/>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Frase inglés:</label>
                            <input name="f_in" class="form-control rounded" type="text"/>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">nivel:</label>
                            <select name="nivel" class="form-control rounded" type="text" >
                                <option value="basico">Básico</option>
                                <option value="medio">Medio</option>
                                <option value="avanzado">Avanzado</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Grabar:</label>
                            <select name="grabar" class="form-control rounded" type="text" >
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4'>
                        <a href="{{ route('palabras.index') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
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