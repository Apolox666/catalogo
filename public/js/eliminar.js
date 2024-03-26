$('.eliminar').click(function() {
    var id = $(this).data('id'); // Obtener el valor del atributo data-id
    Swal.fire({
        title: '¿Estás seguro de borrar este registro?',
        text: "Es posible que este responsable esté asociado a un grupo de trabajo y dejará de ser visible allí",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, borrar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: "/servicios/eliminar/" + id, // Ruta específica para eliminar un servicio
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
                    $(`.eliminar[data-id=${id}]`).closest('.row').remove();
                },
                error: function(respuesta) {
                    Swal.fire(
                        'No se puede realizar esta acción',
                        'Ocurrió un error al borrar este registro',
                        'warning'
                    );
                }
            });
        }
    });
});
