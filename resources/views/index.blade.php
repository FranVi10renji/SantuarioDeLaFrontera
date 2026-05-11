<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Inicio de la web del santuario e información. Visualización de animales.">
    <meta name="keywords" content="inicio, card, adopción, donación, animal, santuario, php, mysql, base de datos">
    <meta name="author" content="Javier Alcoba Navero, Claudia García-Matarredona Urbano, Jesús Fernández Carreño, Marcos García Bravo">
    <meta name="robots" content="index, follow">
    <meta name="language" content="spanish">
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
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <title>Inicio</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="{{route('index')}}"><span>Logo</span><img src="{{asset('img/logo_2.png')}}" alt="Logo del santuario"></a>
                </li>
                <li>
                    <a href="{{route('index')}}">INICIO</a>
                </li>
                <li>
                    <a href="{{route('formulario')}}">FORMULARIO</a>
                </li>
                <li>
                    <a href="{{route('dashboard')}}">DASHBOARD</a> <!--Esconder esto si no es admin-->
                </li>
                <li>
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section> 
            
        </section>
    </main>
</body>

</html>