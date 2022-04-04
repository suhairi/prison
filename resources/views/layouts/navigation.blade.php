<nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-4">



    @if(Auth::user()->role == 'admin')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
              <i class="bx bxs-dashboard"> </i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">            
            <a class="nav-link" href="{{ route('admin.register') }}">      
              <i class='bx bx-user-plus' animation="flip"> </i>          
              User Register
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.userList') }}">
                <i class='bx bxs-user-detail'> </i> 
                Users List.
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.registerproducts') }}">
              <i class='bx bx-qr-scan'> </i> 
                Product Register..
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products') }}">
                <i class='bx bx-list-check'> </i> 
                Products Lists
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.usernotorderlist') }}">
              <i class="bx bx-user-x"> </i>
              Users Not Order
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orderedList') }}">
              <i class="bx bx-list-ol"> </i>
              Ordered List
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
          </li><li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.order') }}">
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
                Order List
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

<!--     
    <hr />
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
    </ul> -->

    <hr />

    <ul class="nav flex-column mb-2>
      <li class="nav-item">

        <form method="POST" action="{{ route('logout') }}" id="logout-form">
          @csrf          
        </form>
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bx bx-log-out-circle"> </i>
            Logout
        </a>
      </li>
    </ul>
  </div>
</nav>
