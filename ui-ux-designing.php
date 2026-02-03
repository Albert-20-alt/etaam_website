<?php
$pageTitle = "UI/UX Design | ETAAM | Design de Produits au Sénégal";
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
                    <i class="fas fa-pencil-ruler"></i>
                </div>
                <div
                    style="position: absolute; bottom: 30%; left: 10%; color: rgba(16, 185, 129, 0.25); font-size: 40px; animation: floatIcon 9s ease-in-out infinite reverse;">
                    <i class="fas fa-layer-group"></i>
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
                            <li class="active" style="color: #3B82F6;">Design de Produits</li>
                        </ul>
                    </nav>
                    <h1
                        style="font-size: 48px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #3B82F6 50%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        UI/UX Design & Prototypage
                    </h1>
                    <p style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                        Créez des expériences utilisateurs exceptionnelles et des interfaces intuitives qui captivent
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
                                    <i class="fas fa-magic" style="font-size: 30px; color: white;"></i>
                                </div>
                                <h3 style="color: white; font-size: 20px; margin-bottom: 10px;">Besoin d'un design ?
                                </h3>
                                <p style="color: rgba(255,255,255,0.85); margin-bottom: 20px;">Transformons vos idées en
                                    visuels</p>
                                <a href="tel:+221338888888"
                                    style="display: block; color: white; font-size: 22px; font-weight: 600; text-decoration: none;">+221
                                    33 888 88 88</a>
                            </div>

                            <!-- Download Button -->
                            <a href="contact.php"
                                style="display: block; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 18px 25px; border-radius: 12px; text-decoration: none; text-align: center; font-weight: 500; transition: all 0.3s ease;">
                                <i class="fas fa-palette" style="margin-right: 10px; color: #3B82F6;"></i>Demander une
                                maquette
                            </a>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="service-details__right">
                            <!-- Hero Image -->
                            <div
                                style="border-radius: 20px; overflow: hidden; margin-bottom: 40px; position: relative;">
                                <img src="assets/images/services/uiux-hero.png" alt="UI/UX Design"
                                    style="width: 100%; height: auto;">
                                <div
                                    style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 50%, rgba(15, 15, 35, 0.9) 100%);">
                                </div>
                            </div>

                            <!-- Content -->
                            <div style="margin-bottom: 40px;">
                                <h3 style="color: white; font-size: 32px; margin-bottom: 20px;">Conception Centrée sur
                                    l'Utilisateur</h3>
                                <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 20px;">
                                    L'apparence ne suffit plus. Chez ETAAM, nous concevons des produits numériques qui
                                    sont non seulement esthétiques, mais aussi intuitifs et efficaces. Notre approche du
                                    Design Thinking place l'utilisateur final au cœur du processus de création.
                                </p>
                                <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 20px;">
                                    De la recherche utilisateur au prototypage haute fidélité, nous créons des
                                    interfaces qui engagent votre audience et facilitent l'adoption de vos solutions
                                    technologiques.
                                </p>
                            </div>

                            <!-- Features Grid -->
                            <div class="row g-4 mb-5">
                                <div class="col-md-4">
                                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.3s ease;"
                                        class="feature-card">
                                        <div
                                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-users" style="font-size: 24px; color: white;"></i>
                                        </div>
                                        <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">Recherche UX
                                        </h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">Analyse des
                                            besoins, personas et parcours utilisateurs.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.3s ease;"
                                        class="feature-card">
                                        <div
                                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #10B981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-layer-group" style="font-size: 24px; color: white;"></i>
                                        </div>
                                        <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">Prototypage</h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">Wireframes
                                            et maquettes interactives testables.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.3s ease;"
                                        class="feature-card">
                                        <div
                                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-swatchbook" style="font-size: 24px; color: white;"></i>
                                        </div>
                                        <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">Design System
                                        </h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">Composants
                                            réutilisables pour une cohérence visuelle.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Process Section -->
                            <div
                                style="background: rgba(59, 130, 246, 0.1); border-radius: 20px; padding: 40px; margin-bottom: 40px;">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <img src="assets/images/services/uiux-process.png" alt="Processus de Design"
                                            style="width: 100%; border-radius: 16px;">
                                    </div>
                                    <div class="col-md-6">
                                        <h3 style="color: white; font-size: 24px; margin-bottom: 20px;">Notre Approche
                                            Créative</h3>
                                        <p style="color: rgba(255,255,255,0.7); margin-bottom: 20px;">Du concept à la
                                            réalité pixel-perfect.</p>
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            <li style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-search-plus"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Immersion & Recherche</span>
                                            </li>
                                            <li style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-pencil-alt"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Wireframing &
                                                    Architecture</span>
                                            </li>
                                            <li style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-paint-brush"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Design UI &
                                                    Interactions</span>
                                            </li>
                                            <li style="display: flex; align-items: center;">
                                                <div
                                                    style="width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-check-circle"
                                                        style="color: white; font-size: 12px;"></i>
                                                </div>
                                                <span style="color: rgba(255,255,255,0.8);">Tests Utilisateurs &
                                                    Itérations</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Section -->
                            <div>
                                <h3 style="color: white; font-size: 24px; margin-bottom: 25px;">Questions Design</h3>
                                <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion-1">
                                    <div class="accrodion active"
                                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; margin-bottom: 15px; overflow: hidden;">
                                        <div class="accrodion-title" style="padding: 20px 25px; cursor: pointer;">
                                            <h4 style="color: white; font-size: 16px; margin: 0;">Quels outils
                                                utilisez-vous ?</h4>
                                        </div>
                                        <div class="accrodion-content" style="padding: 0 25px 20px;">
                                            <p style="color: rgba(255,255,255,0.7); margin: 0;">Nous travaillons
                                                principalement avec Figma pour le design et le prototypage, et Adobe
                                                Creative Cloud (Illustrator, Photoshop) pour les assets graphiques.</p>
                                        </div>
                                    </div>
                                    <div class="accrodion"
                                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; margin-bottom: 15px; overflow: hidden;">
                                        <div class="accrodion-title" style="padding: 20px 25px; cursor: pointer;">
                                            <h4 style="color: white; font-size: 16px; margin: 0;">Livrez-vous un Design
                                                System ?</h4>
                                        </div>
                                        <div class="accrodion-content" style="padding: 0 25px 20px; display: none;">
                                            <p style="color: rgba(255,255,255,0.7); margin: 0;">Oui, pour assurer la
                                                cohérence et faciliter le développement futur, nous livrons une
                                                bibliothèque de composants documentée (Design System) avec chaque projet
                                                majeur.</p>
                                        </div>
                                    </div>
                                    <div class="accrodion"
                                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; overflow: hidden;">
                                        <div class="accrodion-title" style="padding: 20px 25px; cursor: pointer;">
                                            <h4 style="color: white; font-size: 16px; margin: 0;">Faites-vous uniquement
                                                du design ?</h4>
                                        </div>
                                        <div class="accrodion-content" style="padding: 0 25px 20px; display: none;">
                                            <p style="color: rgba(255,255,255,0.7); margin: 0;">Bien que ce service soit
                                                dédié au design, nous pouvons également prendre en charge l'intégration
                                                et le développement complet de l'application grâce à notre équipe
                                                technique.</p>
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
