<?php 
$route = $_SERVER['REQUEST_URI'];
$url = ucfirst(str_replace('/','',$route));

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | <?=$url?></title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SEO Meta Description -->
    <meta name="description" content="">
    <meta name="author" content="Themeland">

    <!-- Title  -->
    <title>EmailCleaner.com - Email Verifier with high Delivered Accurate</title>

    <!-- Favicon  -->
    <link rel="icon" href="assets_landing/img/favicon-32x32.png">

    <!-- ***** All CSS Files ***** -->

    <!-- Style css -->
    <link rel="stylesheet" href="assets_landing/css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="assets_landing/css/responsive.css">

</head>

<body>
    <!--====== Preloader Area Start ======-->
    <div id="preloader">
        <!-- Digimax Preloader -->
        <div id="digimax-preloader" class="digimax-preloader">
            <!-- Preloader Animation -->
            <div class="preloader-animation">
                <!-- Spinner -->
                <div class="spinner"></div>
                <!-- Loader -->
                <div class="loader">
                    <span data-text-preloader="E" class="animated-letters">E</span>
                    <span data-text-preloader="M" class="animated-letters">M</span>
                    <span data-text-preloader="A" class="animated-letters">A</span>
                    <span data-text-preloader="I" class="animated-letters">I</span>
                    <span data-text-preloader="L" class="animated-letters">L</span>
                    <span data-text-preloader="C" class="animated-letters">C</span>
                    <span data-text-preloader="L" class="animated-letters">l</span>
                    <span data-text-preloader="E" class="animated-letters">E</span>
                    <span data-text-preloader="A" class="animated-letters">A</span>
                    <span data-text-preloader="N" class="animated-letters">N</span>
                    <span data-text-preloader="E" class="animated-letters">E</span>
                    <span data-text-preloader="R" class="animated-letters">R</span>
                </div>
                <p class="fw-5 text-center text-uppercase">Loading</p>
            </div>
            <!-- Loader Animation -->
            <div class="loader-animation">
                <div class="row h-100">
                    <!-- Single Loader -->
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                    <!-- Single Loader -->
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                    <!-- Single Loader -->
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                    <!-- Single Loader -->
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== Preloader Area End ======-->

    <!--====== Scroll To Top Area Start ======-->
    <div id="scrollUp" title="Scroll To Top">
        <i class="fas fa-arrow-up"></i>
    </div>
    <!--====== Scroll To Top Area End ======-->

    <div class="main overflow-hidden">
        <!-- ***** Header Start ***** -->
        <header id="header">
            <!-- Navbar -->
            <nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand">
                <div class="container header">
                    <!-- Navbar Brand-->
                    <a class="navbar-brand" href="/">
                        <strong class="navbar-brand-regular" style="font-size: 20px;line-height: 60px; color: #FCFEF8;"><span style="border: 3px solid #FCFEF8; background-color: #FCFEF8; color: #900AEC">ACC</span><span style="border: 3px solid #FCFEF8;">MAILER</span></strong>
                        <strong class="navbar-brand-sticky" style="font-size: 20px;line-height: 60px; color: #900AEC;"><span style="border: 3px solid #900AEC; background-color: #900AEC; color: #FCFEF8">ACC</span><span style="border: 3px solid #900AEC;">MAILER</span></strong>
<!--                         
                        <img class="navbar-brand-regular" src="assets_landing/img/logo/logo-white.png" alt="brand-logo">
                        <img class="navbar-brand-sticky" src="assets_landing/img/logo/logo.png" alt="sticky brand-logo"> -->
                    </a>
                    <div class="ml-auto"></div>
                    <!-- Navbar -->
                    <ul class="navbar-nav items">
                        
                    </ul>
                    <!-- Navbar Icons -->
                    <ul class="navbar-nav icons">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#search">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                        <li class="nav-item social">
                            <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item social">
                            <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>
                        </li>
                    </ul>

                    <!-- Navbar Toggler -->
                    <ul class="navbar-nav toggle">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                                <i class="fas fa-bars toggle-icon m-0"></i>
                            </a>
                        </li>
                    </ul>
                    @if ($route === '/register')
                    <ul class="navbar-nav action">
                        <li class="nav-item ml-3">
                            <a href="login" class="btn ml-lg-auto btn-bordered-white"><i class="fas fa-angle-double-right contact-icon mr-md-2"></i>Login</a>
                        </li>
                    </ul>
                    @endif
                    @if ($route === '/login')
                    <ul class="navbar-nav action">
                        <li class="nav-item ml-3">
                            <a href="register" class="btn ml-lg-auto btn-bordered-white"><i class="fas fa-envelope-open-text contact-icon mr-md-2"></i>Register</a>
                        </li>
                    </ul>
                    @endif
                    
                </div>
            </nav>
        </header>
        <!-- ***** Header End ***** -->
        <section id="home" class="section welcome-area bg-overlay overflow-hidden d-flex align-items-center">
            <div class="container">
                {{ $slot }}
            </div>
        </section>
        <!--====== Footer Area Start ======-->
        <footer class="section footer-area">
            <!-- Footer Top -->
            <div class="footer-top ptb_100">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <!-- Footer Items -->
                            <div class="footer-items">
                                <!-- Footer Title -->
                                <h3 class="footer-title text-uppercase mb-2">About Us</h3>
                                <p class="mb-2">EmailCleaner.com is a Cleaning Service EMAIL that Reduces email bounce, improves email deliverability, and increases marketing ROI. Our single goal is to Create Emails more Clearly.</p>
                                <p class="mb-2">Tulungagung, East Java, Indonesia</p>
                                <p class="mb-2">+6285791566727 (ID)</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <!-- Footer Items -->
                            <div class="footer-items">
                                <!-- Footer Title -->
                                <h3 class="footer-title text-uppercase mb-2">Services</h3>
                                <ul>
                                    <li class="py-2"><a class="text-black-50" href="#">Single Email Verification</a></li>
                                    <li class="py-2"><a class="text-black-50" href="#">Bluk Email Verification</a></li>
                                    <li class="py-2"><a class="text-black-50" href="#">API Email Verification</a></li>
                                   </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <!-- Footer Items -->
                            <div class="footer-items">
                                <!-- Footer Title -->
                                <h3 class="footer-title text-uppercase mb-2">Support</h3>
                                <ul>
                                    <li class="py-2"><a class="text-black-50" href="#">Frequently Asked</a></li>
                                    <li class="py-2"><a class="text-black-50" href="#">Terms &amp; Conditions</a></li>
                                    <li class="py-2"><a class="text-black-50" href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <!-- Footer Items -->
                            <div class="footer-items">
                                <!-- Footer Title -->
                                <h3 class="footer-title text-uppercase mb-2">Follow Us</h3>
                                
                                <!-- Social Icons -->
                                <ul class="social-icons list-inline pt-2">
                                    <li class="list-inline-item px-1"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li class="list-inline-item px-1"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item px-1"><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li class="list-inline-item px-1"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="list-inline-item px-1"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom -->
            <div class="footer-bottom bg-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- Copyright Area -->
                            <div class="copyright-area d-flex flex-wrap justify-content-center justify-content-sm-between text-center py-4">
                                <!-- Copyright Left -->
                                <div class="copyright-left">&copy; Copyrights 2022 EmailCleaner All rights reserved.</div>
                                <!-- Copyright Right -->
                                <div class="copyright-right">Made with <i class="fas fa-heart"></i> By <a href="#">emailcleaner.com</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--====== Footer Area End ======-->

    </div>


    <!-- ***** All jQuery Plugins ***** -->

    <!-- jQuery(necessary for all JavaScript plugins) -->
    <script src="assets_landing/js/jquery/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap js -->
    <script src="assets_landing/js/bootstrap/popper.min.js"></script>
    <script src="assets_landing/js/bootstrap/bootstrap.min.js"></script>

    <!-- Plugins js -->
    <script src="assets_landing/js/plugins/plugins.min.js"></script>

    <!-- Active js -->
    <script src="assets_landing/js/active.js"></script>
</body>

</html>