<?php
$pageTitle = "Team | ETAAM | Experts du Numérique au Sénégal";
$currentPage = "team";
include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/about-premium.css">
<style>
    .page-header {
        padding-top: 180px !important;
    }
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      once: true,
      offset: 100
    });
  });
</script>

        <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg"
                style="background-image: url(assets/images/backgrounds/about-header-bg-senegal.png)">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2>Nos Experts</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

<style>
    :root {
        --subtle-premium-bg: #0b1120;
        --accent-glow: rgba(59, 130, 246, 0.4);
        --glass-bg: rgba(255, 255, 255, 0.03);
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    .team-page {
        background: var(--subtle-premium-bg) !important;
        position: relative;
        overflow: hidden;
        padding-top: 120px !important;
        padding-bottom: 120px !important;
    }

    /* Subtle Animated Glows */
    .team-page::before, .team-page::after {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
        filter: blur(100px);
        opacity: 0.2;
        z-index: 0;
        pointer-events: none;
    }

    .team-page::before { top: -200px; right: -200px; }
    .team-page::after { bottom: -200px; left: -200px; }

    .section-title__tagline {
        color: #3B82F6 !important;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: inline-block;
        padding-bottom: 5px;
        border-bottom: 2px solid #3B82F6;
        margin-bottom: 20px !important;
    }

    .team-page .section-title__title {
        color: #ffffff !important;
        font-size: 48px !important;
        font-weight: 800 !important;
    }


    /* Sublte Hover on Original Cards */
    .team-one__single {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--glass-border) !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        background: transparent !important;
    }

    .team-one__single:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    /* Clean Card Content */
    .team-one__content {
        background: rgba(30, 41, 59, 0.95) !important; /* Slightly more opaque for better contrast */
        backdrop-filter: blur(10px);
        padding: 35px 20px !important;
        text-align: center !important; /* Keeping it centered as per visual preference */
        border: none !important;
    }

    .team-one__name a {
        color: #ffffff !important;
        font-size: 24px !important;
        font-weight: 700 !important;
        transition: color 0.3s;
    }

    .team-one__name a:hover {
        color: #3B82F6 !important;
    }

    .team-one__title {
        color: #cbd5e1 !important;
        font-size: 15px !important;
        margin-top: 10px !important;
    }

    /* Careers CTA - Authentic Ziguinchor Office Style */
    .business-from {
        background: url('assets/images/backgrounds/etaam-team-office.png') no-repeat center center !important;
        background-size: cover !important;
        padding: 120px 0 !important;
        position: relative;
        z-index: 1;
    }

    /* Dark Overlay for Readability */
    .business-from::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(11, 17, 32, 0.85); /* Deep dark blue overlay */
        z-index: -1;
    }

    .business-from__inner {
        background: transparent !important;
        border: none !important;
        border-radius: 0;
        padding: 0 !important;
        backdrop-filter: none;
        box-shadow: none;
    }

    .business-from__sub-title {
        color: #3B82F6 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .business-from__title {
        color: #ffffff !important;
        font-size: 42px !important;
        line-height: 1.2 !important;
        margin-top: 15px;
    }

    .business-from__btn {
        background: #3B82F6 !important;
        border-radius: 100px !important;
        padding: 18px 45px !important;
        font-weight: 700 !important;
        transition: all 0.4s !important;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
    }

    .business-from__btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.4);
        background: #2563eb !important;
    }


    /* Media Queries for Mobile/Tablet Optimization */
    @media (max-width: 991px) {
        .team-page { padding-top: 80px !important; padding-bottom: 80px !important; }
        .business-from__inner { padding: 60px 40px !important; border-radius: 30px; }
    }

    @media (max-width: 768px) {
        .team-page { padding-top: 60px !important; padding-bottom: 60px !important; }
        .team-page::before, .team-page::after { width: 300px; height: 300px; filter: blur(60px); opacity: 0.15; }
        .section-title__title { font-size: 32px !important; }
        .section-title__tagline { margin-bottom: 12px !important; font-size: 13px; }
        .business-from__title { font-size: 26px !important; line-height: 1.3 !important; }
        .business-from__inner { padding: 40px 20px !important; margin: 0 10px; }
        .team-one__name { font-size: 20px; }
        .team-one__title { font-size: 14px; }
        .business-from { padding: 60px 0 !important; }
    }

    @media (max-width: 480px) {
        .section-title__title { font-size: 28px !important; }
        .business-from__title { font-size: 24px !important; }
        .business-from__btn { padding: 15px 35px !important; font-size: 15px; }
        .team-one__img img { height: 350px !important; }
        .business-from__inner { padding: 35px 15px !important; }
    }

    /* Team Hero Section Responsive Styles */
    @media (max-width: 991px) {
        .team-hero-section { padding: 60px 0 40px !important; }
        .team-hero-content { padding-right: 0 !important; margin-bottom: 40px; }
        .team-hero-title { font-size: 40px !important; }
    }

    @media (max-width: 768px) {
        .team-hero-section { padding: 50px 0 30px !important; }
        .team-hero-title { font-size: 36px !important; }
        .team-hero-text { font-size: 16px !important; }
        .team-hero-tagline { font-size: 12px !important; }
    }

    @media (max-width: 480px) {
        .team-hero-title { font-size: 32px !important; }
        .team-hero-text { font-size: 15px !important; }
    }

    /* Floating Animation for ETAAM Illustration */
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    .team-hero-image img {
        animation: float 3s ease-in-out infinite;
        will-change: transform;
    }

    /* Ensure animation works on mobile */
    @media (max-width: 768px) {
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }
    }
</style>

        <!--Team Hero Section Start-->
        <section class="team-hero-section" style="background: #1a1a2e; padding: 80px 0 60px; position: relative; overflow: hidden;">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Column: Text Content -->
                    <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-duration="1000">
                        <div class="team-hero-content" style="padding-right: 40px;">
                            <span class="team-hero-tagline" style="color: #3B82F6; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display: inline-block; margin-bottom: 20px; border-bottom: 2px solid #3B82F6; padding-bottom: 5px;">
                                Qui sommes-nous
                            </span>
                            <h2 class="team-hero-title" style="color: #ffffff; font-size: 48px; font-weight: 900; line-height: 1.2; margin-bottom: 25px;">
                                Nous aidons chaque <br>besoin de votre entreprise
                            </h2>
                            <p class="team-hero-text" style="color: rgba(255, 255, 255, 0.75); font-size: 17px; line-height: 1.8; margin-bottom: 20px;">
                                Notre équipe d'experts passionnés combine innovation technologique et expertise locale pour transformer vos défis en opportunités de croissance.
                            </p>
                            <p class="team-hero-text" style="color: rgba(255, 255, 255, 0.75); font-size: 17px; line-height: 1.8;">
                                Ensemble, nous créons des solutions digitales qui propulsent votre entreprise vers l'excellence et l'innovation au Sénégal et au-delà.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Right Column: ETAAM Illustration -->
                    <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="team-hero-image" style="text-align: center; padding: 20px;">
                            <img src="assets/images/resources/team-etaam-hero.png" alt="ETAAM Team" style="max-width: 100%; height: auto; filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.3));">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Team Hero Section End-->

        <!--Team Page Start-->
        <section class="team-page">
            <div class="container">
                <div class="section-title text-center">
                    <div class="section-title__tagline-box">
                        <span class="section-title__tagline">RENCONTREZ L'ÉQUIPE</span>
                    </div>
                    <h2 class="section-title__title">Le leadership derrière l'innovation</h2>
                </div>
<?php
                // include 'includes/team_data.php'; // Legacy Static Data
                
                // Fetch from Database
                require_once __DIR__ . '/includes/db_connect.php';
                $teamMembers = [];
                try {
                    $stmt = $pdo->query("SELECT * FROM team_members ORDER BY display_order ASC, id ASC");
                    $teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                     foreach ($teamMembers as &$m) {
                          $m['social'] = [
                             'linkedin' => ($m['social_linkedin'] && $m['social_linkedin'] !== '') ? $m['social_linkedin'] : '#',
                             'twitter' => ($m['social_twitter'] && $m['social_twitter'] !== '') ? $m['social_twitter'] : '#', 
                             'facebook' => ($m['social_facebook'] && $m['social_facebook'] !== '') ? $m['social_facebook'] : '#'
                         ];
                     }
                } catch (PDOException $e) {
                    error_log("DB Error Team Page: " . $e->getMessage());
                }

                $delay = 100;
                ?>
                <div class="row">
                    <?php if (empty($teamMembers)): ?>
                        <div class="col-12 text-center">
                            <p style="color: #94a3b8;">Aucun membre d'équipe trouvé.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($teamMembers as $member): 
                            $id = $member['id'];
                        ?>
                        <!-- Team Cards -->
                        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>ms">
                            <div class="team-one__single" style="margin-bottom: 30px;">
                                <div class="team-one__img" style="overflow: hidden;">
                                    <a href="team-details.php?id=<?php echo $id; ?>">
                                        <img src="<?php echo $member['image']; ?>" alt="<?php echo $member['name']; ?>" style="object-fit:cover; height:450px; width:100%;">
                                    </a>
                                    <ul class="list-unstyled team-one__social">
                                        <?php if ($member['social']['twitter']): ?>
                                        <li><a href="<?php echo $member['social']['twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
                                        <?php endif; ?>
                                        <?php if ($member['social']['facebook']): ?>
                                        <li><a href="<?php echo $member['social']['facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li>
                                        <?php endif; ?>
                                        <?php if ($member['social']['linkedin']): ?>
                                        <li><a href="<?php echo $member['social']['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="team-one__content-box">
                                    <div class="team-one__content">
                                        <h4 class="team-one__name"><a href="team-details.php?id=<?php echo $id; ?>"><?php echo $member['name']; ?></a></h4>
                                        <p class="team-one__title"><?php echo $member['role']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $delay += 100;
                        endforeach; 
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!--Team Page End-->

        <!--CTA Start-->
        <section class="business-from">
            <div class="container">
                <div class="business-from__inner text-center wow zoomIn" data-wow-duration="1500ms">
                    <div class="business-from__btn-box">
                        <a href="contact.php" class="business-from__btn thm-btn">Rejoindre l'Équipe</a>
                    </div>
                </div>
            </div>
        </section>
        <!--CTA End-->

<?php include 'includes/footer.php'; ?>
