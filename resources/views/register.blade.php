<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Registro de Santuario de la frontera.">
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
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <title>Registro</title>
</head>
<body>

    <img src="{{ asset('img/logo_2.png') }}" alt="Logo" class="logo-perro">

    <div class="register-card">
        <form action="{{ route('verificarRegistro') }}" method="POST">
            @csrf <h1>SANTUARIO DE LA FRONTERA</h1>
            <span class="subtitle">Crea tu cuenta de voluntario</span>

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="nombre" placeholder="Nombre" required>
                @error('nombre')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
                @error('apellidos')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa-solid fa-at"></i>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                @error('email')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa-solid fa-user-tag"></i>
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                @error('usuario')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Contraseña" required>
                @error('password')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
                @error('password_confirmation')
                <div style="color: red;">{{ $message }}</div>
                @enderror
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