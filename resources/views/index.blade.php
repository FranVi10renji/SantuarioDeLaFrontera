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
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/cookies.css')}}">
    <script src="{{asset('js/cookies.js')}}"></script>
    <script src="{{asset('js/darkmode.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="{{ asset('js/filtros.js') }}"></script> -->
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
                    @if(auth()->check())
                    <a href="{{route('formulario')}}">FORMULARIO</a>
                    @else
                    <a href="{{route('formularioLogin')}}">FORMULARIO</a>
                    @endif
                </li>
                @auth <!--Si está autenticado-->
                @if(auth()->user()->id == 0) <!--Se muestra si es admin-->
                <li>
                    <a href="{{ route('dashboard') }}">DASHBOARD</a>
                </li>
                @endif
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        CERRAR SESIÓN
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @else <!--Si NO está autenticado-->
                <li>
                    <a href="{{ route('formularioLogin') }}">INICIAR SESIÓN</a>
                </li>
                @endauth
                <li>
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="Titulo">
            <h1> SANTUARIO DE LA FRONTERA </h1>
        </section>

        <section class="Intro">
            <h2> ¿Quiénes somos? </h2>
            <div class="Sipnosis">
                <div class="Sipnosis_izq">
                    <p>Somos un equipo apasionado de profesionales y voluntarios dedicados al rescate, rehabilitación y protección de animales en situación de vulnerabilidad. Ubicados en el corazón de Campano, Chiclana de la Frontera. Santuario de la Frontera nace no solo como un refugio físico, sino como un hogar donde cada especie recibe una segunda oportunidad. Creemos firmemente que cada animal merece vivir con dignidad, respeto y los cuidados veterinarios necesarios para su pleno desarrollo.</p>
                </div>
                <div class="Sipnosis_der">
                    <img src="{{asset('img/caballos.jpg')}}" alt="Lémur">
                </div>
            </div>
            <h2> Nuestra misión </h2>
            <div class="Mision">
                <div class="Mision_izq">
                    <img src="{{asset('img/geco.jpg')}}" alt="Cocodrilo">
                </div>
                <div class="Mision_der">
                    <p>Nuestra misión es transformar la realidad de los animales desprotegidos mediante la intervención directa y la concienciación social. Nos enfocamos en el rescate ético, la búsqueda de hogares responsables a través de la adopción y la gestión transparente de recursos y donaciones. Queremos ser un referente de bienestar animal en Andalucía, fomentando una comunidad donde el voluntariado y la educación sean los pilares para erradicar el abandono y el maltrato.</p>
                    @if(!auth()->check() || (auth()->user()?->id != 0 && auth()->user()?->es_trabaj == 0))
                    <div class="Ayuda"> <!--Esto sólo le puede salir a un usuario normal-->
                        <div class="Ayuda_izq">
                            ¿Nos quieres ayudar?
                        </div>
                        @if(auth()->check())
                        <div class="Ayuda_der">
                            <a href="{{route('formulario')}}"><button class="btn-formulario">Apúntate como voluntario</button></a>
                        </div>
                        @else
                        <div class="Ayuda_der">
                            <a href="{{route('formularioLogin')}}"><button class="btn-formulario">Apúntate como voluntario</button></a>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="Estadisticas">
                <div class="Estadistica-item">
                    <i class="fas fa-paw"></i>
                    <h3>150+</h3>
                    <p>Animales protegidos</p>
                </div>

                <div class="Estadistica-item">
                    <i class="fas fa-user"></i>
                    <h3>50+</h3>
                    <p>Trabajadores voluntarios</p>
                </div>

                <div class="Estadistica-item">
                    <i class="fas fa-shield-alt"></i>
                    <h3>100000+</h3>
                    <p>donaciones para mejorar su vida</p>
                </div>
            </div>
            @auth <!--Si está autenticado-->
            @if(auth()->check() && auth()->user()->id == 0) <!--Se muestra si es admin-->
            <div class="Boton-container"> <a href="{{ route('dashboard') }}">
                    <button class="btn-stats">Consulta todas las estadísticas</button>
                </a>
            </div>
            @endif
            @endauth
        </section>

        <section class="Animales">
            <h2>CONOCE A NUESTROS ANIMALES</h2>

            <div class="Opciones">
                <div class="Card-Info">
                    <i class="fas fa-hand-holding-heart"></i>
                    <p><strong>Puedes donar cualquier cantidad a tantos animales como desees</strong></p>
                    <p>¡Ayúdanos a mantener su vida!</p>
                </div>
                <div class="Card-Info">
                    <i class="fas fa-home"></i>
                    <p><strong>¿Te interesa adoptar?</strong></p>
                    <p>Nuestros animales necesitan un hogar</p>
                    <p>Ofrecemos <strong>perros, gatos</strong> y <strong>conejos</strong></p>
                </div>
            </div>

            <form action="{{ request()->url() }}" method="GET" class="barra-opciones" style="display: flex; align-items: center; gap: 10px;">
                <input type="hidden" name="dir_animal" value="{{ request('dir_animal', 'asc') == 'asc' ? 'desc' : 'asc' }}">

                <div class="Barra-Busqueda">

                    <label for="orden_animal" style="margin-right: 10px; font-weight: bold;">Ordenar por:</label>

                    {{-- Select con los nombres reales de tu base de datos --}}
                    <select name="orden_animal">
                        <option value="nombre" {{ request('orden_animal') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                        <option value="especie" {{ request('orden_animal') == 'especie' ? 'selected' : '' }}>Especie</option>
                        <option value="grupo" {{ request('orden_animal') == 'grupo' ? 'selected' : '' }}>Grupo</option>
                        <option value="nacimiento" {{ request('orden_animal') == 'nacimiento' ? 'selected' : '' }}>Nacimiento</option>
                        <option value="sexo" {{ request('orden_animal') == 'sexo' ? 'selected' : '' }}>Sexo</option>
                        <option value="tamano" {{ request('orden_animal') == 'tamano' ? 'selected' : '' }}>Tamaño</option>
                        <option value="alimentacion" {{ request('orden_animal') == 'alimentacion' ? 'selected' : '' }}>Alimentación</option>
                    </select>

                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="Grid-Animales">
                @foreach ($animales as $animal)
                <div class="Animal-Card">
                    <!--Versión dinámica-->
                    <div class="Card-Imagen">
                        @if (empty($animal->imagen))
                        <img src="{{ asset('img/animals/default-animal.png') }}" alt="Imagen por defecto">
                        @else
                        <img src="{{ asset('storage/' . $animal->imagen) }}" alt="{{ 'Foto de ' . $animal->nombre }}">
                        @endif

                        @php $esHembra = strtolower($animal->sexo) == 'h'; @endphp
                        <span class="Icono-Sexo {{ $esHembra ? 'hembra' : 'macho' }}">
                            <i class="fas fa-{{ $esHembra ? 'venus' : 'mars' }}"></i>
                        </span>
                    </div>

                    <div class="Card-Detalles">
                        <h3 class="Nombre-Animal">{{ strtoupper($animal->nombre) }}</h3>

                        <div class="Atributos-Lista">
                            <p><strong>Especie:</strong> {{ $animal->especie }}</p>
                            <p><strong>Grupo:</strong> {{ $animal->grupo }}</p>
                            <p><strong>Año de nacimiento:</strong> {{ $animal->nacimiento }}</p>
                            <p><strong>Peso:</strong> {{ $animal->peso }} kg</p>
                            <p><strong>Tamaño:</strong> {{ $animal->tamaño }}</p>
                        </div>

                        <div class="Botones-Grupo">
                            <form action="{{ route('animal.apadrinar', $animal->id) }}" method="POST">
                                @csrf

                                <button type="submit" class="btn-apadriname">
                                    APADRÍNAME <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>

                            @php
                            $adoptables = ['perro', 'gato', 'conejo'];
                            @endphp

                            @if(in_array(strtolower($animal->especie), $adoptables))
                            <form action="{{ route('animal.adoptar', $animal->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-adoptar">
                                    ADÓPTAME <i class="fas fa-heart"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="Paginacion-Contenedor">
                {{ $animales->links('vendor.pagination.simple-default') }}
            </div>
        </section>

        <section class="Mapa">
            <h2>
                ¿Quieres conocernos más de cerca?
            </h2>
            <h2>
                ¡Visítanos en Campano, Chiclana de la Frontera!
            </h2>
            <div class="Foto-mapa">
                <img src="{{asset('img/mapa.png')}}" alt="Ubicación del santuario">
            </div>
        </section>
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

    <script>
        //Script para mantener la posición de scroll al actualizar la página o hacer una acción
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                localStorage.removeItem('scrollpos');
            }
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

    @if(session('deleted'))
    <script>
        Swal.fire({
            title: "Adoptado",
            text: "¡Tu nuevo compañero de vida ha sido adoptado!",
            icon: "success"
        });
    </script>
    @endif
    @if(session('apadrinado'))
    <script>
        Swal.fire({
            title: "Animal apadrinado",
            text: "{{ session('apadrinado') }}",
            icon: "success"
        });
    </script>
    @endif
</body>

</html>