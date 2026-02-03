<?php
$pageTitle = "À Propos | ETAAM";
$currentPage = "about";
include 'includes/header.php';

// Load About Page Data from Database
require_once __DIR__ . '/includes/db_connect.php';
$aboutData = [];
try {
    $stmt = $pdo->query("SELECT section, content FROM about_page_data");
    $raw = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    foreach ($raw as $section => $json) {
        $aboutData[$section] = json_decode($json, true);
    }
} catch (PDOException $e) {
    error_log("DB Error About: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="assets/css/about-new.css?v=<?php echo time(); ?>">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  window.addEventListener('load', () => {
    AOS.init({ duration: 800, once: true, offset: 50 });
  });
</script>

<!-- Page Header -->
<section class="about-header">
    <div class="about-header__bg" style="background-image: url(<?php echo $aboutData['page_header']['background_image'] ?? 'assets/images/backgrounds/about-header-bg-senegal.png'; ?>)"></div>
    <div class="container">
        <div class="about-header__content" data-aos="fade-up">
            <h1><?php echo $aboutData['page_header']['title'] ?? 'À Propos de ETAAM'; ?></h1>
            <p>Votre partenaire technologique en Casamance</p>
        </div>
    </div>
</section>

<!-- About Company Section -->
<section class="about-intro">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-intro__image about-intro__image--animated">
                    <img src="assets/images/resources/etaam-graphic.png" alt="ETAAM Technology">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-intro__content">
                    <span class="about-intro__label"><?php echo $aboutData['why_choose_us']['tagline'] ?? 'À Propos'; ?></span>
                    <h2 class="about-intro__title"><?php echo $aboutData['why_choose_us']['title'] ?? 'L\'Identité ETAAM à Ziguinchor'; ?></h2>
                    <p class="about-intro__text"><?php echo $aboutData['why_choose_us']['main_text'] ?? ''; ?></p>
                    
                    <div class="about-intro__features">
                        <?php 
                        $points = $aboutData['why_choose_us']['points'] ?? [];
                        foreach($points as $point): 
                        ?>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <span class="<?php echo $point['icon'] ?? 'icon-verified'; ?>"></span>
                            </div>
                            <div class="feature-text">
                                <h4><?php echo $point['title']; ?></h4>
                                <p><?php echo $point['text']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Valeurs Section -->
<section class="about-values">
    <div class="container">
        <div class="about-values__header text-center" data-aos="fade-up">
            <span class="about-values__label">Nos Valeurs</span>
            <h2 class="about-values__title">Ce Qui Nous Définit</h2>
        </div>
        <div class="values-grid">
            <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                <div class="value-illustration">
                    <img src="assets/images/icons/icon-innovation.png" alt="Innovation">
                </div>
                <h3>Innovation</h3>
                <p>Nous repoussons les limites technologiques pour offrir des solutions avant-gardistes adaptées à notre région.</p>
            </div>
            <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                <div class="value-illustration">
                    <img src="assets/images/icons/icon-integrity.png" alt="Intégrité">
                </div>
                <h3>Intégrité</h3>
                <p>La transparence et l'honnêteté guident chacune de nos actions et relations professionnelles.</p>
            </div>
            <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                <div class="value-illustration">
                    <img src="assets/images/icons/icon-excellence.png" alt="Excellence">
                </div>
                <h3>Excellence</h3>
                <p>Nous visons l'excellence dans chaque projet, avec des standards de qualité internationaux.</p>
            </div>
            <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                <div class="value-illustration">
                    <img src="assets/images/icons/icon-engagement.png" alt="Engagement Local">
                </div>
                <h3>Engagement Local</h3>
                <p>Nous sommes fiers de contribuer au développement numérique de la Casamance et du Sénégal.</p>
            </div>
        </div>
    </div>
</section>



<!-- CTA Section -->
<section class="about-cta">
    <div class="about-cta__bg" style="background-image: url(assets/images/backgrounds/business-from-bg-senegal.png);"></div>
    <div class="container">
        <div class="about-cta__content text-center" data-aos="zoom-in">
            <p class="about-cta__label"><?php echo $aboutData['business_from']['subtitle'] ?? 'Prêt à Commencer ?'; ?></p>
            <h2 class="about-cta__title"><?php echo $aboutData['business_from']['title'] ?? 'Lancez Votre Projet avec ETAAM'; ?></h2>
            <a href="<?php echo $aboutData['business_from']['button_url'] ?? 'contact.php'; ?>" class="about-cta__btn">
                <?php echo $aboutData['business_from']['button_text'] ?? 'Contactez-nous'; ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
