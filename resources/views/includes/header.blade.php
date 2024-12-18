<header class="u-header">
      <div class="u-header-left">
        <a class="u-header-logo" href="index.html">
          <img class="u-logo-desktop" src="{{ asset('/img/logo.png') }}" width="160" alt="RAFW">
          <img class="img-fluid u-logo-mobile" src="" width="50" alt="RAFW">
        </a>
      </div>

      <div class="u-header-middle">
        <a class="js-sidebar-invoker u-sidebar-invoker" href="#!"
           data-is-close-all-except-this="true"
           data-target="#sidebar">
          <i class="fa fa-bars u-sidebar-invoker__icon--open"></i>
          <i class="fa fa-times u-sidebar-invoker__icon--close"></i>
        </a>

        <div class="u-header-search"
             data-search-mobile-invoker="#headerSearchMobileInvoker"
             data-search-target="#headerSearch">
          <a id="headerSearchMobileInvoker" class="btn btn-link input-group-prepend u-header-search__mobile-invoker" href="#!">
            <i class="fa fa-search"></i>
          </a>

          <div id="headerSearch" class="u-header-search-form">
            <form>
              <div class="input-group">
                <button class="btn-link input-group-prepend u-header-search__btn" type="submit">
                  <i class="fa fa-search"></i>
                </button>
                <input class="form-control u-header-search__field" type="search" placeholder="Type to search…">
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="u-header-right">
        <!-- Activities -->
        <div class="dropdown mr-4">
          <a class="link-muted" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
            <span class="h3">
              <i class="far fa-envelope"></i>
            </span>
            <span class="u-indicator u-indicator-top-right u-indicator--xxs bg-secondary"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-4" aria-labelledby="dropdownMenuLink" style="width: 360px;">
            <div class="card">
              <div class="card-header d-flex align-items-center py-3">
                <h2 class="h4 card-header-title">Activities</h2>
                <a class="ml-auto" href="#">Clear all</a>
              </div>

              <div class="card-body p-0">
                <div class="list-group list-group-flush">
                  <!-- Activity -->
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media align-items-center">
                      <img class="u-avatar--sm rounded-circle mr-3" src="{{ asset('/img/avatars/img1.jpg') }}" alt="Image description">

                      <div class="media-body">
                        <div class="d-flex align-items-center">
                          <h4 class="mb-1">Chad Cannon</h4>
                          <small class="text-muted ml-auto">23 Jan 2018</small>
                        </div>

                        <p class="text-truncate mb-0" style="max-width: 250px;">
                          We've just done the project.
                        </p>
                      </div>
                    </div>
                  </a>
                  <!-- End Activity -->

                  <!-- Activity -->
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media align-items-center">
                      <img class="u-avatar--sm rounded-circle mr-3" src="{{asset('/img/avatars/img2.jpg')}}" alt="Image description">

                      <div class="media-body">
                        <div class="d-flex align-items-center">
                          <h4 class="mb-1">Jane Ortega</h4>
                          <small class="text-muted ml-auto">18 Jan 2018</small>
                        </div>

                        <p class="text-truncate mb-0" style="max-width: 250px;">
                          <span class="text-primary">@Bruce</span> advertising your project is not good idea.
                        </p>
                      </div>
                    </div>
                  </a>
                  <!-- End Activity -->

                  <!-- Activity -->
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media align-items-center">
                      <img class="u-avatar--sm rounded-circle mr-3" src="{{asset('/img/avatars/user-unknown.jpg')}}" alt="Image description">

                      <div class="media-body">
                        <div class="d-flex align-items-center">
                          <h4 class="mb-1">Stella Hoffman</h4>
                          <small class="text-muted ml-auto">15 Jan 2018</small>
                        </div>

                        <p class="text-truncate mb-0" style="max-width: 250px;">
                          When the release date is expexted for the advacned settings?
                        </p>
                      </div>
                    </div>
                  </a>
                  <!-- End Activity -->

                  <!-- Activity -->
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media align-items-center">
                      <img class="u-avatar--sm rounded-circle mr-3" src="{{asset('/img/avatars/img4.jpg')}}" alt="Image description">

                      <div class="media-body">
                        <div class="d-flex align-items-center">
                          <h4 class="mb-1">Htmlstream</h4>
                          <small class="text-muted ml-auto">05 Jan 2018</small>
                        </div>

                        <p class="text-truncate mb-0" style="max-width: 250px;">
                          Adwords Keyword research for beginners
                        </p>
                      </div>
                    </div>
                  </a>
                  <!-- End Activity -->
                </div>
              </div>

              <div class="card-footer py-3">
                <a class="btn btn-block btn-outline-primary" href="#">View all activities</a>
              </div>
            </div>
          </div>
        </div>
        <!-- End Activities -->

        <!-- Notifications -->
        <div class="dropdown mr-4">
          <a class="link-muted" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
            <span class="h3">
              <i class="far fa-bell"></i>
            </span>
            <span class="u-indicator u-indicator-top-right u-indicator--xxs bg-info"></span>
          </a>

         


        <!-- User Profile -->
        <div class="dropdown ml-2">
         
            
        
                        <a class="nav-link" href="/login" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Login
                        </a>
       

          
        </div>
        <!-- End User Profile -->
      </div>
    </header>