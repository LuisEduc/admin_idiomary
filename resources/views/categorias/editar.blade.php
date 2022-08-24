<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">slug:</label>
                            <input name="slug" class="form-control rounded" type="text" value="{{ $categoria->slug }}" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">título:</label>
                            <input name="titulo" class="form-control rounded" type="text" value="{{ $categoria->titulo }}" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">nivel:</label>
                            <select name="nivel" class="form-control rounded" type="text">
                                <option value="basico" @if($categoria->nivel=='basico') selected='selected' @endif>Básico</option>
                                <option value="medio" @if($categoria->nivel=='medio') selected='selected' @endif>Medio</option>
                                <option value="avanzado" @if($categoria->nivel=='avanzado') selected='selected' @endif>Avanzado</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">ícono:</label>
                            <input name="icono" class="form-control rounded" type="text" value="{{ $categoria->icono }}" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">descripción:</label>
                            <textarea name="descripcion" class="form-control rounded" type="text" rows="3">{{ $categoria->descripcion }}</textarea>
                            <div id='count'></div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl border sm:rounded-lg px-4 py-4 mt-4 text-center">
                        <label class="form-label text-uppercase fw-bold text-xl mb-3">contenido</label>
                        <input type="hidden" id="quill_html" name="catcontenido"></input>
                        <div id="editor" style="height:500px;">
                            {!!$categoria->catcontenido!!}
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4'>
                        <a href="{{ route('categorias.index') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" id="BtnActualizar" class="btn btn-success">Actualizar</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike', 'link'], // toggled buttons
        ['blockquote', 'code-block'],

        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }], // superscript/subscript
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent
        [{
            'direction': 'rtl'
        }], // text direction

        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'font': []
        }],
        [{
            'align': []
        }],

        ['clean'] // remove formatting button
    ];
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    BtnActualizar.addEventListener("click", function() {
        document.getElementById("quill_html").value = quill.root.innerHTML;
    });
</script>

<script>
    window.addEventListener("beforeunload", (event) => {
        event.returnValue = true;
    });

    const textarea = document.querySelector('textarea')
    const count = document.getElementById('count')
    textarea.onkeyup = (e) => {
        if (191 - e.target.value.length > -1) {
            count.innerText = "Caracteres disponibles: " + (191 - e.target.value.length);
            count.style.color = "green";
            count.style.fontWeight = "600";
        } else {
            count.innerText = "Exceso de caracteres";
            count.style.color = "red";
            count.style.fontWeight = "900";
        }
    };
</script>