<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Dashboard o panel de administración para consultar y hacer operaciones CRUD sobre la BD">
    <meta name="keywords" content="dashboard, admin, panel de control, animal, santuario, php, mysql, base de datos">
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
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/cookies.css')}}">
    <!-- <script src="{{asset('js/cookies.js')}}"></script> -->
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

                    @if(request()->has('todos_animales'))
                    <a href="{{ request()->fullUrlWithoutQuery(['todos_animales']) }}" class="btn-dark">
                        Mostrar menos animales
                    </a>
                    @else
                    <a href="{{ request()->fullUrlWithQuery(['todos_animales' => 1]) }}" class="btn-dark">
                        Mostrar todos los animales
                    </a>
                    @endif

                    <form action="{{ route('dashboard.animal.ejemplo') }}" method="POST" style="display: inline-block;">
                        @csrf <button type="submit" class="btn-dark">Añadir animal de ejemplo <i class="fa-solid fa-circle-plus"></i></button>
                    </form>

                    <form action="{{ route('dashboard.animales.eliminar_todo') }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¡PELIGRO! ¿Estás absolutamente seguro de que quieres eliminar TODOS los animales? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger"><i class="fa-solid fa-triangle-exclamation"></i> Eliminar todo <i class="fa-solid fa-triangle-exclamation"></i></button>
                    </form>
                </div>

                <form action="{{ request()->url() }}" method="GET" class="barra-opciones">
                    @if(request()->has('todos_animales'))
                    <input type="hidden" name="todos_animales" value="1">
                    @endif

                    <input type="hidden" name="dir_animal" value="{{ request('dir_animal', 'asc') == 'asc' ? 'desc' : 'asc' }}">

                    <label>Ordenar por:</label>
                    <select name="orden_animal">
                        <option value="nombre" {{ request('orden_animal') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                        <option value="especie" {{ request('orden_animal') == 'especie' ? 'selected' : '' }}>Especie</option>
                        <option value="nacimiento" {{ request('orden_animal') == 'nacimiento' ? 'selected' : '' }}>Año de nacimiento</option>
                        <option value="tamaño" {{ request('orden_animal') == 'tamaño' ? 'selected' : '' }}>Tamaño</option>
                        <option value="peso" {{ request('orden_animal') == 'peso' ? 'selected' : '' }}>Peso</option>
                    </select>

                    <button type="submit" class="btn-icon">
                        @if(request('dir_animal', 'asc') == 'asc')
                        <i class="fa-solid fa-arrow-down-a-z"></i>
                        @else
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                        @endif
                    </button>
                </form>

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
                                <td>{{ $animal->nacimiento }}</td>
                                <td>{{ $animal->tamaño }}</td>
                                <td>{{ $animal->peso }}</td>
                                <td>{{ $animal->castrado ? 'Sí' : 'No' }}</td>
                                <td>{{ $animal->alimentacion }}</td>

                                <td class="td-icono">
                                    <form action="{{ route('dashboard.animal.eliminar', $animal->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar a {{ $animal->nombre }}?');">
                                        @csrf
                                        @method('DELETE') <!-- Laravel requiere esto para peticiones tipo DELETE -->
                                        <button type="submit" class="icono-eliminar" style="background: none; border: none; padding: 0; cursor: pointer; font-size: inherit;">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="td-icono">
                                    <button type="button" class="icono-editar" onclick="seleccionarAnimal({{ $animal->id }}, '{{ $animal->nombre }}')" style="background: none; border: none; cursor: pointer; font-size: inherit;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('dashboard.animal.actualizar') }}" method="POST" class="barra-opciones barra-edicion" id="form-editar-animal" enctype="multipart/form-data" style="display: none; transition: 0.3s;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="animal_id" id="edit_animal_id">

                    <label>Editando a: <strong id="edit_animal_nombre" style="color: var(--azul);">Nadie</strong></label>

                    <label style="margin-left: 15px;">Campo:</label>
                    <select name="campo" id="edit_animal_campo" onchange="cambiarInputAnimal()">
                        <option value="nombre">Nombre</option>
                        <option value="especie">Especie</option>
                        <option value="grupo">Grupo</option>
                        <option value="sexo">Sexo</option>
                        <option value="nacimiento">Año de nacimiento</option>
                        <option value="tamaño">Tamaño</option>
                        <option value="peso">Peso</option>
                        <option value="castrado">Castrado</option>
                        <option value="alimentacion">Alimentación</option>
                        <option value="imagen">Imagen</option>
                    </select>

                    <div id="contenedor_valor_animal" style="display: inline-block;">
                        <input type="text" name="valor" id="edit_animal_valor" placeholder="Nuevo valor" required>
                    </div>

                    <button type="submit" class="btn-dark" style="padding: 5px 15px; margin-left: 10px;">Guardar <i class="fa-solid fa-check"></i></button>
                </form>
            </section>

            <section class="info-detallada">
                <h2>Información de personal</h2>

                <div class="botones-accion">

                    @if(request()->has('todos_trabajadores'))
                    <a href="{{ request()->fullUrlWithoutQuery(['todos_trabajadores']) }}" class="btn-dark">
                        Mostrar menos trabajadores
                    </a>
                    @else
                    <a href="{{ request()->fullUrlWithQuery(['todos_trabajadores' => 1]) }}" class="btn-dark">
                        Mostrar todos los trabajadores
                    </a>
                    @endif

                    <form action="{{ route('dashboard.trabajador.ejemplo') }}" method="POST" style="display: inline-block;">
                        @csrf <button type="submit" class="btn-dark">Añadir trabajador de ejemplo <i class="fa-solid fa-circle-plus"></i></button>
                    </form>

                    <form action="{{ route('dashboard.trabajadores.eliminar_todo') }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¡PELIGRO! ¿Estás seguro de que quieres eliminar a TODOS los trabajadores? (Tranquilo, tu cuenta actual está protegida y no se borrará).');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger"><i class="fa-solid fa-triangle-exclamation"></i> Eliminar todo <i class="fa-solid fa-triangle-exclamation"></i></button>
                    </form>
                </div>

                <form action="{{ request()->url() }}" method="GET" class="barra-opciones">
                    @if(request()->has('todos_trabajadores'))
                    <input type="hidden" name="todos_trabajadores" value="1">
                    @endif

                    <input type="hidden" name="dir_trabajador" value="{{ request('dir_trabajador', 'asc') == 'asc' ? 'desc' : 'asc' }}">

                    <label>Ordenar por:</label>
                    <select name="orden_trabajador">
                        <option value="nombre" {{ request('orden_trabajador') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                        <option value="apellido" {{ request('orden_trabajador') == 'apellido' ? 'selected' : '' }}>Apellido</option>
                    </select>

                    <button type="submit" class="btn-icon">
                        @if(request('dir_trabajador', 'asc') == 'asc')
                        <i class="fa-solid fa-arrow-down-a-z"></i>
                        @else
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                        @endif
                    </button>
                </form>

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
                                <td>{{ $trabajador->es_trabaj ? 'Trabajador' : 'Usuario' }}</td>

                                <td class="td-icono">
                                    <form action="{{ route('dashboard.trabajador.eliminar', $trabajador->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar al trabajador {{ $trabajador->nombre }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icono-eliminar" style="background: none; border: none; padding: 0; cursor: pointer; font-size: inherit;">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="td-icono">
                                    <button type="button" class="icono-editar" onclick="seleccionarTrabajador({{ $trabajador->id }}, '{{ $trabajador->nombre }} {{ $trabajador->apellido }}')" style="background: none; border: none; cursor: pointer; font-size: inherit;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('dashboard.trabajador.actualizar') }}" method="POST" class="barra-opciones barra-edicion" id="form-editar-trabajador" style="display: none; transition: 0.3s;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="trabajador_id" id="edit_trabajador_id">

                    <label>Editando a: <strong id="edit_trabajador_nombre" style="color: var(--azul);">Nadie</strong></label>

                    <label style="margin-left: 15px;">Campo:</label>
                    <select name="campo" id="edit_trabajador_campo" onchange="cambiarInputTrabajador()">
                        <option value="nombre">Nombre</option>
                        <option value="apellido">Apellidos</option>
                        <option value="email">Email</option>
                        <option value="telefono">Teléfono</option>
                        <option value="es_trabaj">Rol (Trabajador)</option>
                    </select>

                    <div id="contenedor_valor_trabajador" style="display: inline-block;">
                        <input type="text" name="valor" id="edit_trabajador_valor" placeholder="Nuevo valor" required>
                    </div>

                    <button type="submit" class="btn-dark" style="padding: 5px 15px; margin-left: 10px;">Guardar <i class="fa-solid fa-check"></i></button>
                </form>
            </section>

            <h1 style="text-align: center; margin-top: 100px; margin-bottom: 60px;">Estadísticas del Santuario</h1>

            <div style="width: 80%; margin: 0 auto; padding: 20px; background: transparent; margin-bottom: 30px;">
                <h3 style="text-align: center; color: #555; margin-bottom: 30px;">Atributos de los Animales</h3>
                <canvas id="chartAtributos" height="80"></canvas>
            </div>

            <div style="display: flex; justify-content: space-around; width: 90%; margin: 0 auto 50px auto; gap: 20px;">
                <div style="width: 45%; padding: 20px; background: transparent;">
                    <h3 style="text-align: center; color: #555; margin-bottom: 30px;">Clasificación por sexo</h3>
                    <canvas id="chartSexo"></canvas>
                </div>
                <div style="width: 45%; padding: 20px; background: transparent;">
                    <h3 style="text-align: center; color: #555; margin-bottom: 30px;">Tipos de animales</h3>
                    <canvas id="chartEspecies"></canvas>
                </div>
            </div>
        </div>
    </main>
    <!-- <footer>
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
    </footer> -->

    <!-- @if(!request()->cookie('cookies_consent'))
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
    @endif -->

    <script>
        //script para la edicion de animales
        //Cuando hacen clic en el lápiz con animal
        function seleccionarAnimal(id, nombre) {
            document.getElementById('form-editar-animal').style.display = 'inline-flex';

            document.getElementById('edit_animal_id').value = id;
            document.getElementById('edit_animal_nombre').innerText = nombre;

            cambiarInputAnimal();
        }

        //Lógica para animal
        function cambiarInputAnimal() {
            const campo = document.getElementById('edit_animal_campo').value;
            const contenedor = document.getElementById('contenedor_valor_animal');
            let html = '';

            if (campo === 'sexo') {
                html = `<select name="valor" required>
                            <option value="H">Hembra</option>
                            <option value="M">Macho</option>
                        </select>`;
            } else if (campo === 'castrado') {
                html = `<select name="valor" required>
                            <option value="1">Sí (1)</option>
                            <option value="0">No (0)</option>
                        </select>`;
            } else if (campo === 'grupo') {
                html = `<select name="valor" required>
                            <option value="Mamífero">Mamífero</option>
                            <option value="Ave">Ave</option>
                            <option value="Reptil">Reptil</option>
                            <option value="Anfibio">Anfibio</option>
                        </select>`;
            } else if (campo === 'alimentacion') {
                html = `<select name="valor" required>
                            <option value="Carnívoro">Carnívoro</option>
                            <option value="Herbívoro">Herbívoro</option>
                            <option value="Omnívoro">Omnívoro</option>
                            <option value="Insectívoro">Insectívoro</option>
                        </select>`;
            } else if (campo === 'nacimiento' || campo === 'tamaño' || campo === 'peso') {
                html = `<input type="number" step="0.01" name="valor" placeholder="Valor numérico" required>`;
            } else if (campo === 'imagen'){
                html = `<input type="file" name="valor" id="imagen" accept="image/*" required>`;
            } else {
                html = `<input type="text" name="valor" placeholder="Nuevo valor" required>`;
            }

            contenedor.innerHTML = html;
        }

        //Cuando hacen clic en el lápiz del trabajador
        function seleccionarTrabajador(id, nombreCompleto) {
            document.getElementById('form-editar-trabajador').style.display = 'inline-flex';
            document.getElementById('edit_trabajador_id').value = id;
            document.getElementById('edit_trabajador_nombre').innerText = nombreCompleto;
            cambiarInputTrabajador();
        }

        //Lógica para trabajador
        function cambiarInputTrabajador() {
            const campo = document.getElementById('edit_trabajador_campo').value;
            const contenedor = document.getElementById('contenedor_valor_trabajador');
            let html = '';

            if (campo === 'es_trabaj') {
                html = `<select name="valor" required>
                            <option value="1">Trabajador (Sí)</option>
                            <option value="0">Usuario normal (No)</option>
                        </select>`;
            } else if (campo === 'email') {
                html = `<input type="email" name="valor" placeholder="correo@ejemplo.com" required>`;
            } else if (campo === 'telefono') {
                html = `<input type="tel" name="valor" placeholder="Ej: 600123456" required>`;
            } else {
                html = `<input type="text" name="valor" placeholder="Nuevo valor" required>`;
            }

            contenedor.innerHTML = html;
        }
    </script>

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

    <script>
        //Scrip para graficas
        const datosSexo = @json($graficaSexo);
        const datosEspecies = @json($graficaEspecies);
        const datosRasgos = @json($graficaRasgos);

        //Gráfica de atributos
        new Chart(document.getElementById('chartAtributos'), {
            type: 'bar',
            data: {
                labels: Object.keys(datosRasgos),
                datasets: [{
                    label: 'Cantidad',
                    data: Object.values(datosRasgos),
                    backgroundColor: '#8b7cf6',
                    borderRadius: 20,
                    borderSkipped: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        //Gráfica de sexos 
        new Chart(document.getElementById('chartSexo'), {
            type: 'pie',
            data: {
                labels: Object.keys(datosSexo),
                datasets: [{
                    data: Object.values(datosSexo),
                    backgroundColor: ['#ff9999', '#8b7cf6', '#66b3ff'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        //Gráfica de especies
        new Chart(document.getElementById('chartEspecies'), {
            type: 'pie',
            data: {
                labels: Object.keys(datosEspecies),
                datasets: [{
                    data: Object.values(datosEspecies),
                    backgroundColor: ['#8b7cf6', '#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

</body>

</html>