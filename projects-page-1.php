<?php
$pageTitle = "Nos Projets | ETAAM";
$currentPage = "projects";
include 'includes/header.php';
?>

<!--Page Header Start-->
        <section class="page-header"
            style="position: relative; overflow: hidden; padding: 120px 0 100px; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #8B5CF6 60%, #6A4C93 100%);">
            <!-- Animated Background -->
            <div style="position: absolute; inset: 0; overflow: hidden;">
                <div
                    style="position: absolute; top: 10%; left: 5%; width: 120px; height: 120px; background: radial-gradient(circle, rgba(139, 92, 246, 0.15), transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;">
                </div>
                <div
                    style="position: absolute; top: 60%; right: 10%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(106, 76, 147, 0.2), transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;">
                </div>
                <div
                    style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px;">
                </div>
                <!-- Floating Icons -->
                <div
                    style="position: absolute; top: 25%; right: 15%; color: rgba(139, 92, 246, 0.2); font-size: 50px; animation: floatIcon 7s ease-in-out infinite;">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <div
                    style="position: absolute; bottom: 30%; left: 10%; color: rgba(106, 76, 147, 0.25); font-size: 40px; animation: floatIcon 9s ease-in-out infinite reverse;">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>

            <div class="container" style="position: relative; z-index: 2;">
                <div class="page-header__inner text-center">
                    <ul class="thm-breadcrumb list-unstyled"
                        style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-bottom: 25px;">
                        <li><a href="index.php"
                                style="color: rgba(255,255,255,0.7); text-decoration: none;">Accueil</a></li>
                        <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                        <li class="active" style="color: #8B5CF6;">Nos Projets</li>
                    </ul>
                    <h1
                        style="font-size: 48px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #8B5CF6 50%, #EC4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Nos Réalisations
                    </h1>
                    <p style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                        Découvrez comment nous transformons les défis en opportunités numériques.
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

        <!--Blog Sidebar Start-->
        <section class="blog-sidebar">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-sideabr__left">
                            <div class="blog-sidebar__content">
                                <?php
                                // Connect to Database
                                require_once 'includes/db_connect.php';
                                
                                $projects = [];
                                try {
                                    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
                                    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                } catch (PDOException $e) {
                                    error_log("DB Error: " . $e->getMessage());
                                }

                                if (empty($projects)) {
                                     echo '<p style="color:white;">Aucun projet trouvé.</p>';
                                }
                                
                                // Clean loop start
                                foreach ($projects as $project):
                                    // Ensure link is correct
                                    $project['link'] = 'project-details.php?id=' . $project['id'];
                                ?>
                                    <!-- Project Card: <?php echo htmlspecialchars($project['title']); ?> -->
                                    <div class="blog-sidebar__single project-card-premium"
                                        style="transition: transform 0.3s ease;">
                                        <div class="blog-sidebar__img" style="border-radius: 20px 20px 0 0; position: relative;">
                                            <img src="<?php echo htmlspecialchars($project['hero_image'] ?? $project['image']); ?>"
                                                alt="<?php echo htmlspecialchars($project['title']); ?>"
                                                style="width: 100%; height: 350px; object-fit: cover;">
                                            <div class="blog-sidebar__date" style="background: var(--etaam-turquoise); color: #fff; font-weight: 700; padding: 10px 20px; border-radius: 30px; top: 20px; left: 20px; bottom: auto;">
                                               <?php echo htmlspecialchars($project['category']); ?>
                                            </div>
                                        </div>
                                        <div class="blog-sidebar__content-box" style="padding: 35px; background: rgba(255,255,255,0.02);">
                                            <ul class="list-unstyled blog-sidebar__meta" style="margin-bottom: 20px; display: flex; gap: 20px;">
                                                <li>
                                                    <a href="<?php echo htmlspecialchars($project['link']); ?>" style="color: rgba(255,255,255,0.6);">
                                                        <i class="fas fa-user-circle" style="color: var(--etaam-turquoise); margin-right: 5px;"></i>
                                                        <?php echo htmlspecialchars($project['client']); ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo htmlspecialchars($project['link']); ?>" style="color: rgba(255,255,255,0.6);">
                                                        <i class="fas fa-map-marker-alt" style="color: var(--etaam-turquoise); margin-right: 5px;"></i>
                                                        <?php echo htmlspecialchars($project['location']); ?>
                                                    </a>
                                                </li>
                                            </ul>
                                            <h3 class="blog-sidebar__title" style="margin-bottom: 15px;">
                                                <a href="<?php echo htmlspecialchars($project['link']); ?>"
                                                    style="color: white; font-size: 28px; font-weight: 700;">
                                                    <?php echo htmlspecialchars($project['title']); ?>
                                                </a>
                                            </h3>
                                            <div class="blog-sidebar__text" style="margin-bottom: 25px;">
                                                <?php 
                                                // Extract first paragraph or limit text
                                                $desc = strip_tags($project['description']);
                                                echo substr($desc, 0, 150) . '...';
                                                ?>
                                            </div>
                                            <div class="blog-sidebar__bottom" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 25px;">
                                                <a href="<?php echo htmlspecialchars($project['link']); ?>" class="blog-sidebar__read-more"
                                                    style="color: var(--etaam-turquoise); font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 14px;">
                                                    Découvrir le projet <i class="fas fa-arrow-right" style="font-size: 12px; margin-left: 8px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Pagination (Static for now, can be dynamic later) -->
                                <div class="col-lg-12">
                                    <div class="blog-pagination">
                                        <a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a>
                                        <span class="page-numbers current" style="background: var(--etaam-turquoise); border-color: var(--etaam-turquoise);">1</span>
                                        <a class="page-numbers" href="#">2</a>
                                        <a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="sidebar">
                            <div class="sidebar__single sidebar__search">
                                <form action="#" class="sidebar__search-form">
                                    <input type="search" placeholder="Rechercher un projet...">
                                    <button type="submit"><i class="icon-magnifying-glass"></i></button>
                                </form>
                            </div>
                            <div class="sidebar__single sidebar__post">
                                <h3 class="sidebar__title">Projets Récents</h3>
                                <ul class="sidebar__post-list list-unstyled">
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="assets/images/project/bootcamp-casamance-hero.png" alt=""
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h3>
                                                <span class="sidebar__post-content-meta"><i class="far fa-clock"></i>
                                                    2025</span>
                                                <a href="project-details.php">Bootcamp Casamance</a>
                                            </h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="assets/images/services/planification-hero.png" alt=""
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h3>
                                                <span class="sidebar__post-content-meta"><i class="far fa-clock"></i>
                                                    2025</span>
                                                <a href="planification.php">Stratégie PME</a>
                                            </h3>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar__single sidebar__category">
                                <h3 class="sidebar__title">Domaines</h3>
                                <ul class="sidebar__category-list list-unstyled">
                                    <li><a href="#">Formation Tech <span class="fa fa-long-arrow-alt-right"></span></a>
                                    </li>
                                    <li class="active"><a href="#">Développement Web <span
                                                class="fa fa-long-arrow-alt-right"></span></a></li>
                                    <li><a href="#">AgriTech <span class="fa fa-long-arrow-alt-right"></span></a></li>
                                    <li><a href="#">Conseil Stratégique <span
                                                class="fa fa-long-arrow-alt-right"></span></a></li>
                                    <li><a href="#">Intelligence Artificielle <span
                                                class="fa fa-long-arrow-alt-right"></span></a></li>
                                </ul>
                            </div>
                            <div class="sidebar__single sidebar__tags">
                                <h3 class="sidebar__title">Mots-clés</h3>
                                <div class="sidebar__tags-list">
                                    <a href="#">React</a>
                                    <a href="#">Flutter</a>
                                    <a href="#">Python</a>
                                    <a href="#">Agriculture</a>
                                    <a href="#">Innovation</a>
                                    <a href="#">Startup</a>
                                </div>
                            </div>
                            <div class="sidebar__single sidebar__comments">
                                <h3 class="sidebar__title">Commentaires</h3>
                                <ul class="sidebar__comments-list list-unstyled">
                                    <li>
                                        <div class="sidebar__comments-icon">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <div class="sidebar__comments-text-box">
                                            <p>Utilisateur <br> sur Nouvelle App Mobile</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar__comments-icon">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <div class="sidebar__comments-text-box">
                                            <p><span>Albert Malang Diatta</span> sur Template:</p>
                                            <h5>Excellent travail !</h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar__comments-icon">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <div class="sidebar__comments-text-box">
                                            <p>Utilisateur <br> sur Nouvelle App Mobile</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar__comments-icon">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <div class="sidebar__comments-text-box">
                                            <p> <span>Aissatou</span> sur Template:</p>
                                            <h5>Super design !</h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Sidebar End-->

<?php include 'includes/footer.php'; ?>
