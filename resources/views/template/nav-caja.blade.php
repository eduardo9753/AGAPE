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
                    <a class="nav-link" href="{{ route('cashier.order.index') }}"> COBRAR </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.table.index') }}"> MESAS </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.pay.index') }}">FACTURAS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.pay.boleta') }}">BOLETAS</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        GESTIÓN DELIVERY
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item current-page" href="{{ route('cashier.delibery.index') }}">
                                <span>DELIVERYS</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('cashier.delibery.order') }}">
                                <span>COBROS</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
