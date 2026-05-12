<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Dashboard o panel de administración para consultar y hacer operaciones CRUD sobre la BD">
    <meta name="keywords" content="dashboard, admin, panel de control, animal, santuario, php, mysql, base de datos">
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
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/cookies.css')}}">
    <script src="{{asset('js/cookies.js')}}"></script>
    <script src="{{asset('js/darkmode.js')}}"></script>
    <title>Dashboard</title>
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
        <div class="admin-container">
            <h1 class="text-center">Bienvenid@ al panel de administrador <br> <span>&lt;{{ $adminName }}&gt;</span></h1>

            <hr class="divisor">

            <section class="info-general">
                <h2>Información general</h2>

                <table class="tabla-estadisticas">
                    <tbody>
                        <tr>
                            <td>Animales totales en el santuario</td>
                            <td class="valor">{{ $stats['animalesTotales'] }}</td>
                        </tr>
                        <tr>
                            <td>Especie más presente</td>
                            <td class="valor">{{ $stats['especieMasPresente'] }}</td>
                        </tr>
                        <tr>
                            <td>Animal más donado</td>
                            <td class="valor">{{ $stats['animalMasDonado'] }}</td>
                        </tr>
                        <tr>
                            <td>Trabajadores totales</td>
                            <td class="valor">{{ $stats['trabajadoresTotales'] }}</td>
                        </tr>
                        <tr>
                            <td>Cantidad más alta donada</td>
                            <td class="valor">{{ $stats['cantidadMasAlta'] }} €</td>
                        </tr>
                        <tr>
                            <td>Dinero total del santuario</td>
                            <td class="valor">{{ $stats['dineroTotal'] }} €</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="info-detallada">
                <h2>Información animal</h2>

                <div class="botones-accion">
                    <button class="btn-dark">Mostrar todos los animales</button>

                    <form action="{{ route('dashboard.animal.ejemplo') }}" method="POST" style="display: inline-block;">
                        @csrf <button type="submit" class="btn-dark">Añadir animal de ejemplo <i class="fa-solid fa-circle-plus"></i></button>
                    </form>

                    <button class="btn-danger"><i class="fa-solid fa-triangle-exclamation"></i> Eliminar todo <i class="fa-solid fa-triangle-exclamation"></i></button>
                </div>

                <div class="barra-opciones">
                    <label>Ordenar por:</label>
                    <select>
                        <option>Especie</option>
                        <option>Nombre</option>
                        <option>Año</option>
                    </select>
                    <button class="btn-icon"><i class="fa-solid fa-arrow-down-z-a"></i></button>
                </div>

                <div class="tabla-responsive">
                    <table class="tabla-datos">
                        <thead>
                            <tr>
                                <th>Nombre animal</th>
                                <th>Grupo</th>
                                <th>Especie</th>
                                <th>Sexo</th>
                                <th>Año nacimiento</th>
                                <th>Tamaño</th>
                                <th>Peso</th>
                                <th>Castrado</th>
                                <th>Alimentación</th>
                                <th>ELIMINAR</th>
                                <th>ACTUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animales as $animal)
                            <tr>
                                <td>{{ $animal->nombre }}</td>
                                <td>{{ $animal->grupo }}</td>
                                <td>{{ $animal->especie }}</td>
                                <td>{{ $animal->sexo }}</td>
                                <td>{{ $animal->anno_nacimiento }}</td>
                                <td>{{ $animal->tamaño }}</td>
                                <td>{{ $animal->peso }}</td>
                                <td>{{ $animal->castrado ? 'Sí' : 'No' }}</td>
                                <td>{{ $animal->dieta }}</td>
                                <td class="td-icono"><a href="#" class="icono-eliminar"><i class="fa-solid fa-trash-can"></i></a></td>
                                <td class="td-icono"><a href="#" class="icono-editar"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="barra-opciones barra-edicion">
                    <label>Edita un campo:</label>
                    <select>
                        <option>Especie</option>
                        <option>Nombre</option>
                    </select>
                    <input type="text" placeholder="Nuevo valor">
                </div>
            </section>

            <section class="info-detallada">
                <h2>Información de personal</h2>

                <div class="botones-accion">
                    <button class="btn-dark">Mostrar todos los trabajadores</button>
                    <form action="{{ route('dashboard.trabajador.ejemplo') }}" method="POST" style="display: inline-block;">
                        @csrf <button type="submit" class="btn-dark">Añadir trabajador de ejemplo <i class="fa-solid fa-circle-plus"></i></button>
                    </form>
                    <button class="btn-danger"><i class="fa-solid fa-triangle-exclamation"></i> Eliminar todo <i class="fa-solid fa-triangle-exclamation"></i></button>
                </div>

                <div class="barra-opciones">
                    <label>Ordenar por:</label>
                    <select>
                        <option>Apellidos</option>
                        <option>Rol</option>
                    </select>
                    <button class="btn-icon"><i class="fa-solid fa-arrow-down-z-a"></i></button>
                </div>

                <div class="tabla-responsive">
                    <table class="tabla-datos">
                        <thead>
                            <tr>
                                <th>Nombre trabaj.</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>ELIMINAR</th>
                                <th>ACTUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trabajadores as $trabajador)
                            <tr>
                                <td>{{ $trabajador->nombre }}</td>
                                <td>{{ $trabajador->apellido }}</td>
                                <td>{{ $trabajador->email }}</td>
                                <td>{{ $trabajador->telefono ?? 'null' }}</td>
                                <td>{{ $trabajador->es_trabaj ? 'Admin/Voluntario' : 'Usuario' }}</td>
                                <td class="td-icono"><a href="#" class="icono-eliminar"><i class="fa-solid fa-trash-can"></i></a></td>
                                <td class="td-icono"><a href="#" class="icono-editar"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="barra-opciones barra-edicion">
                    <label>Edita un campo:</label>
                    <select>
                        <option>Rol</option>
                    </select>
                    <input type="text" placeholder="Nuevo valor">
                </div>
            </section>
        </div>
    </main>
    <footer>
        <div class="icon-box">
            <a href="instagram.com"><i class="fa-brands fa-instagram"></i>santuariodelafra_official</a>
            <a href="tiktok.com"><i class="fa-brands fa-tiktok"></i>santuariodelafra_official</a>
            <a href="tel:+34928361901"><i class="fa-solid fa-phone"></i>+34 928 36 19 01</a>
            <a href="https://www.google.com/maps/place/Campano,+11130+Chiclana+de+la+Frontera,+C%C3%A1diz/@36.3646405,-6.1404783,15.82z/data=!4m6!3m5!1s0xd0c341e1ebea4c9:0x8aa188072bec46a1!8m2!3d36.365938!4d-6.135735!16s%2Fg%2F11xdl5bwh?entry=ttu&g_ep=EgoyMDI2MDQyNi4wIKXMDSoASAFQAw%3D%3D"><i class="fa-solid fa-location-dot"></i>Chiclana (Cádiz, España)</a>
            <a href="mailto:santuariofrontera@gmail.com"><i class="fa-solid fa-envelope"></i>santuariofrontera@gmail.com</a>
        </div>
        <hr>
        <div class="bye">
            <p>Copyright &copy; 2026 Santuario de la Frontera. Todos los derechos reservados.</p>
            <p>Hecho con &#128151; por Javier Alcoba Navero - Claudia García-Matarredona Urbano - Jesús Fernández Carreño - Marcos García Bravo</p>
        </div>
    </footer>

    @if(!request()->cookie('cookies_consent'))
    <div class="cookie-banner">
        <img src="{{asset('img/cookie.png')}}" alt="Cookie con forma de corazón">
        <div class="cookie-msg">
            <p>Usamos cookies para mejorar tu experiencia</p>
            <p>Las cookies web son pequeños archivos de texto que los sitios web almacenan en el navegador del usuario para recordar información sobre su visita.</p>
            Mejoran la experiencia de navegación al recordar accesos, preferencias y carritos de compra, aunque algunas rastrean hábitos para marketing.</p>
            Se pueden gestionar desde la configuración del navegador. Santuario de la Frontera &copy no distribuye información personal a terceros ni asociados.</p>
            <div class="caja-btn-cookies">
                <button type="button" aria-label="aceptar" id="cookies-aceptar">ACEPTAR</button>
                <button type="button" aria-label="rechazar" id="cookies-rechazar">RECHAZAR</button><br>
            </div>
        </div>
    </div>
    @endif
</body>

</html>