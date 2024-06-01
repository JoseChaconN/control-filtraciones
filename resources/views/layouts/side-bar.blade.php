<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Tableros</div>
                <a class="nav-link" href="{{ route('dashboard.monitoring') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Monitor
                </a>
                <a class="nav-link" href="#!">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Alertas
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="{{ route('area.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-vector-square"></i></div>
                    Sectores
                </a>
                <a class="nav-link" href="{{ route('device.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-mobile-alt"></i></div>
                    Dispositivos
                </a>
                <a class="nav-link" href="{{ route('alert.index') }}">
                    <div class="sb-nav-link-icon"><i class="far fa-bell"></i></div>
                    Alertas
                </a>
                <a class="nav-link" href="#!">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Usuarios
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logeado como:</div>
            Start Bootstrap
        </div>
    </nav>
</div>