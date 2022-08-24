<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('titulo')
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
                @yield('contenido')
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function() {
        'use strict'
        //debemos crear la clase formEliminar dentro del form del boton borrar
        //recordar que cada registro a eliminar esta contenido en un form  
        var forms = document.querySelectorAll('.formEliminar')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault()
                    event.stopPropagation()
                    Swal.fire({
                        title: '¿Confirma la eliminación del registro?',
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Confirmar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success');
                        }
                    })
                }, false)
            })
    })()
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#palabras').DataTable({
            "lengthMenu": [
                [5, 10, 50, -1],
                [5, 10, 50, "All"]
            ],
            "order": []
        });
    });
</script>