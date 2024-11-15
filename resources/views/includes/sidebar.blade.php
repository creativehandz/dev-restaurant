<aside id="sidebar" class="u-sidebar">
  <div class="u-sidebar-inner pl-0 pr-0 pt-5">
    <header class="u-sidebar-header">
      <a class="u-sidebar-logo" href="index.html">
        <img class="img-fluid" src="{{ asset('/img/main-logo-two.png') }}" width="80" alt="Stream Dashboard">
      </a>
    </header>
    <nav class="u-sidebar-nav pr-4 pl-0">
      <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
        <!-- Dashboard -->
        <li class="u-sidebar-nav-menu__item">
          <a class="u-sidebar-nav-menu__link {{ request()->is('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/avatars/dashboard.svg') }}" alt="" class="u-sidebar-icon" width="160"> 
            <span class="u-sidebar-nav-menu__item-title">Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard -->
        <!-- <li class="u-sidebar-nav-menu__item "><a class="u-sidebar-nav-menu__link" href="{{route('reservation-list')}}"><img src="{{asset('img/dashboard-icon-v1.jpeg')}}" alt="" class="u-sidebar-icon"><span class="u-sidebar-nav-menu__item-title">Bookings</span></a></li><li class="u-sidebar-nav-menu__item"><a class="u-sidebar-nav-menu__link" href="{{route('customers-list')}}"><img src="{{asset('img/dashboard-icon-v1.jpeg')}}" alt="" class="u-sidebar-icon"><span class="u-sidebar-nav-menu__item-title">Customers</span></a></li>-->
        <li class="u-sidebar-nav-menu__item">
          <a class="u-sidebar-nav-menu__link {{ request()->is('reservation-list*') ? 'active' : ''}}" href="{{ route('reservation-list') }}">
            <img src="{{ asset('img/bookings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Reservation</span>
          </a>
        </li>
        <li class="u-sidebar-nav-menu__item ">
          <a class="u-sidebar-nav-menu__link " href="{{ route('calendar') }}">
            <img src="{{ asset('img/dashboard-icon-v1.jpeg') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Calendar</span>
          </a>
        </li>
        <li class="u-sidebar-nav-menu__item ">
          <a class="u-sidebar-nav-menu__link {{ request()->is('customers-list') ? 'active' : ''}}" href="{{ route('customers-list') }}">
            <img src="{{ asset('img/customer.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Customers</span>
          </a>
        </li>
        <li class="u-sidebar-nav-menu__item ">
          <a class="u-sidebar-nav-menu__link " href="{{ route('analytics') }}">
            <img src="{{ asset('img/analytics.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Analytics</span>
          </a>
        </li>
        
        
        
      </ul>
    </nav>
    <nav class="u-sidebar-nav border-top mt-5 pt-3 border-dark" >
    <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
    <li class="u-sidebar-nav-menu__item ">
          <a class="u-sidebar-nav-menu__link {{ request()->is('set-list') ? 'active' : ''}}" href="{{ route('set-list') }}">
            <img src="{{ asset('img/settings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Settings</span>
          </a>
        </li>
        <li>
          <a class="u-sidebar-nav-menu__link" href="{{ route('reviews.index') }}" >
            <img src="{{ asset('img/settings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Google Review</span>
          </a>
      </li>
      <li>
          <a class="u-sidebar-nav-menu__link" href="{{ route('trip-advisor') }}" >
            <img src="{{ asset('img/settings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Trip Advisor</span>
          </a>
      </li>
      <li>
          <a class="u-sidebar-nav-menu__link" href="{{ route('whatsapp') }}" >
            <img src="{{ asset('img/settings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Whatsapp</span>
          </a>
      </li>
      </ul>
</nav>
      <nav class="u-sidebar-nav border-top mt-5 pt-3 border-dark" >
      <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
        <!-- Category Setup -->
        <li class="u-sidebar-nav-menu__item ">
          <a class="u-sidebar-nav-menu__link" href="#" data-toggle="collapse" data-target="#category-setup-menu" aria-expanded="false" aria-controls="category-setup-menu">
            <img src="{{ asset('img/settings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Category Setup</span>
          </a>
          <ul id="category-setup-menu" class="collapse pl-4">
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span> Category</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Sub Categories</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- Product Setup -->
        <li class="u-sidebar-nav-menu__item">
          <a class="u-sidebar-nav-menu__link" href="#" data-toggle="collapse" data-target="#product-setup-menu" aria-expanded="false" aria-controls="product-setup-menu">
            <img src="{{ asset('img/settings.png') }}" alt="" class="u-sidebar-icon">
            <span class="u-sidebar-nav-menu__item-title">Product Setup</span>
          </a>
          <ul id="product-setup-menu" class="collapse pl-4">
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Product Attributes</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Product Addon</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Product Add</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Product List</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Bulk Import</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Bulk Export</span>
              </a>
            </li>
            <li class="u-sidebar-nav-menu__item">
              <a class="u-sidebar-nav-menu__link" href="#">
                <span>Product Reviews</span>
              </a>
            </li>
            
          </ul>
        </li>

      </ul>
    </nav>
  </div>
  
</aside>