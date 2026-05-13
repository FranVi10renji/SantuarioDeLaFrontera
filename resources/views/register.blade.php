<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Santuario de la Frontera</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Quicksand', sans-serif;
            /* Usamos el mismo fondo que el login para coherencia */
            background: url('https://wallpapers.com/images/hd/minimalist-forest-1920-x-1080-wallpaper-5pkjsxawbtqao1nz.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            padding: 30px;
            width: 420px;
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            margin: 20px;
        }

        h1 {
            font-family: 'Fredoka One', cursive;
            color: #000;
            font-size: 22px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .subtitle {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
            display: block;
        }

        .input-group {
            position: relative;
            margin-bottom: 12px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px 40px;
            border-radius: 25px;
            border: 2px solid #000;
            background: rgba(255, 255, 255, 0.9);
            box-sizing: border-box;
            font-size: 14px;
            outline: none;
        }

        .btn-register {
            background: linear-gradient(to right, #0a2e38, #86d8a3);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 25px;
            font-size: 18px;
            font-family: 'Fredoka One', cursive;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            transition: transform 0.2s;
        }

        .btn-register:hover {
            transform: scale(1.02);
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
        }

        .login-link a {
            color: #d152b8;
            text-decoration: none;
        }

        .logo-perro {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 250px;
        }
    </style>
</head>
<body>

    <img src="{{ asset('img/logo_2.png') }}" alt="Logo" class="logo-perro">

    <div class="register-card">
        <form action="{{ route('verificardatos') }}" method="POST">
            @csrf <h1>SANTUARIO DE LA FRONTERA</h1>
            <span class="subtitle">Crea tu cuenta de voluntario</span>

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="nombre" placeholder="Nombre" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-at"></i>
                <input type="email" name="email" placeholder="Correo electrónico" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-user-tag"></i>
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>

            <button type="submit" class="btn-register">
                <i class="fa-solid fa-paw"></i> REGISTRARME
            </button>

            <div class="login-link">
                ¿Ya tienes cuenta? <a href="{{ url('/login') }}">Inicia sesión aquí</a>
            </div>
        </form>
    </div>

</body>
</html>