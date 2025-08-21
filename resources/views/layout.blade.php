<!DOCTYPE html>
<html 
  lang="en" 
  data-footer="true" 
  data-override='{"attributes": {"placement": "vertical","layout": "fluid"}, "showSettings": false, "storagePrefix": "laravel-crud"}'
>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Laravel CRUD')</title>
    <meta name="description" content="Laravel CRUD application with Acorn admin template" />

    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('img/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('img/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('img/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('img/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('img/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('img/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('img/favicon/favicon-196x196.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}" />
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/favicon/favicon-128.png') }}" />
    <meta name="application-name" content="Laravel CRUD" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/mstile-144x144.png') }}" />
    <!-- Favicon Tags End -->

    <!-- Fonts Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('font/CS-Interface/style.css') }}" />
    <!-- Fonts End -->

    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/OverlayScrollbars.min.css') }}" />
    <!-- Vendor Styles End -->

    <!-- Template Styles Start -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <!-- Template Styles End -->

    <script src="{{ asset('js/base/loader.js') }}"></script>

    @yield('styles')
  </head>

  <body>
    <div id="root">
      <!-- Navigation Start -->
      <div id="nav" class="nav-container d-flex">
        <div class="nav-content d-flex">

          <!-- Logo Start -->
          <div class="logo position-relative">
            <a href="{{ route('posts.index') }}">
              <div class="img"></div>
              <span class="text-white fw-bold ms-2">Laravel CRUD</span>
            </a>
          </div>
          <!-- Logo End -->

          <!-- Language Switch Start -->
          <div class="language-switch-container">
            <button 
              class="btn btn-empty language-button dropdown-toggle" 
              data-bs-toggle="dropdown" 
              aria-haspopup="true" 
              aria-expanded="false"
            >
              EN
            </button>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">DE</a>
              <a href="#" class="dropdown-item active">EN</a>
              <a href="#" class="dropdown-item">ES</a>
            </div>
          </div>
          <!-- Language Switch End -->

          <!-- User Menu Start -->
          <div class="user-container d-flex">
            <a 
              href="#" 
              class="d-flex user position-relative" 
              data-bs-toggle="dropdown" 
              aria-haspopup="true" 
              aria-expanded="false"
            >
              <img class="profile" alt="profile" src="{{ asset('img/profile/profile-9.webp') }}" />
              <div class="name">User</div>
            </a>

            <div class="dropdown-menu dropdown-menu-end user-menu wide">
              <div class="row mb-3 ms-0 me-0">
                <div class="col-12 ps-1 mb-2">
                  <div class="text-extra-small text-primary">ACCOUNT</div>
                </div>
                <div class="col-6 ps-1 pe-1">
                  <ul class="list-unstyled">
                    <li><a href="#">User Info</a></li>
                    <li><a href="#">Preferences</a></li>
                    <li><a href="#">Settings</a></li>
                  </ul>
                </div>
                <div class="col-6 pe-1 ps-1">
                  <ul class="list-unstyled">
                    <li><a href="#">Security</a></li>
                    <li><a href="#">Billing</a></li>
                  </ul>
                </div>
              </div>

              <div class="row mb-1 ms-0 me-0">
                <div class="col-12 p-1 mb-3 pt-3">
                  <div class="separator-light"></div>
                </div>
                <div class="col-6 ps-1 pe-1">
                  <ul class="list-unstyled">
                    <li>
                      <a href="#">
                        <i data-acorn-icon="help" class="me-2" data-acorn-size="17"></i>
                        <span class="align-middle">Help</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-6 pe-1 ps-1">
                  <ul class="list-unstyled">
                    <li>
                      <a href="#">
                        <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                        <span class="align-middle">Logout</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- User Menu End -->

          <!-- Icons Menu Start -->
          <ul class="list-unstyled list-inline text-center menu-icons">
            <li class="list-inline-item">
              <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
                <i data-acorn-icon="search" data-acorn-size="18"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" id="pinButton" class="pin-button">
                <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
                <i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" id="colorButton">
                <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
              </a>
            </li>
          </ul>
          <!-- Icons Menu End -->

          <!-- Menu Start -->
          <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
              <li>
                <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">
                  <i data-acorn-icon="file-text" class="icon" data-acorn-size="18"></i>
                  <span class="label">Posts</span>
                </a>
              </li>
              <li>
                <a href="{{ route('genres.index') }}" class="{{ request()->routeIs('genres.*') ? 'active' : '' }}">
                  <i data-acorn-icon="tag" class="icon" data-acorn-size="18"></i>
                  <span class="label">Genres</span>
                </a>
              </li>
              <li>
                <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                  <i data-acorn-icon="grid-2" class="icon" data-acorn-size="18"></i>
                  <span class="label">Categories</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- Menu End -->

          <!-- Mobile Buttons Start -->
          <div class="mobile-buttons-container">
            <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
              <i data-acorn-icon="menu-dropdown"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>

            <a href="#" id="mobileMenuButton" class="menu-button">
              <i data-acorn-icon="menu"></i>
            </a>
          </div>
          <!-- Mobile Buttons End -->

        </div>
        <div class="nav-shadow"></div>
      </div>
      <!-- Navigation End -->

      <!-- Main Content Start -->
      <main>
        <div class="container">
          <!-- Page Title Start -->
          <div class="page-title-container">
            <div class="row">
              <div class="col-12 col-md-7">
                <h1 class="mb-0 pb-0 display-4" id="title">@yield('page-title', 'Laravel CRUD')</h1>
                <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                  <ul class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Home</a></li>
                    @yield('breadcrumb')
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <!-- Page Title End -->

          <!-- Content Start -->
          @yield('content')
          <!-- Content End -->
        </div>
      </main>
      <!-- Main Content End -->

      <!-- Footer Start -->
      <footer>
        <div class="footer-content">
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-6">
                <p class="mb-0 text-muted text-medium">&copy; {{ date('Y') }} Laravel CRUD. All rights reserved.</p>
              </div>
              <div class="col-sm-6 d-none d-sm-block">
                <ul class="breadcrumb pt-0 pe-0 mb-0 float-end">
                  <li class="breadcrumb-item mb-0 text-medium">
                    <a href="{{ route('posts.index') }}" class="btn-link">Posts</a>
                  </li>
                  <li class="breadcrumb-item mb-0 text-medium">
                    <a href="{{ route('genres.index') }}" class="btn-link">Genres</a>
                  </li>
                  <li class="breadcrumb-item mb-0 text-medium">
                    <a href="{{ route('categories.index') }}" class="btn-link">Categories</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- Footer End -->
    </div>

    <!-- Search Modal Start -->
    <div 
      class="modal fade modal-under-nav modal-search modal-close-out" 
      id="searchPagesModal" 
      tabindex="-1" 
      role="dialog" 
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 p-0">
            <button 
              type="button" 
              class="btn-close btn btn-icon btn-icon-only btn-foreground" 
              data-bs-dismiss="modal" 
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body ps-5 pe-5 pb-0 border-0">
            <input 
              id="searchPagesInput" 
              class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" 
              type="text" 
              autocomplete="off" 
            />
          </div>
          <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
            <span class="text-alternate d-inline-block m-0 me-3">
              <i data-acorn-icon="arrow-bottom" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
              <span class="align-middle text-medium">Navigate</span>
            </span>
            <span class="text-alternate d-inline-block m-0 me-3">
              <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
              <span class="align-middle text-medium">Select</span>
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- Search Modal End -->

    <!-- Vendor Scripts Start -->
    <script src="{{ asset('js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('js/vendor/autoComplete.min.js') }}"></script>
    <script src="{{ asset('js/vendor/clamp.min.js') }}"></script>
    <script src="{{ asset('icon/acorn-icons.js') }}"></script>
    <script src="{{ asset('icon/acorn-icons-interface.js') }}"></script>
    <!-- Vendor Scripts End -->

    <!-- Template Scripts Start -->
    <script src="{{ asset('js/base/helpers.js') }}"></script>
    <script src="{{ asset('js/base/globals.js') }}"></script>
    <script src="{{ asset('js/base/nav.js') }}"></script>
    <script src="{{ asset('js/base/search.js') }}"></script>
    <script src="{{ asset('js/base/settings.js') }}"></script>
    <!-- Template Scripts End -->

    <!-- Page Scripts Start -->
    <script src="{{ asset('js/pages/vertical.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- Page Scripts End -->

    @yield('scripts')
  </body>
</html>
