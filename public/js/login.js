$(document).ready(function() {
    
});
$("#btnIngresar").on("click", function(e) {
    e.preventDefault();
    var usuario = {
        email: $("#email").val(),
        password: $("#password").val()
    }
    $.ajax({
        url: "api/auth/login",
        type: "POST",
        dataType: "JSON",
        data: usuario,
        success: function(response) {
            localStorage.setItem('token', response.access_token);
            Swal.fire({
                icon: 'success',
                title: 'usuario Logueado con exito',
                text: 'Bienvenido jejejeje',
                showConfirmButton: true,
            }).then(() => {
                window.location.href = `/home`;
            })
        },
        error: function(error) {
            if (error.status === 422) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Notificacion',
                    text: 'Debe llenar todos los campos y de manera correcta por favor',
                    showConfirmButton: true
                })
            }

            if (error.status === 401) {
                Swal.fire({
                    icon: 'error',
                    title: 'Notificacion',
                    text: 'Credenciales incorrectas',
                    showConfirmButton: true
                }).then(() => {
                    $("#email").val("");
                    $("#password").val("");
                })
            }
        }
    });
});