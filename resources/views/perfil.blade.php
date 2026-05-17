<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario - Santuario</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 10px; max-width: 500px; }
        .dato { margin-bottom: 10px; }
        label { font-weight: bold; color: #555; }
    </style>
</head>
<body>
    <h1>Datos del Perfil</h1>

    @if($user)
        <div class="card">
            <p>¡Bienvenido al santuario, <strong>{{ $user->nombre }}</strong>!</p>
            <hr>
            <div class="dato"><label>Nombre completo:</label> {{ $user->nombre }} {{ $user->apellido }}</div>
            <div class="dato"><label>Nombre de usuario:</label> {{ $user->usuario }}</div>
            <div class="dato"><label>Email:</label> {{ $user->email }}</div>
            <div class="dato"><label>Cuenta Bancaria:</label> {{ $user->cuenta_bancaria ?? 'No facilitada' }}</div>
            <div class="dato"><label>Rol:</label> {{ $user->es_trabaj ? 'Trabajador/Voluntario' : 'Usuario estándar' }}</div>
        </div>
    @else
        <p>No se encontró ningún usuario para mostrar.</p>
    @endif

    <br>
    <a href="{{ url('/register') }}">Volver al registro</a>
</body>
</html>