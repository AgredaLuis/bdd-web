<!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion bg-xwork" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white p-5 text-black" href="{{ route('home') }}">

        <span class="text-black-50">SIAEP</span>UDO
                   
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- HOME -->
      <li class="nav-item <?php echo (Route::currentRouteName() == 'home') ? 'active' : ''; ?>">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-home"></i>
          <span>Inicio</span></a>
      </li>
      <!-- FIN DE HOME -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- OPCIONES -->
      <div class="sidebar-heading">
        Opciones
      </div>

      <!-- HOME -->
      <li class="nav-item <?php echo (Route::currentRouteName() == 'misdatos') ? 'active' : ''; ?>">
        <a class="nav-link" href="{{ route('personas.edit',[ isset(auth()->user()->persona->id)?auth()->user()->persona->id:-1 ])}}">
          <i class="fa fa-address-card"></i>
          <span>Mis Datos Personales</span></a>
      </li>
      <!-- FIN DE HOME -->

      <?php echo session()->get('Menu');?>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
<!-- End of Sidebar -->
