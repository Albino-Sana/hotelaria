<div class="min-height-300 bg-dark position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
      <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">DAT Hotelaria</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto  h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="../pages/dashboard.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('funcionarios.index') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <!-- Ícone atualizado para representar funcionários -->
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Funcionários</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('cargos.index') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-badge text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Cargos</span>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="quartosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-building text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Quartos</span>
          <i class="fas fa-caret-down ms-2"></i>
        </a>

          <ul class="dropdown-menu" aria-labelledby="quartosDropdown" style="position: absolute;">
            <li><a class="dropdown-item" href="{{ route('tipos-quartos.index') }}">Gerir Tipos de Quartos</a></li>
            <li><a class="dropdown-item" href="{{ route('quartos.index') }}">Gerir Quartos</a></li>
          </ul>
    
      </li>



      <li class="nav-item">
        <a class="nav-link" href="{{ route('reservas.index') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Reservas</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../pages/profile.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../pages/sign-in.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Sign In</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../pages/sign-up.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-collection text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Sign Up</span>
        </a>
      </li>
    </ul>
  </div>

</aside>




