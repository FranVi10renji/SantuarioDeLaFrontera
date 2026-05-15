@if ($paginator->hasPages())
    <nav class="Paginacion-Navegacion">
        {{-- Bloque de flechas: Previous ....... Next --}}
        <div class="Paginacion-Botones">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="btn-pag-disabled">&laquo; Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn-pag-link" rel="prev">&laquo; Previous</a>
            @endif

            <span class="Paginacion-Separador">.......</span>

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn-pag-link" rel="next">Next &raquo;</a>
            @else
                <span class="btn-pag-disabled">Next &raquo;</span>
            @endif
        </div>

        {{-- Bloque de contador: 1...59 --}}
        <div class="Paginacion-Contador">
            <p>
                {{ $paginator->currentPage() }}...{{ $paginator->lastPage() }}
            </p>
        </div>
    </nav>
@endif

<style>
    /* Un poco de estilo básico para que no salga todo pegado */
    .Paginacion-Navegacion {
        text-align: center;
        margin-top: 20px;
    }
    .Paginacion-Botones {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #0A2E36
    }
    .btn-pag-link {
        color: #0A2E36;
        text-decoration: none;
    }
    .btn-pag-disabled {
        color: #cbd5e0;
    }
    .Paginacion-Contador {
        font-size: 0.9rem;
        color: #0A2E36;
    }
</style>