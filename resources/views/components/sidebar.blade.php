<!-- Main Sidebar Container -->
<aside class=" main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <img src="{{asset('AdminLTE-3.2/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: 0.8" />
    <span class="brand-text font-weight-light">{{config('app.name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('storage/foto_user/' . auth()->user()->foto) }}" class="img-circle" alt="User Image" />
      </div>
      <div class="info">
        {{-- d-flex --}}
        <a href="/profil" class=""><strong>{{auth()->user()->name}}</strong> 
          <p class=" badge {{auth()->user()->level ? 'badge-warning' : 'badge-info'}}">
            {{auth()->user()->level ? 'Kasir' : 'Admin'}}</p>
        </a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{request()->routeIs('dashboard') ? 'active' : ''}}">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">MASTER</li>

        <li class="nav-item">
          <a href="/kategori" class="nav-link {{request()->routeIs('kategori') ? 'active' : ''}}">
            <i class="nav-icon fa fa-boxes-stacked"></i>
            <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/produk" class="nav-link {{request()->routeIs('produk') ? 'active' : ''}}">
            <i class="nav-icon fa fa-store"></i>
            <p>Produk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/supplier" class="nav-link {{request()->routeIs('supplier') ? 'active' : ''}}">
            <i class="nav-icon fa fa-truck"></i>
            <p>Supplier</p>
          </a>
        </li>

        <li class="nav-header">TRANSAKSI</li>

        <li class="nav-item">
          <a href="/barang-masuk" class="nav-link {{request()->routeIs('barang-masuk.*') ? 'active' : ''}}">
            <i class="nav-icon fa fa-cart-shopping"></i>
            <p>Barang Masuk</p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="/kasir" class="nav-link {{request()->routeIs('kasir.*') ? 'active' : ''}}">
            <i class="nav-icon fa fa-cash-register"></i>
            <p>Kasir</p>
          </a>
        </li>
        
        <li class="nav-header">REPORT</li>
        
        <li class="nav-item">
          <a href="/laporan-pembelian" class="nav-link {{request()->routeIs('laporan-pembelian.*') ? 'active' : ''}}">
            <i class="nav-icon fa fa-file-invoice"></i>
            <p>Laporan Pembelian</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/laporan-penjualan" class="nav-link {{request()->routeIs('laporan-penjualan.*') ? 'active' : ''}}">
            <i class="nav-icon fa fa-file-invoice-dollar"></i>
            <p>Laporan Penjualan</p>
          </a>
        </li>
        
        <li class="nav-header">PENGATURAN</li>

        @if(auth()->user()->level == 0)
        <li class="nav-item">
          <a href="/users" class="nav-link {{request()->routeIs('users') ? 'active' : ''}}">
            <i class="nav-icon fa fa-user-cog"></i>
            <p>Users</p>
          </a>
        </li>
        @endif
        
        <li class="nav-item">
          <a href="/profil" class="nav-link {{request()->routeIs('profil') ? 'active' : ''}}">
            <i class="nav-icon fa fa-user-circle"></i>
            <p>Profil</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>