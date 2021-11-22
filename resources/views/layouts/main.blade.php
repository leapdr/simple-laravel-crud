
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}'}
  </script>
  <title>{{ env('APP_NAME')  }} | {{ $title ?? '' }}</title>

  <link rel="shortcut icon" href="{{ asset('storage/SiMPLE.png') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
@guest
<body class="login-page">
  @yield('content')
</body>
@else
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

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" role="button"
            onclick="document.getElementById('logout-form').submit();">
            Logout
            <i class="ml-2 fas fa-sign-out-alt"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('storage/SiMPLE.png') }}" alt="Simple Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SiMPLE</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="">
          </div>
          <div class="info">
              <!-- @TODO change user to user name -->
            <a href="#" class="d-block">{{ auth()->user()->username }}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group">
            <input id="searchInput" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw" onclick="search()"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('/dashboard') }}" class="nav-link
                {{ request()->path() == "dashboard" ? "active" : "" }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/products') }}" class="nav-link 
                {{ ($nav_page ?? request()->path()) == "products" ? "active" : "a" }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Products
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/product/new') }}" class="nav-link 
                {{ ($nav_page ?? request()->path()) == "product/new" ? "active" : "a" }}">
                <i class="nav-icon fas fa-plus"></i>
                <p>
                  Create Product
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  
<script type="text/javascript">

  var searchInput = document.getElementById("searchInput");
  var filterProducts = document.getElementById("filter-products");

  searchInput.addEventListener("keyup", function(ev){
    if (ev.keyCode === 13) {
      event.preventDefault();
      search();
    }
  });

  if( filterProducts ){
    filterProducts.addEventListener("change", function(){
      let filter = encodeURI(this.value);
      if( filter == ''){
        window.location.href = "{{ route('products') }}";
      } else {
        window.location.href = "/products/filter/"+filter;
      }
    })
  }

  function search(){
    let keyword = $("#searchInput").val();
    keyword = encodeURI(keyword);
    window.location.href = "/products/search/"+keyword;
  }
</script> 
@endguest
</html>
