      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <form action="logout" method="post">
              @csrf
              <button type="submit" class="btn text-danger">Logout <i class="fa-solid fa-right-from-bracket ml-2"></i></button>
            </form>
        </ul>
      </nav>
      <!-- /.navbar -->