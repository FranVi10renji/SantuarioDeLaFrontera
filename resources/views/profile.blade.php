<!DOCTYPE html>
<html>
<head>
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>¡Funciona!</h1>
    @if($user)
        <p>Bienvenido al santuario, <strong>{{ $user->name }}</strong>.</p>
    @else
        <p>No se encontró ningún usuario, pero la vista ya carga.</p>
    @endif
</body>
</html>