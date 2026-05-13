<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Formulario de inserción de animales en el sistema">
    <meta name="keywords" content="formulario, animal, santuario, php, mysql, base de datos">
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
    <link rel="stylesheet" href="{{asset('css/formulario.css')}}">
    <link rel="stylesheet" href="{{asset('css/cookies.css')}}">
    <script src="{{asset('js/cookies.js')}}"></script>
    <script src="{{asset('js/darkmode.js')}}"></script>
    <title>Formulario</title>
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
        <section class="seccion-hero">
            <h1>¿Quieres trabajar con nosotros?</h1>
            <div class="trabajo-hero">
                <div class="trabajo-izq">
                    <form action="{{route('subirvoluntario')}}" method="post" class="trabajo-form">
                        @csrf
                        <div class="rowlabelinput">
                            <div class="labelinput">
                                <label for="nombre">Nombre (*):</label>
                                <input type="text" aria-label="nombre de usuario" name="nombre" required>
                            </div>
                            <div class="labelinput">
                                <label for="apellidos">Apellidos (*):</label>
                                <input type="text" id="apellidos" aria-label="apellidos del usuario" name="apellidos" required><br>
                            </div>
                        </div>
                        <div class="rowlabelinput">
                            <div class="labelinput">
                                <label for="email">Email (*):</label>
                                <input type="email" id="email" aria-label="email de usuario" name="email" required>
                            </div>
                            <div class="labelinput">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" id="telefono" aria-label="teléfono del usuario" name="telefono" maxlength="9"><br>
                            </div>
                        </div>
                        <label for="mensaje">¿Por qué quieres trabajar con nosotros?</label>
                        <textarea name="mensaje" id="mensaje" aria-multiline="true" minlength="0" maxlength="200" rows="5" cols="50" placeholder="Me gustaría trabajar aquí porque..."></textarea><br>
                        <div class="caja-btn">
                            <button type="submit" aria-label="enviar formulario"><i class="fa-solid fa-paper-plane"></i>ENVIAR</button>
                            <button type="reset" aria-label="limpiar formulario"><i class="fa-solid fa-eraser"></i>LIMPIAR</button><br>
                        </div>
                    </form>
                </div>
                <div class="trabajo-der">
                    <img src="{{asset('img/chica.jpg')}}" alt="nuestros voluntarios">
                </div>
            </div>
        </section>
        <section class="seccion-animal">
            <h2>Hola nombre de usuario</h2> <!--Cambiar cuando se sepa la implementación de los roles trabajador/admin-->
            <div class="msg">
                <h3>Estamos deseando ampliar...</h3>
                <h3>¿Nos ayudas?</h3>
            </div>
            <div class="caja-form">
                <div>
                    <h4>Completa el formulario</h4>
                    <h4>Para añadir un nuevo amigo</h4>
                </div>
                <div>
                    <form action="{{route('subiranimal')}}" method="post" class="animal-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-part1-wrapper">
                            <div class="form-part1">
                                <div class="rowlabelinput">
                                    <div class="labelinput">
                                        <label for="nombre">Nombre (*):</label>
                                        <input type="text" aria-label="nombre del animal" name="nombre" placeholder="Melocotón" required>
                                    </div>
                                    <div class="labelinput">
                                        <label for="grupo">Grupo (*):</label>
                                        <select name="grupo" id="grupo" aria-label="grupo al que pertenece el animal" required>
                                            <option value="">Selecciona un grupo</option>
                                            <option value="mamífero">Mamífero</option>
                                            <option value="ave">Ave</option>
                                            <option value="reptil">Reptil</option>
                                            <option value="anfibio">Anfibio</option>
                                        </select>
                                    </div>
                                    <div class="labelinput">
                                        <label for="especie">Especie (*):</label>
                                        <input type="text" id="especie" aria-label="especie del animal" name="especie" placeholder="Perro" required><br>
                                    </div>
                                </div>
                                <div class="rowlabelinput">
                                    <div class="labelinput">
                                        <label for="nacimiento">Año de nacimiento (*):</label>
                                        <input type="number" id="nacimiento" aria-label="año de nacimiento del animal" name="nacimiento" min="1970" max="2026" step="1" placeholder="2004" required>
                                    </div>
                                    <div class="rowlabelinput radios">
                                        <label for="sexo">Sexo (*):</label><br>
                                        <div class="opciones">
                                            <label for="sexo">Macho:</label>
                                            <input type="radio" aria-label="sexo del animal" name="sexo" value="M" required>
                                            <label for="sexo">Hembra:</label>
                                            <input type="radio" aria-label="sexo del animal" name="sexo" value="H">
                                        </div>
                                    </div>
                                    <div class="labelinput">
                                        <label for="tamaño">Tamaño (en m) (*):</label>
                                        <input type="number" id="tamaño" aria-label="tamaño del animal en metros" name="tamaño" min="0.01" step="0.01" placeholder="2.67" required><br>
                                    </div>
                                </div>
                                <div class="rowlabelinput">
                                    <div class="labelinput">
                                        <label for="peso">Peso estimado (en kg) (*)</label>
                                        <input type="number" id="peso" aria-label="peso del animal estimado en kilos" name="peso" min="0.01" step="0.01" placeholder="10.02" required>
                                    </div>
                                    <div class="rowlabelinput radios">
                                        <label for="castrado">Castrado (*):</label>
                                        <div class="opciones">
                                            <label for="castrado">Sí:</label>
                                            <input type="radio" aria-label="el animal está castrado" name="castrado" value="1" required>
                                            <label for="castrado">No:</label>
                                            <input type="radio" aria-label="el animal está castrado" name="castrado" value="0">
                                        </div>
                                    </div>
                                    <div class="labelinput">
                                        <label for="alimentacion">Alimentación (*):</label>
                                        <select name="alimentacion" id="alimentacion" aria-label="alimentación del animal" required>
                                            <option value="">Selecciona su alimentación</option>
                                            <option value="Carnívoro">Carnívoro</option>
                                            <option value="Herbívoro">Herbívoro</option>
                                            <option value="Omnivoro">Omnívoro</option>
                                            <option value="Insectivoro">Insectívoro</option>
                                        </select><br>
                                    </div>
                                </div>
                                <div class="rowlabelinput">
                                    <div class="labelinput">
                                        <label for="imagen">¿Existe alguna imagen del animal?</label>
                                        <input type="file" aria-label="archivo de imagen del animal" enctype="multipart/form-data" name="imagen" id="imagen" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="algomas">
                            <h4>¿Algo más que debamos tener en cuenta?</h4>
                        </div>
                        <div class="form-part2">
                            <div class="form-part2-left">
                                <p>Rasgos y atributos</p>
                                <div class="checkbox-container">
                                    <div class="checkbox-row">
                                        <label for="docil">Dócil</label>
                                        <input type="checkbox" id="docil" name="atributos[]" value="docil" aria-label="atributo dócil">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="territorial">Territorial</label>
                                        <input type="checkbox" id="territorial" name="atributos[]" value="territorial" aria-label="atributo territorial">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="nocturno">Nocturno</label>
                                        <input type="checkbox" id="nocturno" name="atributos[]" value="nocturno" aria-label="atributo nocturno">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="sociable">Sociable</label>
                                        <input type="checkbox" id="sociable" name="atributos[]" value="sociable" aria-label="atributo sociable">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="acuatico">Acuático</label>
                                        <input type="checkbox" id="acuatico" name="atributos[]" value="acuatico" aria-label="atributo acuático">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="vuela">Vuela</label>
                                        <input type="checkbox" id="vuela" name="atributos[]" value="vuela" aria-label="atributo vuela">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="cuidados">Cuidados especiales</label>
                                        <input type="checkbox" id="cuidados" name="atributos[]" value="cuidadosespeciales" aria-label="atributo cuidados especiales">
                                    </div>

                                    <div class="checkbox-row">
                                        <label for="habitat">Hábitat especial</label>
                                        <input type="checkbox" id="habitat" name="atributos[]" value="habitatespecial" aria-label="atributo hábitat especial">
                                    </div>
                                </div>

                                <div class="caja-btn" id="caja-btn-form-animal">
                                    <button type="submit" aria-label="enviar formulario"><i class="fa-solid fa-paper-plane"></i>ENVIAR</button>
                                    <button type="reset" aria-label="limpiar formulario"><i class="fa-solid fa-eraser"></i>LIMPIAR</button><br>
                                </div>
                            </div>

                            <div class="form-part2-right">
                                <img src="{{asset('img/gato.png')}}" alt="gato curioso mirando al usuario">
                            </div>
                        </div>
                    </form>
                </div>
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
</body>

</html>