<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Login de Santuario de la frontera.">
    <meta name="keywords" content="login, acceder, registro, usuario, contraseña, santuario">
    <meta name="author" content="Javier Alcoba Navero, Claudia García-Matarredona Urbano, Jesús Fernández Carreño, Marcos García Bravo">
    <meta name="robots" content="index, follow">
    <meta name="language" content="spanish">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Madimi One", Arial, Helvetica, sans-serif
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Login</title>
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