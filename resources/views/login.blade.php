<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Santuario de la Frontera</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Estilos base */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Quicksand', sans-serif;
            background: url('https://wallpapers.com/images/hd/minimalist-forest-1920-x-1080-wallpaper-5pkjsxawbtqao1nz.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* El contenedor de cristal */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            padding: 40px;
            width: 380px;
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-family: 'Fredoka One', cursive;
            color: #000;
            font-size: 24px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .welcome-text {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 25px;
        }

        /* Inputs */
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px 40px;
            border-radius: 25px;
            border: 2px solid #000;
            background: rgba(255, 255, 255, 0.8);
            box-sizing: border-box;
            font-size: 16px;
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #000;
            text-decoration: none;
            margin-bottom: 30px;
            font-weight: bold;
        }

        /* Botón Iniciar Sesión */
        .btn-login {
            background: linear-gradient(to right, #0a2e38, #86d8a3);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 25px;
            font-size: 20px;
            font-family: 'Fredoka One', cursive;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        /* Social Login */
        .social-login {
            margin-top: 20px;
        }

        .google-icon {
            width: 35px;
            margin-top: 10px;
            cursor: pointer;
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .register-link a {
            color: #d152b8;
            text-decoration: none;
        }

        /* Logo perro arriba a la derecha */
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

    <div class="login-card">
        <form action="{{ route('verificarLogin') }}" method="POST">
            @csrf <h1>Santuario de la Frontera</h1>
            <div class="welcome-text">¡Bienvenido!</div>

            @if($errors->any())
                <div style="background-color: rgba(255, 0, 0, 0.2); 
                            color: #8b0000; 
                            padding: 10px; 
                            border-radius: 15px; 
                            margin-bottom: 20px; 
                            border: 1px solid rgba(255, 0, 0, 0.3);
                            font-size: 14px;
                            font-weight: bold;">
                    <i class="fa-solid fa-triangle-exclamation"></i> 
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="usuario" placeholder="Nombre de Usuario" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Contraseña" required>
                <i class="fa-solid fa-eye" style="left: auto; right: 15px; cursor: pointer;"></i>
            </div>

            <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-paper-plane"></i> INICIAR SESIÓN
            </button>

            <div class="social-login">
                <p>O inicia sesión usando</p>
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="google-icon" alt="Google">
            </div>

            <div class="register-link">
                ¿No tienes cuenta? <a href="{{ url('/register') }}">Regístrate aquí</a>
            </div>
        </form>
    </div>

</body>
</html>