
<?php 
$ip = 'no';
$lat = 'no';
$lon = 'no';
$query = @unserialize (file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
if ($query && $query['status'] == 'success') {
    $ip = $query["query"];
    $lat = $query["lat"];
    $lon = $query["lon"];
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Description -->
    <meta name="description" content="">
    <meta name="author" content="Themeland">

    <!-- Title  -->
    <title>AccMailer.com - Email Verifier with high Delivered Accurate</title>

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
                    <span data-text-preloader="A" class="animated-letters">A</span>
                    <span data-text-preloader="C" class="animated-letters">C</span>
                    <span data-text-preloader="C" class="animated-letters">C</span>
                    <span data-text-preloader="M" class="animated-letters">M</span>
                    <span data-text-preloader="A" class="animated-letters">A</span>
                    <span data-text-preloader="I" class="animated-letters">I</span>
                    <span data-text-preloader="L" class="animated-letters">L</span>
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
                        <!-- <td style="font-size: 30px;line-height: 60px; color: #900AEC;"> -->
                        <!-- <strong class="navbar-brand-regular" style="font-size: 20px;line-height: 60px; color: #900AEC;"><span style="border: 3px solid #900AEC; background-color: #900AEC; color: #FCFEF8">ACC</span><span style="border: 3px solid #900AEC;">MAILER</span></strong> -->
                        <img class="navbar-brand-regular" src="assets_landing/img/logo/logo-white.png" style="width:100%; height:30px;" alt="brand-logo">
                        <img class="navbar-brand-sticky" src="assets_landing/img/logo/logo.png" style="width:100%; height:30px;" alt="sticky brand-logo"> 
                        <!-- <strong class="navbar-brand-regular" style="font-size: 20px;line-height: 60px; color: #FCFEF8;"><span style="border: 3px solid #FCFEF8; background-color: #FCFEF8; color: #900AEC">ACC</span><span style="border: 3px solid #FCFEF8;">MAILER</span></strong>
                        <strong class="navbar-brand-sticky" style="font-size: 20px;line-height: 60px; color: #900AEC;"><span style="border: 3px solid #900AEC; background-color: #900AEC; color: #FCFEF8">ACC</span><span style="border: 3px solid #900AEC;">MAILER</span></strong> -->
                        <!-- </td> -->
                        
                    </a>
                    <div class="ml-auto"></div>
                    <!-- Navbar -->
                    <ul class="navbar-nav items">
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#benefit">Benefit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#help">Who we Help?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#choose">Why Us?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll" href="#pricing">Pricing</a>
                        </li>
                    </ul>
                    <!-- Navbar Icons -->
                    <ul class="navbar-nav icons">
                       
                        <!-- <li class="nav-item social">
                            <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item social">
                            <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>
                        </li> -->
                    </ul>

                    <!-- Navbar Toggler -->
                    <ul class="navbar-nav toggle">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                                <i class="fas fa-bars toggle-icon m-0"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Navbar Action Button -->
                    @if(Auth::check())
                        <ul class="navbar-nav action">
                            <li class="nav-item ml-3">
                                <a href="login" class="btn ml-lg-auto flaticon-email"><i class="contact-icon mr-md-2"></i>Go!</a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav action">
                            <li class="nav-item ml-3">
                                <a href="login" class="btn ml-lg-auto btn-bordered-white"><i class="fas fa-angle-double-right contact-icon mr-md-2"></i>Login</a>
                            </li>
                        </ul>
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

        <!-- ***** Welcome Area Start ***** -->
        <section id="home" class="section welcome-area bg-overlay overflow-hidden d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Welcome Intro Start -->
                    <div class="col-12 col-md-7">
                        <div class="welcome-intro">
                            <h3 class="text-white ">Accurate. Powerful. Easy to Use </h3>
                            <h1 class="text-white">Email Verification Services</h1>
                            <p class="text-white my-4">Reduce bounce emails, fake emails, disposable emails, increase email delivery capabilities and increase marketing ROI. Let's try to Validate your Email:</p>
                            <div class="contact-box text-center">
                                <!-- Contact Form -->
                                <form id="post-verif" method="POST" action="{{ route('validateGuest.post') }}">
                                    <div class="row">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
                                        <input type="hidden" name="lat" value="<?=$lat?>">
                                        <input type="hidden" name="lon" value="<?=$lon?>">
                                        <div class="col-12">
                                            
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="email@example.com" required="required">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-bordered-white btn-block mt-3"><span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>Validate</button>
                                        </div>
                                        
                                    </div>
                                </form>
                                @include('dashboard.partials.message')
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <!-- Welcome Thumb -->
                        <div class="welcome-thumb-wrapper mt-5 mt-md-0">
                            <span class="welcome-thumb-1">
                                <img class="welcome-animation d-block ml-auto" style="width: 200px;height: 200px;" src="assets_landing/img/welcome/mail-ge6666b195_1280.png" alt="">
                            </span>
                           <span class="welcome-thumb-2">
                                <img class="welcome-animation d-block" style="width: 90px;height:90px;" src="assets_landing/img/welcome/mail-ge6666b195_1280.png" alt="">
                            </span>
                            <span class="welcome-thumb-3">
                                <img class="welcome-animation d-block" style="width: 80px;height:80px;" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" alt="">
                            </span>
                            <span class="welcome-thumb-4">
                                <img class="welcome-animation d-block" style="width: 100px;height:100px;" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" alt="">
                            </span>
                            <span class="welcome-thumb-5">
                                <img class="welcome-animation d-block" style="width: 122px;height: 112px;" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" alt="">
                            </span>
                            <span class="welcome-thumb-6">
                                <img class="welcome-animation d-block" style="width: 122px;height: 112px;" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" alt="">
                            </span>
                        </div>
                    </div>
                </div>
            
            </div>
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Welcome Area End ***** -->

        <!-- ***** Promo Area Start ***** -->
        <section id="benefit" class="section promo-area ptb_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 res-margin">
                        <!-- Single Promo -->
                        <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                            <h4 class="mb-3">Power your Sales Teams and Campaign</h4>
                            <p>Verified email lists make sales teams feel confident to get new customers and make it easier for sales teams to spread campaign products with accurate email lists</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 res-margin">
                        <!-- Single Promo -->
                        <div class="single-promo color-2 bg-hover active hover-bottom text-center p-5">
                            <h4 class="mb-3">Power your efficiency</h4>
                            <p>Make your sales and marketing efforts more efficient. Email verification helps you stop wasting time on email bounces and become more efficient at promotions.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Promo -->
                        <div class="single-promo color-3 bg-hover hover-bottom text-center p-5">
                            <h4 class="mb-3">Break free from dead weight</h4>
                            <p>Email verification gives you freedom from baggage of fake, invalid emails. You are no longer held back by the incorrect emails that will never produce results.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Promo Area End ***** -->

        <!-- ***** Content Area Start ***** -->
        <section id="help" class="section content-area bg-grey ptb_150">
            <!-- Shape Top -->
            <div class="shape shape-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-6">
                        <!-- Content Inner -->
                        <div class="content-inner text-center">
                            <!-- Section Heading -->
                            <div class="section-heading text-center mb-3">
                                <h2>Who we help</h2>
                                <p class="d-none d-sm-block mt-4">All Segment Company we can help to make it better.</p>
                            </div>
                            <!-- Content List -->
                            <ul class="content-list text-left">
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>e-Commerce & Retailers</b><br>Collect real emails using real-time email validation API on your POS, mobile application or online store.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Technology Platforms</b><br>Integrate our email verification API to automate your workflow and collect real emails on your service platform.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Marketing Agencies</b><br>Use our email list cleaning service to make sure your email campaigns drive ROI for your clients.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Finance & Education</b><br>Before sharing any important transaction details over email, make sure your email data is clean and accurate.</span>
                                    </div>
                                </li>
                            </ul>
                            <a href="/plan" class="btn btn-bordered mt-4">Get Start</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <!-- Service Thumb -->
                        <div class="service-thumb mx-auto pt-4 pt-lg-0">
                            <img src="assets_landing/img/content/content_thumb.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Content Area End ***** -->

        <!-- ***** Content Area Start ***** -->
        <section id="choose" class="section content-area ptb_150">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-6">
                        <!-- Profile Circle Wrapper -->
                        <div class="profile-circle-wrapper circle-animation d-none d-sm-block">
                            <!-- Profile Inner -->
                            <div class="profile-inner">
                                <!-- Profile Circle -->
                                <div class="profile-circle circle-lg">
                                    <span class="profile-icon icon-1">
                                        <img class="icon-1-img" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" />
                                    </span>
                                    <span class="profile-icon icon-2">
                                        <img class="icon-2-img" src="assets_landing/img/content/profile-icons/profile_icon_2.svg" />
                                    </span>
                                    <span class="profile-icon icon-3">
                                        <img class="icon-3-img" src="assets_landing/img/welcome/mail-ge6666b195_1280.png" />
                                    </span>
                                    <span class="profile-icon icon-4">
                                        <img class="icon-4-img" src="assets_landing/img/content/profile-icons/profile_icon_3.svg" />
                                    </span>
                                </div>

                                <!-- Profile Circle -->
                                <div class="profile-circle circle-md">
                                    <span class="profile-icon icon-5">
                                        <img class="icon-5-img" src="assets_landing/img/welcome/mail-ge6666b195_1280.png" />
                                    </span>
                                    <span class="profile-icon icon-6">
                                        <img class="icon-6-img" src="assets_landing/img/content/profile-icons/profile_icon_3.svg" />
                                    </span>
                                    <span class="profile-icon icon-7">
                                        <img class="icon-7-img" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" />
                                    </span>
                                </div>

                                <!-- Profile Circle -->
                                <div class="profile-circle circle-sm">
                                    <span class="profile-icon icon-8">
                                        <img class="icon-8-img" src="assets_landing/img/welcome/at-sign-gc3884db76_1280.png" />
                                    </span>
                                    <span class="profile-icon icon-9">
                                        <img class="icon-9-img" src="assets_landing/img/welcome/letter-gac8fd0361_1280.png" />
                                    </span>
                                </div>
                            </div>
                            <!-- <img class="folder-img" src="assets_landing/img/content/folders.png" /> -->
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <!-- Content Inner -->
                        <div class="content-inner text-center pt-sm-4 pt-lg-0 mt-sm-5 mt-lg-0">
                            <!-- Section Heading -->
                            <div class="section-heading text-center mb-3">
                                <h2>Why AccMailer.com? not other.</h2>
                            </div>
                            <!-- Content List -->
                            <ul class="content-list text-left">
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Highest Accuracy</b><br>Accuracy of QuickEmailVerification is unmatched. Our real-time email verification has ensured 99% email deliverability in the past five years.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Enterprise Security</b><br>We use encrypted storage because protecting your data is our highest priority. We follow security best practices and comply with international regulations.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Lowwest Cost</b><br>Lets Compare to the other validation services an you will love our service with lower cost but you get best benefit</span>
                                    </div>
                                </li>
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Free Testing</b><br>Every customer gets a free trial of 100 email verifications daily on our free-tier plan. Explore the best email verification service without any commitment.</span>
                                    </div>
                                </li>
                            </ul>
                            <a href="/plan" class="btn btn-bordered mt-4">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Content Area End ***** -->

        <!-- ***** Service Area End ***** -->
        <section id="services" class="section service-area bg-grey ptb_150">
            <!-- Shape Top -->
            <div class="shape shape-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2>Our Services</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-email color-1 icon-bg-1"></span>
                            <h3 class="my-3">Single Email Verification</h3>
                            <p>Single email verification is services that you can verify by a single email input.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-email color-2 icon-bg-2"></span>
                            <h3 class="my-3">Bluk Email Verification</h3>
                            <p>Bluk email verification is services that you can verify by a Multiple email list by excel</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-smartphone color-3 icon-bg-3"></span>
                            <h3 class="my-3">API Email Verification</h3>
                            <p>API email verification is services that you can verify by a API integration that can use to your Aplication Dev to verify email</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Service Area End ***** -->

        <!-- ***** Price Plan Area Start ***** -->
        <section id="pricing" class="section price-plan-area bg-grey overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2>Our Price Plans</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-12">
                        <div class="row price-plan-wrapper">
                            <div class="col-12 col-md-4">
                                <!-- Single Price Plan -->
                                <div class="single-price-plan color-1 bg-hover hover-top text-center p-5">
                                    <!-- Plan Title -->
                                    <div class="plan-title mb-2 mb-sm-3">
                                        <h3 class="mb-2">Free</h3>
                                        <p>Free plan you just have 100 verify quota by day</p>
                                    </div>
                                    <!-- Plan Price -->
                                    <div class="plan-price pb-2 pb-sm-3">
                                        <span class="color-primary fw-7">$</span>
                                        <span class="h1 fw-7">0</span>
                                        <sub class="validity text-muted fw-5">/day</sub>
                                    </div>
                                    <!-- Plan Description -->
                                    <div class="plan-description">
                                        <ul class="plan-features">
                                            <li class="py-2">100 Email Verification</li>
                                            <li class="py-2">Free Reporting</li>
                                        </ul>
                                    </div>
                                    <!-- Plan Button -->
                                    <div class="plan-button">
                                        <a href="plan" class="btn btn-bordered mt-3">Get Started</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <!-- Single Price Plan -->
                                <div class="single-price-plan color-2 bg-hover active hover-top text-center p-5">
                                    <!-- Plan Title -->
                                    <div class="plan-title mb-2 mb-sm-3">
                                        <h3 class="mb-2">Pro <sup><span class="badge badge-pill badge-warning ml-2">Save 20%</span></sup></h3>
                                        <p>Pro plan is still with low cost with hight cap limitation.</p>
                                    </div>
                                    <!-- Plan Price -->
                                    <div class="plan-price pb-2 pb-sm-3">
                                        <span class="color-primary fw-7">$</span>
                                        <span class="h1 fw-7">20</span>
                                        <sub class="validity text-muted fw-5">/month</sub>
                                    </div>
                                    <!-- Plan Description -->
                                    <div class="plan-description">
                                        <ul class="plan-features">
                                            <li class="py-2">30000 Email Verification</li>
                                            <li class="py-2">Free Reporting</li>
                                        </ul>
                                    </div>
                                    <!-- Plan Button -->
                                    <div class="plan-button">
                                        <a href="plan" class="btn btn-bordered mt-3">Get Started</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <!-- Single Price Plan -->
                                <div class="single-price-plan color-3 bg-hover hover-top text-center p-5">
                                    <!-- Plan Title -->
                                    <div class="plan-title mb-2 mb-sm-3">
                                        <h3 class="mb-2">Custom <sup></sup></h3>
                                        <p>Custom plan you can user custom to make more hight CAP limitation.</p>
                                    </div>
                                    <!-- Plan Price -->
                                    <div class="plan-price pb-2 pb-sm-3">
                                        <span class="h1 fw-7">Custom</span>
                                    </div>
                                    <!-- Plan Description -->
                                    <div class="plan-description">
                                        <ul class="plan-features">
                                            <li class="py-2">Custom Email Verification</li>
                                            <li class="py-2">Free Reporting</li>
                                        </ul>
                                    </div>
                                    <!-- Plan Button -->
                                    <div class="plan-button">
                                        <a href="plan" class="btn btn-bordered mt-3">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Price Plan Area End ***** -->

        <!--====== Call To Action Area Start ======-->
        <section class="section cta-area bg-overlay ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <!-- Section Heading -->
                        <div class="section-heading text-center m-0">
                            <h2 class="text-white">Not sure what to choose?</h2>
                            <p class="text-white d-none d-sm-block mt-4"></p>
                            <p class="text-white d-block d-sm-none mt-4"></p>
                            <a href="https://api.whatsapp.com/send/?phone=6285791566727&text=Hai%20I%27m+interested+in+your+Verification%20Email%20Services&type=phone_number&app_absent=0" class="btn btn-bordered-white mt-4" target="_blank">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Call To Action Area End ======-->

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
                                <p class="mb-2">AccMailer.com is a Cleaning Service EMAIL that Reduces email bounce, improves email deliverability, and increases marketing ROI. Our single goal is to Create Emails more Clearly.</p>
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
                                    <li class="py-2"><a class="text-black-50" href="/single">Single Email Verification</a></li>
                                    <li class="py-2"><a class="text-black-50" href="/bulk">Bluk Email Verification</a></li>
                                    <li class="py-2"><a class="text-black-50" href="/api">API Email Verification</a></li>
                                   </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <!-- Footer Items -->
                            <div class="footer-items">
                                <!-- Footer Title -->
                                <h3 class="footer-title text-uppercase mb-2">Support</h3>
                                <ul>
                                    <li class="py-2"><a class="text-black-50" href="/faq">Frequently Asked</a></li>
                                    <li class="py-2"><a class="text-black-50" href="/term">Terms &amp; Conditions</a></li>
                                    <li class="py-2"><a class="text-black-50" href="/privacy">Privacy Policy</a></li>
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
                                <?php
                                $year = date('Y');
                                ?>
                                <div class="copyright-left">&copy; Copyrights <?=$year?> AccMailer.com All rights reserved.</div>
                                <!-- Copyright Right -->
                                <div class="copyright-right">Made with <i class="fas fa-heart"></i> By <a href="#">AccMailer.com</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--====== Footer Area End ======-->

        <!--====== Modal Search Area Start ======-->
        <div id="search" class="modal fade p-0">
            <div class="modal-dialog dialog-animated">
                <div class="modal-content h-100">
                    <div class="modal-header" data-dismiss="modal">
                        Search <i class="far fa-times-circle icon-close"></i>
                    </div>
                    <div class="modal-body">
                        <form class="row">
                            <div class="col-12 align-self-center">
                                <div class="row">
                                    <div class="col-12 pb-3">
                                        <h2 class="search-title mb-3">What are you looking for?</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent diam lacus, dapibus sed imperdiet consectetur.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 input-group">
                                        <input type="text" class="form-control" placeholder="Enter your keywords">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 input-group align-self-center">
                                        <button class="btn btn-bordered mt-3">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--====== Modal Search Area End ======-->

        <!--====== Modal Responsive Menu Area Start ======-->
        <div id="menu" class="modal fade p-0">
            <div class="modal-dialog dialog-animated">
                <div class="modal-content h-100">
                    <div class="modal-header" data-dismiss="modal">
                        Menu <i class="far fa-times-circle icon-close"></i>
                    </div>
                    <div class="menu modal-body">
                        <div class="row w-100">
                            <div class="items p-0 col-12 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== Modal Responsive Menu Area End ======-->

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