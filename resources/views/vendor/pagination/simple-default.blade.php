@if ($paginator->hasPages())
    <nav class="Paginacion-Navegacion">
        {{-- Bloque de botones superiores --}}
        <div class="Paginacion-Botones">
            @if ($paginator->onFirstPage())
                <p class="btn-pag-disabled">&laquo; Anterior</p>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn-pag-link" rel="prev">&laquo; Anterior</a>
            @endif

            <div class="Separador-Vacio"></div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn-pag-link" rel="next">Siguiente &raquo;</a>
            @else
                <p class="btn-pag-disabled">Siguiente &raquo;</p>
            @endif
        </div>

        {{-- Bloque de contador inferior --}}
        <div class="Paginacion-Contador">
            <div class="Contador-Flex">
                {{-- Página 1 --}}
                @if ($paginator->currentPage() == 1)
                    <p class="cont-actual">1</p>
                @else
                    <a href="{{ $paginator->url(1) }}" class="cont-link">1</a>
                @endif

                {{-- Puntos izquierda --}}
                @if ($paginator->currentPage() > 2)
                    <p class="cont-puntos">. . .</p>
                @endif

                {{-- Página Actual --}}
                @if ($paginator->currentPage() !== 1 && $paginator->currentPage() !== $paginator->lastPage())
                    <p class="cont-actual">{{ $paginator->currentPage() }}</p>
                @endif

                {{-- Puntos derecha --}}
                @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                    <p class="cont-puntos">. . .</p>
                @endif

                {{-- Última Página --}}
                @if ($paginator->lastPage() > 1)
                    @if ($paginator->currentPage() == $paginator->lastPage())
                        <p class="cont-actual">{{ $paginator->lastPage() }}</p>
                    @else
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="cont-link">{{ $paginator->lastPage() }}</a>
                    @endif
                @endif
            </div>
        </div>
    </nav>
@endif

<style>
    .Paginacion-Navegacion {
        text-align: center;
        margin-top: 20px;
        color: #0A2E36; 
    }

    .Paginacion-Botones, .Contador-Flex {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
    }

    .Paginacion-Botones p, .Paginacion-Contador p {
        margin: 0;
        padding: 0;
    }

    .Separador-Vacio {
        flex-grow: 1;
    }

    .btn-pag-link, .btn-pag-disabled, .cont-link, .cont-actual {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn-pag-link, .cont-link, .cont-puntos {
        color: #0A2E36;
    }

    .cont-actual {
        color: #0A2E36;
        border-bottom: 3px solid #0A2E36; 
        padding: 0 5px;
    }

    .btn-pag-disabled {
        color: #4A4A4A;
    }

    /* --- MODO OSCURO --- */
    body.dark-mode .Paginacion-Navegacion,
    body.dark-mode .btn-pag-link,
    body.dark-mode .cont-link,
    body.dark-mode .cont-puntos,
    body.dark-mode .cont-actual {
        color: #1CAACA !important;
    }

    body.dark-mode .cont-actual {
        border-bottom-color: #1CAACA !important;
    }

    body.dark-mode .btn-pag-disabled {
        color: #D9D9D9;
    }

    .cont-link { text-decoration: underline; }
    .cont-puntos { letter-spacing: 3px; }
</style>