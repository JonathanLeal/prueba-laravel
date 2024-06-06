$(document).ready(function() {
    // Cargar roles
    $.ajax({
        url: '/roles',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let rolesSelect = $('select[name="rol"]');
            rolesSelect.empty();
            rolesSelect.append('<option value="" disabled selected>Seleccionar Rol</option>');
            $.each(data, function(key, value) {
                rolesSelect.append('<option value="'+ value.id +'">'+ value.roles +'</option>');
            });
        },
        error: function() {
            alert('Error al cargar los roles.');
        }
    });

    // Cargar cargos
    $.ajax({
        url: '/cargos',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let cargosSelect = $('select[name="cargo"]');
            cargosSelect.empty();
            cargosSelect.append('<option value="" disabled selected>Seleccionar Cargo</option>');
            $.each(data, function(key, value) {
                cargosSelect.append('<option value="'+ value.id +'">'+ value.cargos +'</option>');
            });
        },
        error: function() {
            alert('Error al cargar los cargos.');
        }
    });

    var token = localStorage.getItem('token');

    if (!token) {
        window.location.href = "/";
        return;
    }

    $('#usuariosTable').DataTable({
        "ajax": {
            "url": "api/auth/usuarios",
            "type": "GET",
            "beforeSend": function(request) {
                request.setRequestHeader("Authorization", "Bearer " + token);
            },
            "dataSrc": "",
            "error": function(xhr, error, thrown) {
                if (xhr.status === 402) {
                    window.location.href = "/";
                }
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { 
                "data": "estado",
                "render": function(data, type, row) {
                    var btnClass = data === 'ACTIVO' ? 'btn-estado-activo' : 'btn-estado-desactivo';
                    return `<button class="btn ${btnClass}">${data}</button>`;
                }
            },
            { "data": "cargos" },
            { "data": "roles" },
            {
                "data": null,
                "defaultContent": '<button class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-edit"></i> </button> <button class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i> </button>'
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });

    $('#usuariosTable tbody').on('click', 'button.btn-edit', function() {
        var data = $('#usuariosTable').DataTable().row($(this).parents('tr')).data();
        $('#btnEditar').show();
        $('#btnIngresar').hide();
        $.ajax({
            url: 'api/auth/usuarios/' + data.id,
            method: 'GET',
            success: function(response){
                $('#usuario').val(response.name);
                $('#email').val(response.email);
                $('#password').val(response.password);
                $('#rol').val(response.roles);
                $('#cargo').val(response.cargos);
    
                $("#btnEditar").on("click", function(e){
                    e.preventDefault();
                    $.ajax({
                        url: 'api/auth/editar/' + data.id,
                        method: 'POST',
                        beforeSend: function(request) {
                            request.setRequestHeader("Authorization", "Bearer " + token);
                        },
                        contentType: "application/json", // Asegúrate de establecer el tipo de contenido
                        data: JSON.stringify({
                            usuario: $('#usuario').val(),
                            email: $('#email').val(),
                            password: $('#password').val(),
                            rol: $('#rol').val(),
                            cargo: $('#cargo').val()
                        }),
                        success: function(response){
                            Swal.fire({
                                title: "Exito",
                                text: "Registrado con exito",
                                icon: "success"
                            })
                            $('#usuariosTable').DataTable().ajax.reload();
                        },
                        error: function(error){
                            if (error.status === 422) {
                                Swal.fire({
                                    title: "Cuidado",
                                    text: "Debe llenar todos los campos y de manera correcta por favor",
                                    icon: "warning"
                                });
                            } else if (error.status === 401) {
                                Swal.fire({
                                    title: "Opsss",
                                    text: "Su sesion ha terminado, por favor intente volver a ingresar",
                                    icon: "warning"
                                }).then(() => {
                                    window.location.href = `/`;
                                });
                            } else if (error.status === 500) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Ha ocurrido un error interno, por favor intente más tarde",
                                    icon: "error"
                                });
                            }
                        }
                    });
                });
            },
            error: function(error){
                console.log(error);
            }    
        });
    });
    

    $('#usuariosTable tbody').on('click', 'button.btn-delete', function() {
        var data = $('#usuariosTable').DataTable().row($(this).parents('tr')).data();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'api/auth/eliminar/' + data.id,
                    method: 'DELETE',
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer " + token);
                    },
                    success: function(response) {
                        Swal.fire(
                            'Eliminado',
                            'El usuario ha sido eliminado',
                            'success'
                        );
                        $('#usuariosTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            Swal.fire({
                                title: "Opsss",
                                text: "Su sesion ha terminado, por favor intente volver a ingresar",
                                icon: "warning"
                            }).then(() => {
                                window.location.href = `/`;
                            });
                        } else if (xhr.status === 500) {
                            Swal.fire({
                                title: "Error",
                                text: "A ocurrido un error interno por favor intente mas tarde",
                                icon: "error"
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "No se pudo eliminar el usuario",
                                icon: "error"
                            });
                        }
                    }
                });
            }
        });
    });
});

$('#btnIngresar').on('click', function(e) {
    e.preventDefault();
    var usuario = $('#usuario').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var rol = $('#rol').val();
    var cargo = $('#cargo').val();

    $.ajax({
        url: 'api/auth/agregar', 
        method: 'POST',
        contentType: 'application/json',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        data: JSON.stringify({
            usuario: usuario,
            email: email,
            password: password,
            rol: rol,
            cargo: cargo
        }),
        success: function(response) {
            Swal.fire({
                title: "Exito",
                text: "Registrado con exito",
                icon: "success"
            })
            $('#usuariosTable').DataTable().ajax.reload();
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                Swal.fire({
                    title: "Cuidado",
                    text: "debe llenar todos los campos y de manera correcta por favor",
                    icon: "warning"
                });
            } 

            if (xhr.status === 401) {
                Swal.fire({
                    title: "Opsss",
                    text: "Su sesion ha terminado, por favor intente volver a ingresar",
                    icon: "warning"
                }).then(() => {
                    window.location.href = `/`;
                })
            } 

            if (xhr.status === 500) {
                Swal.fire({
                    title: "error",
                    text: "A ocurrido un error interno por favor intente mas tarde",
                    icon: "error"
                });
            } 
        }
    });
});