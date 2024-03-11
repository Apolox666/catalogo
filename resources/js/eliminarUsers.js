$('.eliminar').click(function() {
    var id = $(this).data('id');
    var route = $(this).data('route'); // Obtener la ruta de eliminación desde el atributo data-route

    Swal.fire({
        title: '¿Estás seguro de borrar este usuario?',
        text: "Recuerda que esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, borrar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: route, // Utilizar la ruta de eliminación obtenida del atributo data-route
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
                        'Error',
                        'Error desconocido',
                        'error'
                    );
                }
            });
        }
    });
});
