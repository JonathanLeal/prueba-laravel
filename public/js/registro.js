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
});

$('#btnIngresar').on('click', function(e) {
    e.preventDefault();
    var usuario = $('#usuario').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var rol = $('#rol').val();
    var cargo = $('#cargo').val();

    $.ajax({
        url: 'api/auth/register', 
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            usuario: usuario,
            email: email,
            password: password,
            rol: rol,
            cargo: cargo
        }),
        success: function(response) {
            Swal.fire({
                title: "Bienvenido",
                text: "Registrado con exito",
                icon: "success"
            }).then(() => {
                window.location.href = `/`;
            })
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                Swal.fire({
                    title: "Cuidado",
                    text: "debe llenar todos los campos y de manera correcta por favor",
                    icon: "warning"
                });
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