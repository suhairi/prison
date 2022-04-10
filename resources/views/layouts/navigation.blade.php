<nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-4">

    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'root')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
              <i class="bx bxs-dashboard"> </i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.userList') }}">
                <i class='bx bxs-user-detail'> </i> 
                Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products') }}">
                <i class='bx bx-list-check'> </i> 
                Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orderedList') }}">
              <i class="bx bx-list-ol"> </i>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.usernotorderlist') }}">
              <i class="bx bx-user-x"> </i>
              Users Not Order
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bx bx-edit-alt"> </i>
                Delay Products
            </a>
          </li>
      
        </ul>
    @endif

    @if(Auth::user()->role == 'root')
      <hr />
      <div class="nav flex-column float-center"><strong><u>Root</u></strong></div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('root.resetOrder') }}">
            <i class="bx bx-reset"> </i>
            Reset Order
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('root.productOrderedReport') }}">
            <i class="bx bx-reset"> </i>
            Report - Product Ordered
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('root.perfectAmountOrdered') }}">
            <i class="bx bx-reset"> </i>
            Report - <sup>**</sup>Perfect Amount
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('root.lessAmountOrdered') }}">
            <i class="bx bx-reset"> </i>
            Report - Less Amount
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('root.overAmountOrdered') }}">
            <i class="bx bx-reset"> </i>
            Report - Over Amount
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
          <a class="nav-link" href="{{ route('user.order') }}">
              <span data-feather="file"></span>
              Order
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.ordersList') }}">
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
            <a class="nav-link" href="{{ route('hq.hqList') }}">
                <span data-feather="file"></span>
                Orders List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('hq.delayProducts') }}">
                <span data-feather="file"></span>
                Delay Products
            </a>
          </li>
                
        </ul>
    @endif

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
