import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const url = button.getAttribute('data-url');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud AJAX para eliminar el registro
                    axios.delete(url)
                        .then(response => {
                            if (response.status === 200) {
                                // Eliminar la fila de la tabla sin recargar la página
                                const row = button.closest('.user-row');
                                row.remove();
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                );
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire(
                                'Error',
                                'Ha ocurrido un error al intentar eliminar el registro.',
                                'error'
                            );
                        });
                }
            });
        });
    });
});