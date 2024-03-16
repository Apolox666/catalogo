$(document).ready(function() {
    $('.eliminar').click(function() {
        var id = $(this).data('id'); // Obtener el valor del atributo data-id
        Swal.fire({
            title: '¿Estás seguro de borrar este usuario?',
            text: "El usuario no podrá ingresar al sistema, esta operación no se puede deshacer",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, borrar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('user.destroy', ':id') }}".replace(':id', id),
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(respuesta) {
                        Swal.fire(
                            'Éxito',
                            'Cambios efectuados correctamente',
                            'success'
                        );
                        // Eliminar el elemento eliminado de la interfaz
                        $(`.eliminar[data-id=${id}]`).closest('.user-row').remove();
                    },
                    error: function(respuesta) {
                        Swal.fire(
                            'No se puede realizar esta acción',
                            'Este grupo contiene responsables asociados',
                            'warning'
                        );
                    }
                });
            }
        });
    });
});