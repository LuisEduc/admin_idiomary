<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lección') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">slug:</label>
                            <input name="slug" class="form-control rounded" type="text" />
                            <input name="orden" type="hidden" value="{{ count($lecciones) + 1 }}" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">título:</label>
                            <input name="titulo" class="form-control rounded" type="text" />
                        </div>
                        <div>
                            <label class="form-label text-uppercase">título largo:</label>
                            <input name="titulo_seo" class="form-control rounded" type="text" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">descripción:</label>
                            <textarea name="descripcion" class="form-control rounded" type="text" rows="3"></textarea>
                            <div id='count'></div>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">categoría:</label>
                            <select name="id_categoria" class="form-control rounded" type="number">
                                @foreach($categorias as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">cantidad de preguntas:</label>
                            <input name="preguntas" class="form-control rounded" type="number" value="5" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">estado:</label>
                            <select name="estado" class="form-control rounded" type="text">
                                <option value="publica">Publica</option>
                                <option value="privada">Privada</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">tipo:</label>
                            <select name="id_tipo" class="form-control rounded" type="number">
                                @foreach($tipos as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->slug }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Para ver la imagen seleccionada, de lo contrario no se -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 my-4">
                        <div class="d-flex flex-wrap" id="imagenSeleccionada">
                            <!-- <img class="border rounded shadow" id="imagenSeleccionada" style="max-height: 200px;"> -->
                        </div>
                        <div class="grid grid-cols-1">
                            <audio controls id="audioSeleccionado"></audio>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Subir Imagen</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center py-2'>
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class='text-sm text-gray-400 group-hover:text-purple-600 py-2 tracking-wider'>Seleccione la imagen</p>
                                    </div>
                                    <input name="imagen[]" id="imagen" type='file' class="hidden" multiple />
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Subir Audio</label>
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

                    <div class="bg-white overflow-hidden shadow-xl border sm:rounded-lg px-4 py-4 mt-4 text-center">
                        <label class="form-label text-uppercase fw-bold text-xl mb-3">contenido</label>
                        <input type="hidden" id="quill_html" name="contenido"></input>
                        <div id="editor" style="height:500px;"></div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4'>
                        <a href="{{ route('lessons.index') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" id="BtnGuardar" class="btn btn-success">Guardar</button>
                    </div>


                </div>
            </div>
        </form>
    </div>
</x-app-layout>


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

<!-- Script para ver la imagen antes de CREAR UN NUEVO PRODUCTO -->
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

    quill.on('text-change', function(delta, oldDelta, source) {
        document.getElementById("quill_html").value = quill.root.innerHTML;
    });
</script>
<script>
    $(document).ready(function(e) {
        // $('#imagen').change(function() {
        //     let reader = new FileReader();
        //     reader.onload = (e) => {
        //         $('#imagenSeleccionada').attr('src', e.target.result);
        //     }
        //     reader.readAsDataURL(this.files[0]);
        // });
        $('#audio').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#audioSeleccionado').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $("#imagen").change(function() {
            $('#imagenSeleccionada').html("");
            var total_file = document.getElementById("imagen").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#imagenSeleccionada').append("<img class='border rounded shadow mb-1 me-2' style='max-height: 200px;' src='" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        });
    });
</script>