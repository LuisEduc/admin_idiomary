<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <form action="{{ route('tipos.update', $tipo->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">slug:</label>
                            <input name="slug" class="form-control rounded" type="text" value="{{ $tipo->slug }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">título:</label>
                            <input name="titulo" class="form-control rounded" type="text" value="{{ $tipo->titulo }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">ícono:</label>
                            <input name="icono" class="form-control rounded" type="text" value="{{ $tipo->icono }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">color:</label>
                            <input name="color" class="form-control rounded" type="text" value="{{ $tipo->color }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">fondo:</label>
                            <input name="bg" class="form-control rounded" type="text" value="{{ $tipo->bg }}"  />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="form-label text-uppercase">estado:</label>
                            <select name="estado" class="form-control rounded" type="text" >
                                <option value="publica" @if($tipo->estado=='publica') selected='selected' @endif>Publica</option>
                                <option value="privada" @if($tipo->estado=='privada') selected='selected' @endif>Privada</option>
                            </select>
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4'>
                        <a href="{{ route('tipos.index') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
