<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            animation: fadeIn 1s ease-in-out;
        }

        .login-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
            text-align: center;
            letter-spacing: 1px;
            text-transform: uppercase;
            animation: slideInDown 0.5s ease-in-out;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            padding-left: 40px;
            height: 45px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 10px rgba(106, 17, 203, 0.5);
        }

        .fa {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            transition: color 0.3s ease-in-out;
        }

        .form-control:focus + .fa {
            color: #6a11cb;
        }

        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
            height: 45px;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
            box-shadow: 0 0 20px rgba(37, 117, 252, 0.5);
        }

        .register-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #666;
            transition: color 0.3s ease-in-out;
        }

        .register-link:hover {
            color: #2575fc;
            text-decoration: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container:hover .form-control {
            border-color: #2575fc;
        }

        .login-container:hover .fa {
            color: #2575fc;
        }

        /* Background Animations */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .background span {
            position: absolute;
            display: block;
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 20s linear infinite;
        }

        .background span:nth-child(1) {
            left: 5%;
            width: 80px;
            height: 80px;
            bottom: -80px;
            animation-delay: 0s;
        }
        .background span:nth-child(2) {
            left: 15%;
            width: 120px;
            height: 120px;
            bottom: -120px;
            animation-delay: 2s;
            animation-duration: 25s;
        }
        .background span:nth-child(3) {
            left: 25%;
            width: 60px;
            height: 60px;
            bottom: -60px;
            animation-delay: 4s;
        }
        .background span:nth-child(4) {
            left: 40%;
            width: 100px;
            height: 100px;
            bottom: -100px;
            animation-delay: 0s;
            animation-duration: 20s;
        }
        .background span:nth-child(5) {
            left: 70%;
            width: 80px;
            height: 80px;
            bottom: -80px;
            animation-delay: 0s;
        }
        .background span:nth-child(6) {
            left: 80%;
            width: 120px;
            height: 120px;
            bottom: -120px;
            animation-delay: 3s;
            animation-duration: 25s;
        }
        .background span:nth-child(7) {
            left: 90%;
            width: 60px;
            height: 60px;
            bottom: -60px;
            animation-delay: 5s;
        }

        @keyframes animate {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<div class="background">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<div class="login-container">
    <h2>Iniciar Sesión</h2>
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
        <button type="button" id="btnIngresar" class="btn btn-primary btn-block">Ingresar</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/registro.js') }}"></script>
</body>
</html>
