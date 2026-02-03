<?php
$pageTitle = "Marketing Communication & Forum | ETAAM | Experts du Numérique";
$currentPage = "marketing-forum";
include 'includes/header.php';
require_once 'includes/db_connect.php';

// Fetch Marketing Data
$marketingData = [];
try {
    $stmt = $pdo->query("SELECT section, content FROM marketing_page_data");
    $raw = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
    foreach ($raw as $section => $json) {
        $marketingData[$section] = json_decode($json, true);
    }
} catch (PDOException $e) {
    error_log("Marketing data fetch error: " . $e->getMessage());
}

// Helper function
function getMktData($section, $key = null, $default = '') {
    global $marketingData;
    if (!isset($marketingData[$section])) return $default;
    if ($key === null) return $marketingData[$section];
    return $marketingData[$section][$key] ?? $default;
}

// Default fallbacks (from original file) if DB is empty for a specific key
$heroTitle = getMktData('hero', 'title', 'Marketing & Communauté');
$heroSubtitle = getMktData('hero', 'subtitle', 'Propulsez votre marque et échangez avec les experts du digital au Sénégal.');
$cta1Text = getMktData('hero', 'cta1_text', 'Lancer un Projet');
$cta1Url = getMktData('hero', 'cta1_url', 'contact.php');
$cta2Text = getMktData('hero', 'cta2_text', 'Nos Services');
$cta2Url = getMktData('hero', 'cta2_url', '#solutions');

// Services - we only show 3 in the original layout, but DB has 6. We'll try to show first 3.
$s1_title = getMktData('services', 'service1_title', 'Stratégie Digitale');
$s1_desc = getMktData('services', 'service1_description', 'Développement de plans de communication sur mesure...');
$s1_icon = getMktData('services', 'service1_icon', 'fas fa-bullseye');
$s1_color = getMktData('services', 'service1_color', '#6A4C93');

$s2_title = getMktData('services', 'service2_title', 'Gestion de Marque');
$s2_desc = getMktData('services', 'service2_description', 'Création d\'identité visuelle forte...');
$s2_icon = getMktData('services', 'service2_icon', 'fas fa-hashtag');
$s2_color = getMktData('services', 'service2_color', '#00d2d3');

$s3_title = getMktData('services', 'service3_title', 'Campagnes Ads');
$s3_desc = getMktData('services', 'service3_description', 'Optimisation de vos investissements publicitaires...');
$s3_icon = getMktData('services', 'service3_icon', 'fas fa-chart-line');
$s3_color = getMktData('services', 'service3_color', '#FF6B6B');

// Bottom CTA
$ctaBottomTitle = getMktData('cta', 'title', 'Prêt à booster votre communication ?');
$ctaBottomBtnText = getMktData('cta', 'button1_text', 'Lancer un Projet');
$ctaBottomBtnUrl = getMktData('cta', 'button1_url', 'contact.php');

?>

<!--Page Header Start-->
<section class="page-header"
    style="position: relative; overflow: hidden; padding: 180px 0 80px !important; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #2d1f4e 60%, #6A4C93 100%);">
    <!-- Background Asset -->
    <div style="position: absolute; inset: 0; overflow: hidden; opacity: 0.3;">
        <img src="assets/images/resources/marketing-forum-hero.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    
    <!-- Animated Elements -->
    <div style="position: absolute; inset: 0; overflow: hidden;">
        <div style="position: absolute; top: 10%; left: 5%; width: 120px; height: 120px; background: radial-gradient(circle, rgba(0, 210, 211, 0.1), transparent 70%); border-radius: 50%; border: 1px solid rgba(0, 210, 211, 0.1); animation: float_circle 8s ease-in-out infinite;"></div>
        <div style="position: absolute; bottom: 10%; right: 5%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(106, 76, 147, 0.1), transparent 70%); border-radius: 50%; border: 1px solid rgba(106, 76, 147, 0.1); animation: float_circle 10s ease-in-out infinite reverse;"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="page-header__inner text-center">
            <h1 style="font-size: 56px; font-weight: 800; margin-bottom: 20px; color: white; text-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                <?php echo $heroTitle; ?>
            </h1>
            <p style="color: rgba(255,255,255,0.8); font-size: 20px; max-width: 800px; margin: 0 auto; line-height: 1.6;">
                <?php echo $heroSubtitle; ?>
            </p>
        </div>
    </div>

    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 80px; overflow: hidden;">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 100%;">
            <path d="M0,60 C150,120 350,0 600,60 C850,120 1050,0 1200,60 L1200,120 L0,120 Z" fill="#0f0f23"></path>
        </svg>
    </div>

    <style>
        @keyframes float_circle {
            0%, 100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        /* Mobile Responsive Styles */
        @media (max-width: 767px) {
            /* Hero Section Mobile */
            .page-header {
                padding: 140px 0 60px !important;
            }
            
            .page-header h1 {
                font-size: 36px !important;
                margin-bottom: 15px !important;
                text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
            }
            
            .page-header p {
                font-size: 16px !important;
                line-height: 1.5 !important;
                padding: 0 15px;
            }
            
            /* Marketing Services Section Mobile */
            .marketing-services {
                padding: 60px 0 !important;
            }
            
            .marketing-services h2 {
                font-size: 28px !important;
            }
            
            .marketing-services .col-xl-4 > div {
                padding: 30px 20px !important;
            }
            
            /* Community Forum Section Mobile */
            .community-forum {
                padding: 60px 0 !important;
            }
            
            .community-forum h2 {
                font-size: 32px !important;
                margin-bottom: 20px !important;
            }
            
            .community-forum p {
                font-size: 16px !important;
            }
            
            .community-forum ul li {
                font-size: 14px !important;
            }
        }
        
        @media (max-width: 480px) {
            .page-header h1 {
                font-size: 32px !important;
            }
            
            .community-forum h2 {
                font-size: 28px !important;
            }
        }
    </style>
</section>
<!--Page Header End-->

<!--Marketing Services Start-->
<section class="marketing-services" id="solutions" style="padding: 100px 0; background-color: #0f0f23;">
    <div class="container">
        <div class="section-title text-center mb-5">
            <span style="color: #6A4C93; text-transform: uppercase; letter-spacing: 2px; font-weight: 600;">NOS SOLUTIONS MARKETING</span>
            <h2 style="color: white; font-size: 36px; margin-top: 10px;">Une Communication Digitale Impactante</h2>
        </div>
        
        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 40px 30px; height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='<?php echo $s1_color; ?>'; this.style.transform='translateY(-10px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; background: <?php echo $s1_color; ?>33; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                        <i class="<?php echo $s1_icon; ?>" style="font-size: 24px; color: <?php echo $s1_color; ?>;"></i>
                    </div>
                    <h4 style="color: white; font-size: 22px; margin-bottom: 15px;"><?php echo $s1_title; ?></h4>
                    <p style="color: rgba(255,255,255,0.6); line-height: 1.7;"><?php echo $s1_desc; ?></p>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay="200ms">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 40px 30px; height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='<?php echo $s2_color; ?>'; this.style.transform='translateY(-10px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; background: <?php echo $s2_color; ?>33; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                        <i class="<?php echo $s2_icon; ?>" style="font-size: 24px; color: <?php echo $s2_color; ?>;"></i>
                    </div>
                    <h4 style="color: white; font-size: 22px; margin-bottom: 15px;"><?php echo $s2_title; ?></h4>
                    <p style="color: rgba(255,255,255,0.6); line-height: 1.7;"><?php echo $s2_desc; ?></p>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay="300ms">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 40px 30px; height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='<?php echo $s3_color; ?>'; this.style.transform='translateY(-10px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; background: <?php echo $s3_color; ?>33; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                        <i class="<?php echo $s3_icon; ?>" style="font-size: 24px; color: <?php echo $s3_color; ?>;"></i>
                    </div>
                    <h4 style="color: white; font-size: 22px; margin-bottom: 15px;"><?php echo $s3_title; ?></h4>
                    <p style="color: rgba(255,255,255,0.6); line-height: 1.7;"><?php echo $s3_desc; ?></p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="marketing.php" class="thm-btn" style="background: linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%); display: inline-block; padding: 16px 40px; border-radius: 30px; color: white; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(106, 76, 147, 0.3);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 40px rgba(106, 76, 147, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(106, 76, 147, 0.3)'">
                Découvrez Tous Nos Services Marketing
                <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
            </a>
        </div>
    </div>
</section>
<!--Marketing Services End-->

<!--Community Forum Start-->
<section class="community-forum" id="forum" style="padding: 100px 0; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); position: relative; overflow: hidden;">
    <!-- Abstract Background Decor -->
    <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(106, 76, 147, 0.1), transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(0, 210, 211, 0.1), transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="forum-content">
                    <h2 style="color: white; font-size: 42px; font-weight: 700; margin-bottom: 25px;">Le Forum ETAAM <br><span style="color: #00d2d3;">La Voix des Experts</span></h2>
                    <p style="color: rgba(255,255,255,0.7); font-size: 18px; line-height: 1.8; margin-bottom: 30px;">
                        Rejoignez notre espace d'échange dédié à l'innovation technologique au Sénégal. Posez vos questions, partagez vos projets et recevez des conseils de notre communauté d'experts.
                    </p>
                    
                    <ul style="list-style: none; padding: 0; margin-bottom: 40px;">
                        <li style="display: flex; align-items: center; margin-bottom: 15px; color: white;">
                            <i class="fas fa-check-circle" style="color: #6A4C93; margin-right: 15px; font-size: 20px;"></i>
                            <span>Discussions Tech & Développement</span>
                        </li>
                        <li style="display: flex; align-items: center; margin-bottom: 15px; color: white;">
                            <i class="fas fa-check-circle" style="color: #6A4C93; margin-right: 15px; font-size: 20px;"></i>
                            <span>Espace Entreprenariat & Innovation</span>
                        </li>
                        <li style="display: flex; align-items: center; color: white;">
                            <i class="fas fa-check-circle" style="color: #6A4C93; margin-right: 15px; font-size: 20px;"></i>
                            <span>Feedback sur vos Projets Digitaux</span>
                        </li>
                    </ul>
                    
                    <div class="marketing-cta mt-4">
                        <a href="forum.php" class="thm-btn forum-btn-accent" style="background: linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%);">Accéder au Forum</a>
                        <a href="#solutions" style="display: inline-flex; align-items: center; color: white; text-decoration: none; font-weight: 500; transition: all 0.3s ease;" onmouseover="this.style.color='#00d2d3'" onmouseout="this.style.color='white'">
                            <span>En savoir plus</span>
                            <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <!-- Forum UI Mockup -->
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 10px; box-shadow: 0 30px 60px rgba(0,0,0,0.5); backdrop-filter: blur(10px);">
                    <!-- Header of Mockup -->
                    <div style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <div style="width: 12px; height: 12px; background: #FF5F56; border-radius: 50%;"></div>
                        <div style="width: 12px; height: 12px; background: #FFBD2E; border-radius: 50%;"></div>
                        <div style="width: 12px; height: 12px; background: #27C93F; border-radius: 50%;"></div>
                        <div style="flex: 1; text-align: center; color: rgba(255,255,255,0.3); font-size: 12px;">forum.etaam.sn</div>
                    </div>
                    
                    <!-- Content of Mockup -->
                    <div style="padding: 20px;">
                        <!-- Category 1 -->
                        <a href="forum.php" style="text-decoration: none; display: block;">
                            <div style="background: rgba(255,255,255,0.02); border-left: 4px solid #6A4C93; padding: 15px; border-radius: 4px; margin-bottom: 15px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='rgba(255,255,255,0.02)'">
                                <h5 style="color: white; font-size: 14px; margin-bottom: 5px;">Comment optimiser mon site WordPress ?</h5>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 11px; color: rgba(255,255,255,0.4);"><i class="far fa-user me-1"></i> Modou Diop • Il y a 2h</span>
                                    <span style="background: rgba(106, 76, 147, 0.2); color: #6A4C93; font-size: 10px; padding: 2px 8px; border-radius: 10px;">TECH</span>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Category 2 -->
                        <a href="forum.php" style="text-decoration: none; display: block;">
                            <div style="background: rgba(255,255,255,0.02); border-left: 4px solid #00d2d3; padding: 15px; border-radius: 4px; margin-bottom: 15px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='rgba(255,255,255,0.02)'">
                                <h5 style="color: white; font-size: 14px; margin-bottom: 5px;">Tendances du UI Design en 2026</h5>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 11px; color: rgba(255,255,255,0.4);"><i class="far fa-user me-1"></i> Awa Ndiaye • Hier</span>
                                    <span style="background: rgba(0, 210, 211, 0.2); color: #00d2d3; font-size: 10px; padding: 2px 8px; border-radius: 10px;">DESIGN</span>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Category 3 -->
                        <a href="forum.php" style="text-decoration: none; display: block;">
                            <div style="background: rgba(255,255,255,0.02); border-left: 4px solid #FF6B6B; padding: 15px; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='rgba(255,255,255,0.02)'">
                                <h5 style="color: white; font-size: 14px; margin-bottom: 5px;">Recrutement : Session Questions/Réponses</h5>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 11px; color: rgba(255,255,255,0.4);"><i class="far fa-user me-1"></i> ETAAM Bot • En cours</span>
                                    <span style="background: rgba(255, 107, 107, 0.2); color: #FF6B6B; font-size: 10px; padding: 2px 8px; border-radius: 10px;">EVENT</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Community Forum End-->

<!--CTA Sections-->
<section style="padding: 60px 0; background-color: #0f0f23; border-top: 1px solid rgba(255,255,255,0.05);">
    <div class="container text-center">
        <h3 style="color: white; font-size: 28px; margin-bottom: 30px;"><?php echo $ctaBottomTitle; ?></h3>
        <a href="<?php echo $ctaBottomBtnUrl; ?>" class="thm-btn"><?php echo $ctaBottomBtnText; ?></a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
