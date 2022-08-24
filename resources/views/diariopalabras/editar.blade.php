<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar palabra del día') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <form action="{{ route('diariopalabras.update', $diariopalabra->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">mes:</label>
                            <select name="mes" class="form-control rounded" type="text" >
                                <option value="1" @if($diariopalabra->mes=='1') selected='selected' @endif>Enero</option>
                                <option value="2" @if($diariopalabra->mes=='2') selected='selected' @endif>Febrero</option>
                                <option value="3" @if($diariopalabra->mes=='3') selected='selected' @endif>Marzo</option>
                                <option value="4" @if($diariopalabra->mes=='4') selected='selected' @endif>Abril</option>
                                <option value="5" @if($diariopalabra->mes=='5') selected='selected' @endif>Mayo</option>
                                <option value="6" @if($diariopalabra->mes=='6') selected='selected' @endif>Junio</option>
                                <option value="7" @if($diariopalabra->mes=='7') selected='selected' @endif>Julio</option>
                                <option value="8" @if($diariopalabra->mes=='8') selected='selected' @endif>Agosto</option>
                                <option value="9" @if($diariopalabra->mes=='9') selected='selected' @endif>Septiembre</option>
                                <option value="10" @if($diariopalabra->mes=='10') selected='selected' @endif>Octubre</option>
                                <option value="11" @if($diariopalabra->mes=='11') selected='selected' @endif>Noviembre</option>
                                <option value="12" @if($diariopalabra->mes=='12') selected='selected' @endif>Diciembre</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">PALABRAS EN ESPAÑOL:</label>
                            <input name="palabras_es" class="form-control rounded" type="text" value="{{ $diariopalabra->palabras_es }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">PALABRAS EN INGLÉS:</label>
                            <input name="palabras_in" class="form-control rounded" type="text" value="{{ $diariopalabra->palabras_in }}"  />
                        </div>
                    </div>

                    <!-- Para ver la imagen seleccionada, de lo contrario no se -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 my-4">
                        <div class="grid grid-cols-1">
                            <img src="/imagen/{{ $diariopalabra->imagen }}" class="border rounded shadow" id="imagenSeleccionada" style="max-height: 200px;">
                        </div>
                        <div class="grid grid-cols-1">
                            <audio controls src="/audio/{{ $diariopalabra->audio }}" id="audioSeleccionado"></audio>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">Actualizar Imagen</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center py-2'>
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class='text-sm text-gray-400 group-hover:text-purple-600 py-2 tracking-wider'>Seleccione la imagen</p>
                                    </div>
                                    <input name="imagen" id="imagen" type='file' class="hidden" />
                                </label>
                            </div>
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
                        <a href="{{ route('diariopalabras.index') }}" class="btn btn-danger">Cancelar</a>
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
        $('#imagen').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#audio').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#audioSeleccionado').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>