<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($pageTitle) ? $pageTitle : 'ETAAM | Solutions IT & Technologie au Sénégal'; ?></title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description"
        content="ETAAM - Votre partenaire technologique au Sénégal. Solutions IT, développement web, transformation digitale." />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/custom-animate.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="assets/vendors/notech-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/notech-two-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/timepicker/timePicker.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/notech-responsive.css" />

    <!-- ETAAM logo size constraint -->
    <style>
        .main-menu__logo img {
            max-height: 60px;
            width: auto;
        }
    </style>

    <!-- modes css -->
    <link rel="stylesheet" id="jssMode" href="assets/css/notech-dark.css">




    <!-- ETAAM Custom Modernization -->
    <link rel="stylesheet" href="assets/css/custom-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/blog-redesign.css">
    <link rel="stylesheet" href="assets/css/hero-redesign.css">
    <link rel="stylesheet" href="assets/css/hero-startup.css?v=<?php echo time() + 1; ?>">
    <link rel="stylesheet" href="assets/css/home-projects.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/hero-savio.css"> <!-- Savio Green Theme V4 -->
    <link rel="stylesheet" href="assets/css/footer-redesign.css"> <!-- Deep Space Footer -->
</head>

<body>



    <div class="preloader">
        <img class="preloader__image" width="60" src="assets/images/loader.png" alt="" />
    </div>
    <!-- /.preloader -->
    <div class="page-wrapper">
        <header class="main-header main-header-three clearfix">
            <nav class="main-menu main-menu-three clearfix">
                <div class="main-menu__wrapper clearfix">
                    <div class="main-menu__left main-menu__left--two" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                        <div class="main-menu__logo">
                            <a href="index.php">
                                <?php 
                                require_once __DIR__ . '/db_connect.php';
                                $settingsData = [];
                                try {
                                    $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
                                    $settingsData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
                                } catch (PDOException $e) {}
                                
                                $logoSrc = $settingsData['logo'] ?? 'assets/images/resources/logo-1.png';
                                ?>
                                <img class="logo-dark" src="<?php echo $logoSrc; ?>" alt="" style="max-height:60px;">
                                <img class="logo-light" src="assets/images/resources/logo-3.png" alt="">
                            </a>
                        </div>
                        <div class="main-menu__main-menu-box main-menu__main-menu-box--two">
                            <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                            <ul class="main-menu__list">
                                <li class="<?php echo ($currentPage == 'home') ? 'current' : ''; ?>">
                                    <a href="index.php">Accueil</a>
                                </li>
                                <li class="<?php echo ($currentPage == 'about') ? 'current' : ''; ?>"><a href="about.php">À Propos</a></li>
                                <li class="<?php echo ($currentPage == 'team') ? 'current' : ''; ?>"><a href="team.php">Team</a></li>
                                <li class="<?php echo ($currentPage == 'marketing-forum') ? 'current' : ''; ?>"><a href="marketing-forum.php">Marketing & Forum</a></li>
                                <li class="<?php echo ($currentPage == 'blog') ? 'current' : ''; ?>"><a href="blog.php">Blog</a></li>

                            </ul>
                        </div>
                        
                        <div class="main-menu__right-startup" style="display: flex; align-items: center;">
                            <a href="contact.php" class="hero-startup-btn-nav">
                                <span>GET IN TOUCH</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu main-menu-three">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->
