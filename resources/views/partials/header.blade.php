<header id="header" class="fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="/home">PLPI</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="/home" class="{{Request::is('home*') ? 'active' : ''}}">Home</a></li>
        <li class="dropdown d-none"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="about.html">About</a></li>
            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>\
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/shop" class="{{Request::is('shop') ? 'active' : ''}}">Katalog Produk</a></li>
        <li><a href="#" class="getstarted">Get Started</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header>