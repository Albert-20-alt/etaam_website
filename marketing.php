<?php
$pageTitle = "Services Marketing Digital | ETAAM | Agence Marketing Sénégal";
$currentPage = "marketing";

// Load marketing data from database
require_once 'includes/db_connect.php';

$marketingData = [];
try {
    $stmt = $pdo->query("SELECT section, content FROM marketing_page_data");
    $raw = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
    foreach ($raw as $section => $json) {
        $marketingData[$section] = json_decode($json, true);
    }
} catch (PDOException $e) {
    // Silently fail and use default/static content
    error_log("Marketing page data fetch error: " . $e->getMessage());
}

// Helper function to get data with fallback
function getMarketingData($section, $key = null, $default = '') {
    global $marketingData;
    if (!isset($marketingData[$section])) return $default;
    if ($key === null) return $marketingData[$section];
    return $marketingData[$section][$key] ?? $default;
}

include 'includes/header.php';
?>

<!--Page Header Start-->
<section class="page-header"
    style="position: relative; overflow: hidden; padding: 200px 0 100px !important; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #2d1f4e 60%, #6A4C93 100%);">
    <!-- Background Asset -->
    <div style="position: absolute; inset: 0; overflow: hidden; opacity: 0.2;">
        <img src="assets/images/resources/marketing-hero.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    
    <!-- Animated Elements -->
    <div style="position: absolute; inset: 0; overflow: hidden;">
        <div style="position: absolute; top: 15%; left: 10%; width: 150px; height: 150px; background: radial-gradient(circle, rgba(0, 210, 211, 0.15), transparent 70%); border-radius: 50%; border: 1px solid rgba(0, 210, 211, 0.2); animation: float_circle 8s ease-in-out infinite;"></div>
        <div style="position: absolute; top: 60%; right: 5%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(106, 76, 147, 0.15), transparent 70%); border-radius: 50%; border: 1px solid rgba(106, 76, 147, 0.2); animation: float_circle 10s ease-in-out infinite reverse;"></div>
        <div style="position: absolute; bottom: 20%; left: 15%; width: 100px; height: 100px; background: radial-gradient(circle, rgba(255, 107, 107, 0.15), transparent 70%); border-radius: 50%; border: 1px solid rgba(255, 107, 107, 0.2); animation: float_circle 12s ease-in-out infinite;"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="page-header__inner text-center">
            <h1 style="font-size: 64px; font-weight: 800; margin-bottom: 25px; color: white; text-shadow: 0 4px 30px rgba(0,0,0,0.6);">
                <?php echo getMarketingData('hero', 'title', 'Marketing Digital<br><span style="background: linear-gradient(135deg, #00d2d3 0%, #6A4C93 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Qui Convertit</span>'); ?>
            </h1>
            <p style="color: rgba(255,255,255,0.85); font-size: 22px; max-width: 900px; margin: 0 auto 40px; line-height: 1.7;">
                <?php echo getMarketingData('hero', 'subtitle', 'Propulsez votre marque au sommet avec des stratégies digitales innovantes et orientées résultats.'); ?>
            </p>
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo getMarketingData('hero', 'cta1_url', 'contact.php'); ?>" class="thm-btn" style="background: linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%); padding: 18px 45px; border-radius: 30px; font-size: 16px; font-weight: 600; box-shadow: 0 15px 40px rgba(106, 76, 147, 0.4);">
                    <?php echo getMarketingData('hero', 'cta1_text', 'Démarrer Votre Projet'); ?>
                    <i class="fas fa-rocket" style="margin-left: 10px;"></i>
                </a>
                <a href="<?php echo getMarketingData('hero', 'cta2_url', '#services'); ?>" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); padding: 18px 45px; border-radius: 30px; font-size: 16px; font-weight: 600; color: white; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <?php echo getMarketingData('hero', 'cta2_text', 'Explorer Nos Services'); ?>
                    <i class="fas fa-arrow-down" style="margin-left: 10px;"></i>
                </a>
            </div>
        </div>
    </div>

    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100px; overflow: hidden;">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 100%;">
            <path d="M0,60 C150,120 350,0 600,60 C850,120 1050,0 1200,60 L1200,120 L0,120 Z" fill="#0f0f23"></path>
        </svg>
    </div>

    <style>
        @keyframes float_circle {
            0%, 100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-40px) rotate(10deg); }
        }
    </style>
</section>
<!--Page Header End-->

<!--Stats Section Start-->
<section style="padding: 80px 0; background-color: #0f0f23;">
    <div class="container">
        <div class="row g-4 text-center">
            <?php for($i = 1; $i <= 4; $i++): ?>
            <div class="col-lg-3 col-md-6">
                <div style="padding: 30px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='<?php echo getMarketingData('stats', 'stat'.$i.'_color', '#6A4C93'); ?>'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'">
                    <div style="font-size: 48px; font-weight: 800; color: <?php echo getMarketingData('stats', 'stat'.$i.'_color', '#6A4C93'); ?>; margin-bottom: 10px;"><?php echo getMarketingData('stats', 'stat'.$i.'_value', ''); ?></div>
                    <div style="color: rgba(255,255,255,0.7); font-size: 16px;"><?php echo getMarketingData('stats', 'stat'.$i.'_label', ''); ?></div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<!--Stats Section End-->

<!--Marketing Services Start-->
<section id="services" style="padding: 120px 0; background: linear-gradient(180deg, #0f0f23 0%, #1a1a2e 100%);">
    <div class="container">
        <div class="section-title text-center mb-5">
            <span style="color: #6A4C93; text-transform: uppercase; letter-spacing: 3px; font-weight: 700; font-size: 14px;">NOS EXPERTISES MARKETING</span>
            <h2 style="color: white; font-size: 48px; margin-top: 15px; font-weight: 800;">Solutions Marketing Complètes</h2>
            <p style="color: rgba(255,255,255,0.6); max-width: 700px; margin: 20px auto 0; font-size: 18px; line-height: 1.8;">
                De la stratégie à l'exécution, nous vous accompagnons à chaque étape de votre croissance digitale.
            </p>
        </div>
        
        <div class="row g-4">
            <?php for($i = 1; $i <= 6; $i++): 
                $service = getMarketingData('services', 'service'.$i, []);
                $delays = ['100ms', '200ms', '300ms', '400ms', '500ms', '600ms'];
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delays[$i-1]; ?>">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 45px 35px; height: 100%; transition: all 0.4s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='<?php echo $service['color'] ?? '#6A4C93'; ?>'; this.style.transform='translateY(-12px)'; this.style.boxShadow='0 20px 60px rgba(106, 76, 147, 0.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: 0; right: 0; width: 150px; height: 150px; background: radial-gradient(circle, rgba(106, 76, 147, 0.1), transparent 70%); border-radius: 50%;"></div>
                    <div style="width: 70px; height: 70px; background: <?php echo $service['color'] ?? '#6A4C93'; ?>33; border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 30px; position: relative; z-index: 2;">
                        <i class="<?php echo $service['icon'] ?? 'fas fa-star'; ?>" style="font-size: 32px; color: <?php echo $service['color'] ?? '#6A4C93'; ?>;"></i>
                    </div>
                    <h3 style="color: white; font-size: 24px; margin-bottom: 20px; font-weight: 700;"><?php echo $service['title'] ?? ''; ?></h3>
                    <p style="color: rgba(255,255,255,0.65); line-height: 1.8; margin-bottom: 25px;">
                        <?php echo $service['description'] ?? ''; ?>
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php for($f = 1; $f <= 3; $f++): ?>
                        <li style="color: rgba(255,255,255,0.6); <?php echo $f < 3 ? 'margin-bottom: 12px;' : ''; ?> display: flex; align-items: center;">
                            <i class="fas fa-check" style="color: <?php echo $service['color'] ?? '#6A4C93'; ?>; margin-right: 12px; font-size: 12px;"></i>
                            <span><?php echo $service['feature'.$f] ?? ''; ?></span>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<!--Marketing Services End-->

<!--Process Section Start-->
<section style="padding: 120px 0; background-color: #0f0f23;">
    <div class="container">
        <div class="section-title text-center mb-5">
            <span style="color: #00d2d3; text-transform: uppercase; letter-spacing: 3px; font-weight: 700; font-size: 14px;">NOTRE PROCESSUS</span>
            <h2 style="color: white; font-size: 48px; margin-top: 15px; font-weight: 800;">Comment Nous Travaillons</h2>
        </div>

        <div class="row g-4 mt-4">
            <?php for($i = 1; $i <= 4; $i++): ?>
            <div class="col-lg-3 col-md-6">
                <div style="text-align: center; <?php echo $i > 1 ? '' : 'position: relative;'; ?>">
                    <div style="width: 100px; height: 100px; background: <?php echo getMarketingData('process', 'step'.$i.'_color', 'linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%)'); ?>; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 40px rgba(106, 76, 147, 0.4);">
                        <span style="color: white; font-size: 36px; font-weight: 800;"><?php echo $i; ?></span>
                    </div>
                    <h4 style="color: white; font-size: 20px; margin-bottom: 15px; font-weight: 700;"><?php echo getMarketingData('process', 'step'.$i.'_title', ''); ?></h4>
                    <p style="color: rgba(255,255,255,0.6); line-height: 1.7;"><?php echo getMarketingData('process', 'step'.$i.'_description', ''); ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<!--Process Section End-->

<!--Testimonials Section Start-->
<section style="padding: 120px 0; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); position: relative; overflow: hidden;">
    <!-- Background Decor -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(106, 76, 147, 0.1), transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(0, 210, 211, 0.1), transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="section-title text-center mb-5">
            <span style="color: #FF6B6B; text-transform: uppercase; letter-spacing: 3px; font-weight: 700; font-size: 14px;">TÉMOIGNAGES</span>
            <h2 style="color: white; font-size: 48px; margin-top: 15px; font-weight: 800;">Ce que disent nos clients</h2>
        </div>

        <div class="row g-4 mt-4">
            <?php for($i = 1; $i <= 3; $i++): 
                $testimonial = getMarketingData('testimonials', 'testimonial'.$i, []);
                $stars = str_repeat('★', $testimonial['rating'] ?? 5);
            ?>
            <div class="col-lg-4 col-md-6">
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 35px; backdrop-filter: blur(10px);">
                    <div style="color: #F59E0B; font-size: 28px; margin-bottom: 20px;"><?php echo $stars; ?></div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 25px; font-style: italic;">
                        "<?php echo $testimonial['quote'] ?? ''; ?>"
                    </p>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 50px; height: 50px; background: <?php echo $testimonial['color'] ?? 'linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%)'; ?>; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="color: white; font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="color: white; font-weight: 700; margin-bottom: 3px;"><?php echo $testimonial['name'] ?? ''; ?></div>
                            <div style="color: rgba(255,255,255,0.5); font-size: 14px;"><?php echo $testimonial['role'] ?? ''; ?>, <?php echo $testimonial['company'] ?? ''; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<!--Testimonials Section End-->

<!--CTA Section Start-->
<section style="padding: 100px 0; background: linear-gradient(135deg, #6A4C93 0%, #8B5CF6 50%, #00d2d3 100%); position: relative; overflow: hidden;">
    <!-- Animated background elements -->
    <div style="position: absolute; inset: 0; overflow: hidden; opacity: 0.1;">
        <div style="position: absolute; top: 20%; left: 10%; width: 200px; height: 200px; background: white; border-radius: 50%; animation: float_circle 10s ease-in-out infinite;"></div>
        <div style="position: absolute; bottom: 20%; right: 15%; width: 150px; height: 150px; background: white; border-radius: 50%; animation: float_circle 12s ease-in-out infinite reverse;"></div>
    </div>

    <div class="container text-center" style="position: relative; z-index: 2;">
        <h2 style="color: white; font-size: 52px; font-weight: 800; margin-bottom: 25px; text-shadow: 0 4px 20px rgba(0,0,0,0.2);">
            <?php echo getMarketingData('cta', 'title', 'Prêt à Transformer Votre Marketing ?'); ?>
        </h2>
        <p style="color: rgba(255,255,255,0.9); font-size: 20px; max-width: 700px; margin: 0 auto 40px; line-height: 1.7;">
            <?php echo getMarketingData('cta', 'description', 'Discutons de votre projet et découvrez comment nous pouvons propulser votre marque vers de nouveaux sommets.'); ?>
        </p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo getMarketingData('cta', 'button1_url', 'contact.php'); ?>" style="background: white; color: #6A4C93; padding: 20px 50px; border-radius: 30px; font-size: 18px; font-weight: 700; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 10px 40px rgba(0,0,0,0.2);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 50px rgba(0,0,0,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.2)'">
                <?php echo getMarketingData('cta', 'button1_text', 'Demander un Devis Gratuit'); ?>
                <i class="fas fa-arrow-right" style="margin-left: 12px;"></i>
            </a>
            <a href="<?php echo getMarketingData('cta', 'button2_url', 'marketing-forum.php'); ?>" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 2px solid white; color: white; padding: 20px 50px; border-radius: 30px; font-size: 18px; font-weight: 700; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                <?php echo getMarketingData('cta', 'button2_text', 'Rejoindre la Communauté'); ?>
            </a>
        </div>
    </div>
</section>
<!--CTA Section End-->

<?php include 'includes/footer.php'; ?>
