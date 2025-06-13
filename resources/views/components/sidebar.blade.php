<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('AdminLTE-3.2/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: 0.8" />
    <span class="brand-text font-weight-light">{{config('app.name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('AdminLTE-3.2/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
      </div>
      <div class="info">
        <a href="#" class="d-block">{{auth()->user()->name}}</a>
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
          <a href="kategori" class="nav-link {{request()->routeIs('kategori') ? 'active' : ''}}">
            <i class="nav-icon fa fa-boxes-stacked"></i>
            <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="produk" class="nav-link {{request()->routeIs('produk') ? 'active' : ''}}">
            <i class="nav-icon fa fa-store"></i>
            <p>Produk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="supplier" class="nav-link {{request()->routeIs('supplier') ? 'active' : ''}}">
            <i class="nav-icon fa fa-truck"></i>
            <p>Supplier</p>
          </a>
        </li>

        <li class="nav-header">Transaksi</li>

        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('pengeluaran') ? 'active' : ''}}">
            <i class="nav-icon fa fa-cart-shopping"></i>
            <p>Pengeluaran</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('daftar-pembelian') ? 'active' : ''}}">
            <i class="nav-icon fa fa-file-circle-plus"></i>
            <p>Daftar Pembelian</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('transaksi-pembelian') ? 'active' : ''}}">
            <i class="nav-icon fa fa-right-to-bracket"></i>
            <p>Transaksi Pembelian</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('daftar-penjualan') ? 'active' : ''}}">
            <i class="nav-icon fa fa-file-circle-minus"></i>
            <p>Daftar Penjualan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('transaksi-penjualan') ? 'active' : ''}}">
            <i class="nav-icon fa fa-right-from-bracket"></i></i>
            <p>Transaksi Penjualan</p>
          </a>
        </li>

        <li class="nav-header">Report</li>

        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('report') ? 'active' : ''}}">
            <i class="nav-icon fa fa-clipboard"></i>
            <p>Report</p>
          </a>
        </li>

        <li class="nav-header">Pengaturan</li>

        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('user') ? 'active' : ''}}">
            <i class="nav-icon fa fa-user-cog"></i>
            <p>User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('setting') ? 'active' : ''}}">
            <i class="nav-icon fa fa-user-circle"></i>
            <p>Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{request()->routeIs('profil') ? 'active' : ''}}">
            <i class="nav-icon fa fa-gear"></i>
            <p>Profil</p>
          </a>
        </li>
        {{-- <li class="nav-item {{request()->routeIs('master-data.*') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link {{request()->routeIs('master-data.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link {{request()->routeIs('master-data.kategori.*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori</p>
              </a>
            </li>
          </ul>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>