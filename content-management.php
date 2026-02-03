<?php
$pageTitle = "Solutions AgriTech | ETAAM | Innovation Agricole au Sénégal";
$currentPage = "services";
include 'includes/header.php';
?>

<!--Page Header Start-->
        <section class="page-header"
            style="position: relative; overflow: hidden; padding: 120px 0 100px; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #1E3A5F 60%, #3B82F6 100%);">
            <!-- Animated Background -->
            <div style="position: absolute; inset: 0; overflow: hidden;">
                <div
                    style="position: absolute; top: 10%; left: 5%; width: 120px; height: 120px; background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;">
                </div>
                <div
                    style="position: absolute; top: 60%; right: 10%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(16, 185, 129, 0.2), transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;">
                </div>
                <div
                    style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px;">
                </div>
                <div
                    style="position: absolute; top: 25%; right: 15%; color: rgba(59, 130, 246, 0.2); font-size: 50px; animation: floatIcon 7s ease-in-out infinite;">
                    <i class="fas fa-tractor"></i>
                </div>
                <div
                    style="position: absolute; bottom: 30%; left: 10%; color: rgba(16, 185, 129, 0.25); font-size: 40px; animation: floatIcon 9s ease-in-out infinite reverse;">
                    <i class="fas fa-leaf"></i>
                </div>
            </div>

            <div class="container" style="position: relative; z-index: 2;">
                <div class="page-header__inner text-center">
                    <nav style="margin-bottom: 25px;">
                        <ul class="thm-breadcrumb list-unstyled"
                            style="display: flex; justify-content: center; align-items: center; gap: 10px; margin: 0;">
                            <li><a href="index.php"
                                    style="color: rgba(255,255,255,0.7); text-decoration: none;">Accueil</a></li>
                            <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                            <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none;">Services</a>
                            </li>
                            <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                            <li class="active" style="color: #3B82F6;">Solutions AgriTech</li>
                        </ul>
                    </nav>
                    <h1
                        style="font-size: 48px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #3B82F6 50%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Innovation pour l'Agriculture
                    </h1>
                    <p style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                        La technologie au service de la sécurité alimentaire et de l'agriculture durable
                    </p>
                </div>
            </div>

            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 80px;">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 100%;">
                    <path d="M0,60 C150,120 350,0 600,60 C850,120 1050,0 1200,60 L1200,120 L0,120 Z" fill="#0f0f23">
                    </path>
                </svg>
            </div>

            <style>
                @keyframes float {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-20px);
                    }
                }

                @keyframes floatIcon {

                    0%,
                    100% {
                        transform: translateY(0) scale(1);
                        opacity: 0.2;
                    }

                    50% {
                        transform: translateY(-15px) scale(1.1);
                        opacity: 0.35;
                    }
                }
            </style>
        </section>
        <!--Page Header End-->

        <!--Service Details Start-->
        <section class="service-details"
            style="background: linear-gradient(180deg, #0f0f23 0%, #1a1a2e 100%); padding: 80px 0;">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="service-details__left">
                            <!-- Services List -->
                            <div class="service-details__service"
                                style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 30px; margin-bottom: 30px;">
                                <h3 class="service-details__title"
                                    style="color: white; font-size: 22px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #3B82F6;">
                                    Nos Services</h3>
                                <ul class="service-details__service-list list-unstyled" style="margin: 0;">
                                    <?php 
                                    if (!isset($services)) { include 'includes/services_data.php'; }
                                    $current_page = basename($_SERVER['PHP_SELF']);
                                    foreach ($services as $service): 
                                        $isActive = ($current_page == $service['link']);
                                        $liClass = $isActive ? 'active' : '';
                                        $liStyle = $isActive ? '' : 'margin-bottom: 12px;';
                                        $aStyle = $isActive 
                                            ? 'display: flex; align-items: center; justify-content: space-between; background: linear-gradient(135deg, #3B82F6 0%, #1E3A5F 100%); color: white; padding: 15px 20px; border-radius: 10px; text-decoration: none; font-weight: 500;' 
                                            : 'display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.8); padding: 15px 20px; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;';
                                    ?>
                                    <li class="<?php echo $liClass; ?>" style="<?php echo $liStyle; ?>">
                                        <a href="<?php echo $service['link']; ?>" style="<?php echo $aStyle; ?>">
                                            <?php echo $service['title']; ?> <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Contact Card -->
                            <div
                                style="background: linear-gradient(135deg, #3B82F6 0%, #1E3A5F 100%); border-radius: 20px; padding: 40px 30px; text-align: center; margin-bottom: 30px;">
                                <div
                                    style="width: 70px; height: 70px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                    <i class="fas fa-seedling" style="font-size: 30px; color: white;"></i>
                                </div>
                                <h3 style="color: white; font-size: 20px; margin-bottom: 10px;">Un projet agricole ?
                                </h3>
                                <p style="color: rgba(255,255,255,0.85); margin-bottom: 20px;">Digitalisez votre
                                    exploitation</p>
                                <a href="tel:+221338888888"
                                    style="display: block; color: white; font-size: 22px; font-weight: 600; text-decoration: none;">+221
                                    33 888 88 88</a>
                            </div>

                            <!-- Download Button -->
                            <a href="contact.php"
                                style="display: block; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 18px 25px; border-radius: 12px; text-decoration: none; text-align: center; font-weight: 500; transition: all 0.3s ease;">
                                <i class="fas fa-file-alt" style="margin-right: 10px; color: #3B82F6;"></i>Découvrir nos
                                solutions
                            </a>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="service-details__right">
                            <!-- Hero Image -->
                            <div
                                style="border-radius: 20px; overflow: hidden; margin-bottom: 40px; position: relative;">
                                <img src="assets/images/services/agritech-hero.png"
                                    alt="Solutions AgriTech et Innovation Rurale" style="width: 100%; height: auto;">
                                <div
                                    style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 50%, rgba(15, 15, 35, 0.9) 100%);">
                                </div>
                            </div>

                            <!-- Content -->
                            <div style="margin-bottom: 40px;">
                                <h3 style="color: white; font-size: 32px; margin-bottom: 20px;">Cultiver l'Avenir avec
                                    le Numérique</h3>
                                <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 20px;">
                                    L'AgriTech est au cœur de la stratégie d'ETAAM, particulièrement dans notre région
                                    de Casamance au fort potentiel agricole. Nous développons des outils numériques pour
                                    aider les agriculteurs, coopératives et agro-industriels à produire mieux et plus
                                    efficacement.
                                </p>
                                <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 20px;">
                                    Nos solutions couvrent toute la chaîne de valeur, de la gestion parcellaire à la
                                    connexion avec les marchés, en passant par l'optimisation des intrants et la
                                    traçabilité des produits.
                                </p>
                            </div>

                            <!-- Features Grid -->
                            <div class="row g-4 mb-5">
                                <div class="col-md-4">
                                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.3s ease;"
                                        class="feature-card">
                                        <div
                                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-clipboard-list" style="font-size: 24px; color: white;"></i>
                                        </div>
                                        <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">Gestion de Ferme
                                        </h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">Logiciels
                                            de suivi d'exploitation simple et intuitifs.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.3s ease;"
                                        class="feature-card">
                                        <div
                                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #10B981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-broadcast-tower"
                                                style="font-size: 24px; color: white;"></i>
                                        </div>
                                        <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">IoT & Capteurs
                                        </h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">
                                            Surveillance météo et irrigation connectée.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.3s ease;"
                                        class="feature-card">
                                        <div
                                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-truck-moving" style="font-size: 24px; color: white;"></i>
                                        </div>
                                        <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">Supply Chain
                                        </h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">Traçabilité
                                            et accès aux marchés.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Process Section -->
                            <div
                                style="background: rgba(59, 130, 246, 0.1); border-radius: 20px; padding: 40px; margin-bottom: 40px;">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <img src="assets/images/services/agritech-team.png" alt="Équipe AgriTech ETAAM"
                                            style="width: 100%; border-radius: 16px;">
                                    </div>
                                    <div class="col-md-6">
                                        <h3 style="color: white; font-size: 24px; margin-bottom: 20px;">Notre Approche
                                            Terrain</h3>
                                        <p style="color: rgba(255,255,255,0.7); margin-bottom: 20px;">Des solutions
                                            conçues avec les producteurs.</p>
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            <li style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-hand-holding-water"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Diagnostic
                                                    Agronomique</span>
                                            </li>
                                            <li style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-code" style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Développement Solution
                                                    Adaptée</span>
                                            </li>
                                            <li style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-chalkboard-teacher"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Formation des
                                                    Utilisateurs</span>
                                            </li>
                                            <li style="display: flex; align-items: center;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-chart-line"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Suivi de l'Impact</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Section -->
                            <div>
                                <h3 style="color: white; font-size: 24px; margin-bottom: 25px;">Questions AgriTech</h3>
                                <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion-1">
                                    <div class="accrodion active"
                                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; margin-bottom: 15px; overflow: hidden;">
                                        <div class="accrodion-title" style="padding: 20px 25px; cursor: pointer;">
                                            <h4 style="color: white; font-size: 16px; margin: 0;">Vos solutions
                                                fonctionnent-elles sans internet ?</h4>
                                        </div>
                                        <div class="accrodion-content" style="padding: 0 25px 20px;">
                                            <p style="color: rgba(255,255,255,0.7); margin: 0;">Oui, la majorité de nos
                                                applications mobiles sont conçues en mode "Offline-First". Elles
                                                stockent les données localement et se synchronisent dès qu'une connexion
                                                est disponible.</p>
                                        </div>
                                    </div>
                                    <div class="accrodion"
                                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; margin-bottom: 15px; overflow: hidden;">
                                        <div class="accrodion-title" style="padding: 20px 25px; cursor: pointer;">
                                            <h4 style="color: white; font-size: 16px; margin: 0;">À qui s'adressent ces
                                                outils ?</h4>
                                        </div>
                                        <div class="accrodion-content" style="padding: 0 25px 20px; display: none;">
                                            <p style="color: rgba(255,255,255,0.7); margin: 0;">Nos solutions
                                                s'adressent aux coopératives agricoles, aux entreprises
                                                agro-industrielles, aux exportateurs, ainsi qu'aux projets de
                                                développement rural cherchant à professionnaliser leurs filières.</p>
                                        </div>
                                    </div>
                                    <div class="accrodion"
                                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; overflow: hidden;">
                                        <div class="accrodion-title" style="padding: 20px 25px; cursor: pointer;">
                                            <h4 style="color: white; font-size: 16px; margin: 0;">Faites-vous de
                                                l'analyse de sols ?</h4>
                                        </div>
                                        <div class="accrodion-content" style="padding: 0 25px 20px; display: none;">
                                            <p style="color: rgba(255,255,255,0.7); margin: 0;">Nous collaborons avec
                                                des laboratoires partenaires pour l'analyse physique, mais nous
                                                fournissons la plateforme numérique pour interpréter ces données et
                                                générer des recommandations personnalisées.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .feature-card:hover {
                    transform: translateY(-5px);
                    border-color: rgba(59, 130, 246, 0.3);
                }

                .service-details__service-list li a:hover {
                    background: rgba(255, 255, 255, 0.1) !important;
                }
            </style>
        </section>
        <!--Service Details End-->

<?php include 'includes/footer.php'; ?>
