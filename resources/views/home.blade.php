<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .btn-estado-activo {
            background-color: green;
            color: white;
        }
        .btn-estado-desactivo {
            background-color: yellow;
            color: black;
        }
        .btn-edit, .btn-delete {
            margin-right: 5px;
        }
        .dataTables_filter input {
            width: 400px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0;
            margin: 0;
            border: none;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            border: none;
            background-color: transparent;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Usuarios</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Nuevo
        </button>
        <table id="usuariosTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Cargo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here by DataTables -->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal de usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fa fa-user"></i>
                            <input type="text" id="usuario" class="form-control" placeholder="Nombre de usuario" required>
                        </div>
                        <div class="form-group col-md-6">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input type="email" id="email" class="form-control" placeholder="Correo electronico" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fa fa-user-tag"></i>
                            <select name="rol" id="rol" class="form-control" required>
                                <option value="" disabled selected>Seleccionar Rol</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <i class="fa fa-briefcase"></i>
                            <select name="cargo" id="cargo" class="form-control" required>
                                <option value="" disabled selected>Seleccionar Cargo</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnIngresar">Guadar</button>
            <button type="button" class="btn btn-primary" style="display: none;" data-bs-dismiss="modal" id="btnEditar">Editar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{asset('js/home.js')}}"></script>
</body>
</html>
