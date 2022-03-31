<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">    

    @if(Auth::user()->role == 'admin')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.register') }}">
                <span data-feather="user-plus"></span>
                User Register
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.userList') }}">
                <span data-feather="users"></span>
                Users List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.registerproducts') }}">
                <span data-feather="file-plus"></span>
                Product Register
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products') }}">
                <span data-feather="tablet"></span>
                Products Lists
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Reports
            </a>
          </li>
        </ul>
    @endif

    @if(Auth::user()->role == 'user')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Order
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Orders List
            </a>
          </li>
        </ul>
    @endif

    @if(Auth::user()->role == 'hq')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Order
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Orders List
            </a>
          </li>         
        </ul>
    @endif

    

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Saved reports</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Current month
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Last quarter
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Social engagement
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Year-end sale
        </a>
      </li>
    </ul>

    <ul class="nav flex-column mb-2>
    <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="log-out"></span>
          Sign Out
        </a>
      </li>
    </ul>
  </div>
</nav>
