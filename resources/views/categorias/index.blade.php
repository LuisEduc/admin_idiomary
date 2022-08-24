<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">

                <a class="btn btn-primary my-2 ms-2" href="{{ route('categorias.create') }}" role="button">Crear</a>
                <div class="table-responsive-xl">
                    <table id="categorias" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="d-none">ID</th>
                                <th scope="col">SLUG</th>
                                <th class="d-none" scope="col">ORDEN</th>
                                <th scope="col">TITULO</th>
                                <th scope="col">DESCRIPCION</th>
                                <th scope="col">NIVEL</th>
                                <th scope="col">ICONO</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents" value="{{ count($categorias) }}">
                            @foreach($categorias as $categoria)
                            <tr class="fila" data-id="{{ $categoria->id }}">
                                <td class="d-none">{{$categoria->id}}</td>
                                <td>{{$categoria->slug}}</td>
                                <td class="d-none" >{{$categoria->orden}}</td>
                                <td>{{$categoria->titulo}}</td>
                                <td>{{$categoria->descripcion}}</td>
                                <td>{{$categoria->nivel}}</td>
                                <td>{{$categoria->icono}}</td>
                                <td>
                                    <div class="d-flex justify-content-center" role="group">
                                        <!-- botón editar -->
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>

                                        <!-- botón borrar -->
                                        <form action="{{ route('categorias.destroy', $categoria->id)}}" method="POST" class="formEliminar">
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categorias').DataTable({
            "lengthMenu": [
                [5, 10, 50, -1],
                [5, 10, 50, "All"]
            ],
            "order": []
        });

        if ($("#tablecontents").attr('value') <= 5) {

            $("#tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

        }

        $('[name=categorias_length]').on("click", function() {

            console.log($("#tablecontents").attr('value'))

            if ($('tr.fila').length == $("#tablecontents").attr('value')) {

                $("#tablecontents").sortable({
                    items: "tr",
                    cursor: 'move',
                    opacity: 0.6,
                    update: function() {
                        sendOrderToServer();
                    }
                });
            }

        });

        function sendOrderToServer() {

            let orden = [];
            
            $('tr.fila').each(function(index, element) {
                let filas = $('tr.fila').length
                orden.push({
                    id: $(this).attr('data-id'),
                    posicion: filas - index
                });
            });

            $.ajax({
                url: "{{ route('categorias.updateorden') }}",
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    orden: orden,
                },
                success: function(data) {
                    console.log('success');
                }
            });

        }
    });
</script>