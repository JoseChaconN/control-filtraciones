<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Reportes</div>
                <a class="nav-link" href="{{ route('dashboard.monitoring') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Monitor Flujo
                </a>
                <a class="nav-link" href="{{ route('dashboard.alerts') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Alertas Flujo
                </a>
                <div class="sb-sidenav-menu-heading">Tableros</div>
                <a class="nav-link" href="{{ route('dashboard.device') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-mobile-alt"></i></div>
                    Dispositivos
                </a>
                <a class="nav-link" href="{{ route('alert.index') }}">
                    <div class="sb-nav-link-icon"><i class="far fa-bell"></i></div>
                    Alertas
                </a>
                <div class="sb-sidenav-menu-heading">Administración</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdministration" aria-expanded="false" aria-controls="collapseAdministration">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Administración
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdministration" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('area.index') }}">Sectores</a>
                        <a class="nav-link" href="{{ route('device.index') }}">Dispositivos</a>
                        <a class="nav-link" href="{{ route('alert.index') }}">Alertas</a>
                        <a class="nav-link" href="{{ route('user.index') }}">Usuarios</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logeado como:</div>
            Start Bootstrap
        </div>
    </nav>
</div>