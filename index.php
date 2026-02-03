<?php
$pageTitle = "ETAAM | Solutions IT & Technologie au Sénégal";
$currentPage = "home";
include 'includes/header.php';

// Load Home Page Data
require_once __DIR__ . '/includes/db_connect.php';
$homeData = [];
try {
    $stmt = $pdo->query("SELECT section, content FROM home_page_data");
    $raw = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    foreach ($raw as $section => $json) {
        $homeData[$section] = json_decode($json, true);
    }
} catch (PDOException $e) {}
?>

        <!-- Hero Section - Purple Startup Theme (V3) -->
        <!-- Hero Section - Purple Startup Theme (V3) -->
        <section class="hero-startup-section">
            <div class="container">
                <div class="row align-items-center">
                    
                    <!-- Left Side: Text Content -->
                    <div class="col-lg-6">
                        <div class="hero-startup-content animate__animated animate__fadeInLeft">
                            <!-- Badge Removed -->
                            <h1 class="hero-startup-title">
                                <?php echo $homeData['hero']['title'] ?? 'Expertise <span class="highlight-teal">Locale</span>,<br>Vision Globale'; ?>
                            </h1>
                            <p class="hero-startup-subtitle">
                                <?php echo $homeData['hero']['subtitle'] ?? 'Accélérez votre croissance avec des solutions technologiques sur mesure, conçues au Sénégal pour le monde.'; ?>
                            </p>
                             <div class="hero-startup-btn-box d-md-none">
                                <a href="contact.php" class="hero-startup-btn-nav">GET IN TOUCH <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Glassmorphic Card -->
                    <div class="col-lg-6">
                        <div class="hero-startup-card-container animate__animated animate__fadeInRight" style="animation-delay: 0.3s;">
                            
                            <!-- Floating Elements -->
                            <div class="floating-element floating-code">
                                <i class="fa fa-code"></i>
                            </div>
                            <div class="floating-element floating-network">
                                <i class="fa fa-network-wired"></i>
                            </div>

                            <div class="hero-startup-card-image-only">
                                <img src="<?php echo $homeData['hero']['image'] ?? 'assets/images/resources/hero-hand-generated.png'; ?>" alt="Innovation Tech Sénégal" style="width: 100%; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!--Services Three Start-->
        <!--Services Three Start-->
        <section class="services-three service-three--no-pb services-section-forest">
            <div class="container">
                <div class="services-three__top">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7">
                            <div class="services-three__top-left">
                                <div class="section-title text-left">
                                    <div class="section-title__tagline-box">
                                        <span class="section-title__tagline">NOS EXPERTISES</span>
                                        <div class="section-title-shape">
                                            <img src="assets/images/shapes/section-title-shape.png" alt="">
                                        </div>
                                    </div>
                                    <h2 class="section-title__title" style="color: #fff;">Des solutions adaptées à vos
                                        besoins</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="services-three__top-right">
                                <p class="services-three__top-text" style="color: rgba(255,255,255,0.8);">Nous
                                    accompagnons les entreprises et institutions sénégalaises dans leur transformation
                                    digitale avec des solutions innovantes et sur mesure.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="services-three__bottom">
                    <div class="row justify-content-center" style="row-gap: 50px;">
                        <?php 
                        include 'includes/services_data.php';

                        foreach ($services as $i => $service): 
                            $delay = ($i * 100) . 'ms'; 
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>">
                            <div class="services-three__single service-card-premium">
                                <div class="services-three__content">
                                    <div class="services-three__icon">
                                        <span class="<?php echo $service['icon']; ?>"></span>
                                    </div>
                                    <h3 class="services-three__title"><a href="<?php echo $service['link']; ?>"><?php echo $service['title']; ?></a></h3>
                                    <p class="services-three__text"><?php echo $service['description']; ?></p>
                                    <div class="services-three__learn-more">
                                        <a href="<?php echo $service['link']; ?>">En savoir plus<i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <!--Services Three End-->

        <!--Brand Three Removed-->

        <!--Welcome Start-->
        <section class="welcome">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="welcome__left">
                            <div class="welcome__img-box" style="padding-right: 30px;">
                                <img src="<?php echo $homeData['welcome']['image'] ?? 'assets/images/resources/welcome-1.png'; ?>" alt="ETAAM Team"
                                    style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="welcome__right">
                            <div class="section-title text-left">
                                <div class="section-title__tagline-box">
                                    <span class="section-title__tagline"><?php echo $homeData['welcome']['tagline'] ?? 'QUI SOMMES-NOUS ?'; ?></span>
                                    <div class="section-title-shape">
                                        <img src="assets/images/shapes/section-title-shape.png" alt="">
                                    </div>
                                </div>
                                <h2 class="section-title__title"><?php echo $homeData['welcome']['title'] ?? 'ETAAM crée des solutions technologiques sur mesure'; ?></h2>
                            </div>
                            <p class="welcome__text-1"><?php echo $homeData['welcome']['text_1'] ?? 'Basée à Ziguinchor, ETAAM est votre partenaire technologique...'; ?></p>
                            <p class="welcome__text-2"><?php echo $homeData['welcome']['text_2'] ?? 'Notre mission est d\'accélérer l\'innovation...'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Welcome End-->

        <!--Project Three Start-->
        <section class="project-two project-three">
            <div class="project-two__bottom">
                <div class="project-two__container">
                    <div class="section-title text-center">
                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">PROJETS INNOVANTS</span>
                            <div class="section-title-shape">
                                <img src="assets/images/shapes/section-title-shape.png" alt="">
                            </div>
                        </div>
                        <h2 class="section-title__title">Nos Réalisations Récentes</h2>
                    </div>
                    <div class="owl-carousel owl-theme thm-owl__carousel project-two__carousel" data-owl-options='{
                        "loop": true,
                        "autoplay": true,
                        "margin": 30,
                        "nav": false,
                        "dots": true,
                        "smartSpeed": 500,
                        "autoplayTimeout": 10000,
                        "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                        "responsive": {
                            "0": {
                                "items": 1
                            },
                            "768": {
                                "items": 2
                            },
                            "992": {
                                "items": 3
                            },
                            "1200": {
                                "items": 4
                            }
                        }
                    }'>
                        <?php
                        // Fetch latest 4 projects
                        $recentProjects = [];
                        try {
                             $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 4");
                             $recentProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {}

                        foreach ($recentProjects as $project) {
                            $title = htmlspecialchars($project['title']);
                            $subtitle = htmlspecialchars($project['category']); // Use category as subtitle
                            $image = htmlspecialchars($project['image'] ?? 'assets/images/project/etaam-project-1.png');
                            $link = "project-details.php?id=" . htmlspecialchars($project['id']);
                        ?>
                        <!-- Project Item -->
                        <div class="project-two__single">
                            <div class="project-two__img">
                                <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"
                                    style="height: 423px; object-fit: cover;">
                            </div>
                            <div class="project-two__content">
                                <p class="project-two__sub-title"><?php echo $subtitle; ?></p>
                                <h3 class="project-two__title"><a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                                </h3>
                                <div class="project-two__arrow">
                                    <a href="<?php echo $link; ?>"><i class="fa fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!--Project Three  End-->

    <!--Consult Start-->
    <section class="consult">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="consult__left">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline"><?php echo $homeData['consult']['tagline'] ?? 'NOTRE EXPERTISE'; ?></span>
                                <div class="section-title-shape">
                                    <img src="assets/images/shapes/section-title-shape.png" alt="">
                                </div>
                            </div>
                            <h2 class="section-title__title"><?php echo $homeData['consult']['title'] ?? 'Conseil et Solutions Technologiques Sur Mesure'; ?></h2>
                        </div>
                        <p class="consult__text"><?php echo $homeData['consult']['text'] ?? 'Nous accompagnons votre transformation numérique...'; ?></p>
                        <div class="consult__icon-box">
                            <div class="consult__icon">
                                <span class="icon-cloud-storage"></span>
                            </div>
                            <p class="consult__icon-text">L'innovation au service du développement.<br> La bonne
                                méthode.</p>
                        </div>
                        <ul class="list-unstyled consult__points">
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <div class="text">
                                    <p>Support technique expert 24/7</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <div class="text">
                                    <p>Solutions logicielles adaptées à votre métier</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <div class="text">
                                    <p>Suivi rigoureux et formation de vos équipes</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="consult__right">
                        <div class="consult__img wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                            <img src="<?php echo $homeData['consult']['image'] ?? 'assets/images/resources/consult-1.png'; ?>" alt="Ingénieur ETAAM"
                                style="height: 570px; object-fit: cover;">
                            <div class="consult__img-content">
                                <p class="consult__img-text">Votre partenaire de confiance <br> pour l'innovation IT</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Consult  End-->





    <!--Business From Start-->
    <!--Business From Start-->
    <section class="business-from">
        <div class="business-from-bg-box">
            <div class="business-from-bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
                style="background-image: url(assets/images/backgrounds/business-from-bg-1.png);"></div>
        </div>
        <div class="container">
            <div class="business-from__inner text-center">
                <p class="business-from__sub-title"><?php echo $homeData['business_from']['subtitle'] ?? 'De l\'idée à la réalité'; ?></p>
                <h2 class="business-from__title"><?php echo $homeData['business_from']['title'] ?? 'Lancez votre Projet Tech avec ETAAM'; ?></h2>
                <div class="business-from__btn-box">
                    <a href="<?php echo $homeData['business_from']['button_url'] ?? 'contact.php'; ?>" class="business-from__btn thm-btn"><?php echo $homeData['business_from']['button_text'] ?? 'Contactez-nous'; ?></a>
                </div>
            </div>
        </div>
    </section>
    <!--Business From End-->
    <!--Business From End-->

    <!--Notech More Start-->
    <section class="notech-more">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="notech-more__left">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline"><?php echo $homeData['notech_more']['tagline'] ?? 'POURQUOI NOUS CHOISIR'; ?></span>
                                <div class="section-title-shape">
                                    <img src="assets/images/shapes/section-title-shape.png" alt="">
                                </div>
                            </div>
                            <h2 class="section-title__title"><?php echo $homeData['notech_more']['title'] ?? 'ETAAM : Bien plus que de la Tech'; ?></h2>
                        </div>
                        <p class="notech-more__text"><?php echo $homeData['notech_more']['text'] ?? 'Nous transformons vos défis en opportunités...'; ?></p>
                        <ul class="list-unstyled notech-more__points">
                            <li>
                                <div class="icon">
                                    <span class="icon-technology"></span>
                                </div>
                                <h3 class="notech-more__title">Expertise Data & IA</h3>
                                <p class="notech-more__text-2">Des solutions intelligentes pour valoriser vos données et
                                    anticiper l'avenir.</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-stock-market"></span>
                                </div>
                                <h3 class="notech-more__title">Stratégie Digitale</h3>
                                <p class="notech-more__text-2">Un accompagnement sur-mesure pour votre croissance et
                                    votre transformation numérique.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="notech-more__right">
                        <div class="notech-more__img wow slideInRight" data-wow-delay="100ms"
                            data-wow-duration="2500ms">
                            <img src="<?php echo $homeData['notech_more']['image'] ?? 'assets/images/resources/why-choose-senegal.png'; ?>" alt=""
                                style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 440px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Notech More End-->

<?php include 'includes/footer.php'; ?>
