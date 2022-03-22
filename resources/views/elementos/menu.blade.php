<!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion bg-xwork toggled text-uppercase" id="accordionSidebar">

      <!-- Sidebar - Brand -->

      <div class="pt-2 pb-1 text-center bg-white">

          <a class="img-link pb-1" href="javascript:void(0);">
              <img class="img-fluid" style="width: 55px;" alt="SIAEPUDO" src="{{ asset('storage/'.session()->get('Configuracion.Web.logo')) }}"/>
          </a>

          <a class="sidebar-brand d-flex align-items-center justify-content-center p-0 text-black sidebar-brand-menu" href="{{ route('home') }}">

            <span class="text-black">Siaep</span><span class="text-info">UDO</span>
                     
          </a>

      </div>      

      <!-- Divider -->
      <hr class="sidebar-divider mt-3">

      <!-- OPCIONES -->
      <div class="sidebar-heading mt-1 mb-1 text-white">
        Opciones
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider mt-3">

      <!-- HOME -->
      <li class="nav-item {{$pluck['NavItemActive'] == 'inicio'?'nav-item-active':''}}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <!-- HOME -->
      <li class="nav-item {{$pluck['NavItemActive'] == 'datospersonales'?'nav-item-active':''}}">
        <a class="nav-link" href="{{ route('personas.edit',[ Crypt::encrypt(isset(auth()->user()->persona->id)?auth()->user()->persona->id:-1) ])}}">
          <i class="fa fa-address-card"></i>
          <span>Mis Datos Personales</span></a>
      </li>
      <!-- FIN DE HOME -->


      <!-- HOME -->
      <li class="nav-item {{$pluck['NavItemActive'] == 'ofertaacademica'?'nav-item-active':''}}">
        <a class="nav-link" href="{{ route('nucleoprogramas.index')}}">
          <i class="fa fa-graduation-cap"></i>
          <span>Oferta Académica</span></a>
      </li>
      <!-- FIN DE HOME -->

      <?php echo session()->get('Menu');?>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
<!-- End of Sidebar -->
