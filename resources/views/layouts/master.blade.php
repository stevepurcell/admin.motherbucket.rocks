
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_NAME') }} -- Admin</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <a href="index3.html" class="brand-link">
      <div class="circle brand-image img-circle elevation-3" style="opacity: .8""><p class="circle-inner">BM</p></div>
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/contacts" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Contacts</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/songs" class="nav-link">
              <i class="nav-icon fa fa-music"></i>
              <p>Songs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/setlistgroups" class="nav-link">
              <i class="nav-icon far fa-clone"></i>
              <p>Setlists</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/songs" class="nav-link">
              <i class="nav-icon fas fa-guitar"></i>
              <p>Gigs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="setlistgroups" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Gear</p>
            </a>
          </li>
          @if(Auth::user()->is_admin )
          <li class="nav-item border-secondary border-top">
            <a href="/users" class="nav-link">
              <i class="nav-icon  fas fa-users"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Maintenance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/users" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/contact-types" class="nav-link">
                  <i class="fas fa-id-card nav-icon"></i>
                  <p>Contact Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/status-types" class="nav-link">
                  <i class="fas fa-clipboard-check nav-icon"></i>
                  <p>Status Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Something Else</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item border-secondary border-top">
            <a href="/profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('logout') }}" class="nav-link"
                onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="nav-icon fas fa-sign-out-alt"></i>
                      {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">

      <div class="c-body">
        
        <main class="c-main">
          @include('partials.alerts')
          @yield('content')
        </main>
    </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> {{ env('APP_VERSION') }} 
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="http://stevepurcell.rocks">SP Entertainment</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}"></script>
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</body>
</html>
