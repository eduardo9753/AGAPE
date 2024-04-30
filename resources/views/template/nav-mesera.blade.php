<nav class="navbar navbar-expand-lg p-0">
    <div class="container">
        <div class="offcanvas offcanvas-end" id="MobileMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title semibold">Navegación</h5>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="offcanvas">
                    <i class="icon-clear"></i>
                </button>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('waitress.table.index') }}"> MESAS </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('waitress.order.list') }}"> TUS ORDENES </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> {{ auth()->user()->name }} </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
