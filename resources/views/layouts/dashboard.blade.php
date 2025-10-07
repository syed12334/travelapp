<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Hotel Booking App</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
       <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favico.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/favico.png') }}">
    
    <link rel="stylesheet" href="{{ asset('app/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/map.min.css')}}">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    
@stack('style')
</head>
<body class="body header-fixed ">
   <div class="preload preload-container">
        <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
            <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
        </svg>
    </div>

    <!-- /preload -->

    <div id="wrapper">

        <div id="pagee" class="clearfix">

            <div class="sidebar-dashboard">
                <div class="db-logo">
                    <a href="index.html"><img src="assets/images/favico.png" alt="Logo"><span>Vitour</span></a>
                </div>
                <div class="db-menu">
                    <ul>
                        <li>
                            <a href="{{ route('dashboard'); }}">
                                <i class="icon-Vector-9"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="my-booking.html">
                                <i class="icon-Layer-2"></i>
                                <span>My Booking</span>
                            </a>
                        </li>
                        <li>
                            <a href="my-listing.html">
                                <i class="icon-Group-81"></i>
                                <span>My Listing</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('steponeview'); }}">
                                <i class="icon-Group-91"></i>
                                <span>List Property</span>
                            </a>
                        </li>
                        <li>
                            <a href="my-favorite.html">
                                <i class="icon-Vector-10"></i>
                                <span>My Favorites</span>
                            </a>
                        </li>
                        <li>
                            <a href="my-profile.html">
                                <i class="icon-profile-user-1"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="icon-turn-off-1"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>


                </div>

            </div>

            <div class="has-dashboard">
                <!-- Main Header -->
                <header class="main-header flex">
                    <!-- Header Lower -->
                    <div id="header">

                        <div class="header-dashboard">
                            <div class="tf-container full">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="inner-container flex justify-space align-center">
                                            <!-- Logo Box -->
                                            <div class="header-search flex-three">
                                                <div class="icon-bars">
                                                    <i class="icon-Vector3"></i>
                                                </div>
                                                <form action="https://themesflat.co/" class="search-dashboard">
                                                    <i class="icon-Vector5"></i>
                                                    <input type="search" placeholder="Search tours">
                                                </form>

                                            </div>

                                           
                                            <div class="header-account flex align-center">
                                                <div class="dropdown notification">
                                                    <a class="icon-notification" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="icon-notification-1"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                      <li>
                                                        <div class="message-item  flex-three">
                                                            <div class="image">
                                                                <i class="icon-26"></i>
                                                            </div>
                                                            <div>
                                                                <div class="body-title">Discount available</div>
                                                                <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec diam</div>
                                                            </div>
                                                        </div>
                                                      </li>
                                                      <li>
                                                        <div class="message-item  flex-three">
                                                            <div class="image">
                                                                <i class="icon-26"></i>
                                                            </div>
                                                            <div>
                                                                <div class="body-title">Discount available</div>
                                                                <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec diam</div>
                                                            </div>
                                                        </div>
                                                      </li>
                                                      <li>
                                                        <div class="message-item  flex-three">
                                                            <div class="image">
                                                                <i class="icon-26"></i>
                                                            </div>
                                                            <div>
                                                                <div class="body-title">Discount available</div>
                                                                <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec diam</div>
                                                            </div>
                                                        </div>
                                                      </li>
                                                      
                                                    </ul>
                                                </div> 
                                                <div class="dropdown account">
                                                    <a type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="assets/images/page/avata.jpg" alt="image">
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                      <li><a  href="#">Account</a></li>
                                                      <li><a  href="#">Setting</a></li>
                                                      <li><a  href="#">Support</a></li>
                                                      <li><a  href="{{ route('logout') }}">Logout</a></li>
                                                    </ul>
                                                </div> 
                                                <div class="mobile-nav-toggler mobile-button">
                                                    <i class="icon-bar"></i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Header Lower -->


                    <!-- Mobile Menu  -->
                    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
                    <div class="mobile-menu">
                        <div class="menu-backdrop"></div>
                        <nav class="menu-box">
                            <div class="nav-logo"><a href="index.html">
                                    <img src="assets/images/logo2.png" alt=""></a></div>
                            <div class="bottom-canvas">
                                <div class="menu-outer">
                                </div>
                            </div>
                        </nav>
                    </div>
                    <!-- End Mobile Menu -->

                </header>
                <!-- End Main Header -->
             @yield('content')

                <footer class="footer footer-dashboard">
                    <div class="tf-container full">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="text-white">Made with ❤️ by Themesflat. - Powered by Theme</p>
                            </div>
                            <div class="col-lg-6">
                                <ul class="menu-footer flex-six">
                                    <li>
                                        <a href="#">Privacy & Policy</a>
                                    </li>
                                    <li>
                                        <a href="#">Licensing</a>
                                    </li>
                                    <li>
                                        <a href="#">Instruction</a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </footer>

                <!-- Bottom -->
            </div>

        </div>
        <!-- /#page -->
    </div>

    <!-- Modal Popup Bid -->

    <a id="scroll-top" class="button-go"></a>

    <!-- Modal search-->
    <div class="modal search-mobie fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <form action="https://themesflat.co/" class="search-form-mobie">
                        <div class="search">
                            <i class="icon-circle2017"></i>
                            <input type="search" placeholder="Search Travel" class="search-input" autocomplete="off">
                            <button type="button">Search</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ...
        </div>
    </div>


    <!-- Javascript -->
    <script src="{{ asset('app/js/jquery.min.js');}}"></script>
    <script src="{{ asset('app/js/jquery.nice-select.min.js');}}"></script>
    <script src="{{ asset('app/js/bootstrap.min.js');}}"></script>
    <script src="{{ asset('app/js/bootstrap-select.min.js');}}"></script>
    <script src="{{ asset('app/js/tinymce/tinymce.min.js');}}"></script>
    <script src="{{ asset('app/js/tinymce/tinymce-custom.js');}}"></script>
    <script src="{{ asset('app/js/swiper-bundle.min.js');}}"></script>
    <script src="{{ asset('app/js/swiper.js');}}"></script>
    <script src="{{ asset('app/js/plugin.js');}}"></script>
    <script src="{{ asset('app/js/map.min.js');}}"></script>
    <script src="{{ asset('app/js/map.js');}}"></script>
    <script src="{{ asset('app/js/countto.js');}}"></script>
    <script src="{{ asset('app/js/apexcharts.js');}}"></script>
    <script src="{{ asset('app/js/line-chart.js');}}"></script>
    <script src="{{ asset('app/js/shortcodes.js');}}"></script>
    <script src="{{ asset('app/js/main.js');}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $("select").select2();
    </script>
    @stack('script')
</body>


</html>