<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
  <div class="navbar-vertical-container">
    <div class="navbar-vertical-footer-offset">
      <!-- Logo -->


      <!-- End Logo -->

      <!-- End Navbar Vertical Toggle -->
    <!-- Navbar Vertical Toggle -->
    <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
      <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
      <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
    </button>

    <!-- End Navbar Vertical Toggle -->
      <!-- Content -->
      <div class="navbar-vertical-content">
        <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
          <!-- Collapse -->

          <!-- End Collapse -->

<center>
          <img class="navbar-brand-logo"   src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo" src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="dark">
        <img class="navbar-brand-logo-mini"      src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo-mini" src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="dark">
              </center>



          <span class="dropdown-header mt-4">Hoofdmenu</span>
          <small class="bi-three-dots nav-subtitle-replacer"></small>

          <!-- Collapse -->


          <div class="nav-item ">
            <a class="nav-link {{  Request::path() ==   'dashboard' ? 'active' : '' }} " href="/dashboard" >
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Overzicht</span>
              </a>

            </div>




            <div class="nav-item ">
              <a class="nav-link {{  Request::path() ==   'company/elevators' ? 'active' : '' }} " href="/company/elevators" >
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Liften</span>
              </a>

            </div>

            <div class="nav-item ">
              <a class="nav-link {{  Request::path() ==   'company/elevators/archive' ? 'active' : '' }} " href="/company/elevators/archive" >
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Gearchiveerde Liften</span>
              </a>

            </div>











            <div class="nav-item ">
            <a class="nav-link {{  Request::path() ==   'company/incidents' ? 'active' : ''  }} " href="/company/incidents" >
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Storingen</span>
              </a>

            </div>






            <!-- End Collapse -->
            <span class="dropdown-header mt-4">Basisgegevens</span>
            <!-- Collapse -->



        <div class="nav-item ">
            <a class="nav-link {{  Request::path() ==   'company/contacts' ? 'active' : '' }} " href="/company/contacts" >
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Contactpersonen</span>
              </a>

            </div>











        <span class="dropdown-header mt-4">Algemeen</span>

        <div class="nav-item ">
              <a class="nav-link {{  Request::path() ==   '/api-logbook' ? 'active' : '' }} " href="/api-logbook" >
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Logboek</span>
              </a>

            </div>

            <div class="nav-item ">
                  <a class="nav-link " target="_new" href="/admin" >
                    <i class="bi-gear nav-icon"></i>
                    <span class="nav-link-title">Basisgevens</span>
                  </a>

                </div>



      <!-- End Content -->

      <!-- Footer -->
      <div class="navbar-vertical-footer">
        <ul class="navbar-vertical-footer-list">
          <li class="navbar-vertical-footer-list-item">
            <!-- Style Switcher -->
            <div class="dropdown dropup">
              <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

              </button>

              <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                  <i class="bi-moon-stars me-2"></i>
                  <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                </a>
                <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                  <i class="bi-brightness-high me-2"></i>
                  <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                </a>
                <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                  <i class="bi-moon me-2"></i>
                  <span class="text-truncate" title="Dark">Dark</span>
                </a>
              </div>
            </div>

            <!-- End Style Switcher -->
          </li>


        </ul>
      </div>
      <!-- End Footer -->
    </div>
  </div>
</aside>
