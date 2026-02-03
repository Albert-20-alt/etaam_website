<?php
$current_page = "projects";

// Connect to Database
require_once 'includes/db_connect.php';

// Get the project ID from the URL
$projectId = isset($_GET['id']) ? $_GET['id'] : '';

$project = [];

if ($projectId) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$projectId]);
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($project) {
            // Decode JSON fields
            $project['deliverables'] = json_decode($project['deliverables'] ?? '[]', true);
            $project['results'] = json_decode($project['results'] ?? '[]', true);
            $project['impact'] = json_decode($project['impact'] ?? '[]', true);
        }
    } catch (PDOException $e) {
        error_log("DB Error: " . $e->getMessage());
    }
}

// Redirect if not found
if (empty($project)) {
    // Try to fetch first project as fallback if ID is missing (legacy behavior compatibility)
    // Or just redirect to home/listing
    header("Location: index.php#projects"); 
    exit;
}

$pageTitle = $project['title'] . " | ETAAM | Projets Réalisés";
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
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="page-header__inner text-center">
            <nav style="margin-bottom: 25px;">
                <ul class="thm-breadcrumb list-unstyled"
                    style="display: flex; justify-content: center; align-items: center; gap: 10px; margin: 0;">
                    <li><a href="index.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Accueil</a>
                    </li>
                    <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                    <li><a href="projects-page-1.php"
                            style="color: rgba(255,255,255,0.7); text-decoration: none;">Projets</a></li>
                    <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                    <li class="active" style="color: #8B5CF6;"><?php echo $project['title']; ?></li>
                </ul>
            </nav>
            <h1
                style="font-size: 48px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #8B5CF6 50%, #EC4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                <?php echo $project['title']; ?>
            </h1>
            <p style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                <?php echo $project['subtitle']; ?>
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
    </style>
</section>
<!--Page Header End-->

<!--Project Details Start-->
<section class="project-details"
    style="background: linear-gradient(180deg, #0f0f23 0%, #1a1a2e 100%); padding: 80px 0;">
    <div class="container">
        <!-- Hero Image with Overlay -->
        <div
            style="border-radius: 24px; overflow: hidden; margin-bottom: 50px; position: relative; box-shadow: 0 25px 50px rgba(0,0,0,0.3);">
            <img src="<?php echo $project['hero_image']; ?>" alt="<?php echo $project['title']; ?>"
                style="width: 100%; height: 500px; object-fit: cover;">
            <div
                style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 30%, rgba(15, 15, 35, 0.95) 100%);">
            </div>

            <!-- Info Cards Overlay -->
            <div style="position: absolute; bottom: 30px; left: 30px; right: 30px;">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 20px; text-align: center;">
                            <i class="fas fa-users" style="font-size: 24px; color: #8B5CF6; margin-bottom: 10px;"></i>
                            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin-bottom: 5px;">Client
                            </p>
                            <h4 style="color: white; font-size: 14px; margin: 0;"><?php echo $project['client']; ?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 20px; text-align: center;">
                            <i class="fas fa-tag" style="font-size: 24px; color: #EC4899; margin-bottom: 10px;"></i>
                            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin-bottom: 5px;">
                                Catégorie</p>
                            <h4 style="color: white; font-size: 14px; margin: 0;"><?php echo $project['category']; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 20px; text-align: center;">
                            <i class="fas fa-map-marker-alt"
                                style="font-size: 24px; color: #10B981; margin-bottom: 10px;"></i>
                            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin-bottom: 5px;">Lieu
                            </p>
                            <h4 style="color: white; font-size: 14px; margin: 0;"><?php echo $project['location']; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 20px; text-align: center;">
                            <i class="fas fa-clock" style="font-size: 24px; color: #F59E0B; margin-bottom: 10px;"></i>
                            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin-bottom: 5px;">Durée
                            </p>
                            <h4 style="color: white; font-size: 14px; margin: 0;"><?php echo $project['duration']; ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Description -->
                <div style="margin-bottom: 50px;">
                    <h2 style="color: white; font-size: 36px; margin-bottom: 25px; font-weight: 700;">
                        <?php echo $project['description_title'] ?? $project['title']; ?></h2>
                    <?php echo $project['description']; ?>
                </div>

                <!-- Challenge Section -->
                <?php if (!empty($project['challenge'])): ?>
                <div
                    style="background: rgba(139, 92, 246, 0.1); border-left: 4px solid #8B5CF6; border-radius: 0 16px 16px 0; padding: 30px; margin-bottom: 50px;">
                    <h3 style="color: white; font-size: 24px; margin-bottom: 15px;"><i
                            class="fas fa-exclamation-triangle"
                            style="color: #F59E0B; margin-right: 10px;"></i>Le Défi</h3>
                    <p style="color: rgba(255,255,255,0.75); line-height: 1.8; margin: 0;">
                        <?php echo $project['challenge']; ?>
                    </p>
                </div>
                <?php endif; ?>

                <!-- What We Delivered -->
                <?php if (!empty($project['deliverables'])): ?>
                <div style="margin-bottom: 50px;">
                    <h3 style="color: white; font-size: 28px; margin-bottom: 30px;">Ce que nous avons livré</h3>
                    <div class="row g-4">
                        <?php foreach ($project['deliverables'] as $item): ?>
                        <div class="col-md-6">
                            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 25px; height: 100%; transition: all 0.3s ease;"
                                class="feature-card">
                                <div
                                    style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B5CF6 0%, #6A4C93 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                    <i class="<?php echo $item['icon']; ?>" style="font-size: 20px; color: white;"></i>
                                </div>
                                <h4 style="color: white; font-size: 18px; margin-bottom: 10px;">
                                    <?php echo $item['title']; ?></h4>
                                <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin: 0;">
                                    <?php echo $item['text']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Process Image -->
                <?php if (!empty($project['process_image'])): ?>
                <div style="border-radius: 20px; overflow: hidden; margin-bottom: 50px;">
                    <img src="<?php echo $project['process_image']; ?>" alt="Atelier pratique"
                        style="width: 100%; border-radius: 20px;">
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Results Card -->
                <?php if (!empty($project['results'])): ?>
                <div
                    style="background: linear-gradient(135deg, #8B5CF6 0%, #6A4C93 100%); border-radius: 24px; padding: 35px; margin-bottom: 30px;">
                    <h3 style="color: white; font-size: 22px; margin-bottom: 25px; text-align: center;"><i
                            class="fas fa-trophy" style="margin-right: 10px;"></i>Résultats</h3>
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <?php foreach ($project['results'] as $result): ?>
                        <div
                            style="text-align: center; padding: 20px; background: rgba(255,255,255,0.1); border-radius: 16px;">
                            <h2 style="color: white; font-size: 42px; font-weight: 800; margin: 0;">
                                <?php echo $result['value']; ?></h2>
                            <p style="color: rgba(255,255,255,0.85); margin: 5px 0 0;"><?php echo $result['label']; ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Impact Card -->
                <?php if (!empty($project['impact'])): ?>
                <div
                    style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 30px; margin-bottom: 30px;">
                    <h4 style="color: white; font-size: 18px; margin-bottom: 20px;"><i class="fas fa-chart-line"
                            style="color: #10B981; margin-right: 10px;"></i>Impact</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach ($project['impact'] as $impact): ?>
                        <li style="display: flex; align-items: flex-start; margin-bottom: 15px;">
                            <i class="fas fa-check-circle"
                                style="color: #10B981; margin-right: 12px; margin-top: 4px;"></i>
                            <span style="color: rgba(255,255,255,0.75);"><?php echo $impact; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- CTA Card -->
                <div
                    style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 30px; text-align: center;">
                    <h4 style="color: white; font-size: 18px; margin-bottom: 15px;">Un projet similaire ?</h4>
                    <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin-bottom: 20px;">Discutons de vos
                        ambitions</p>
                    <a href="contact.php"
                        style="display: inline-block; background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%); color: white; padding: 14px 30px; border-radius: 12px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">Nous
                        contacter</a>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div style="margin-top: 60px; padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="row align-items-center">
                <div class="col-6">
                    <a href="index.php#projects"
                        style="display: inline-flex; align-items: center; color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s ease;">
                        <i class="fas fa-arrow-left" style="margin-right: 15px; font-size: 20px;"></i>
                        <span>Retour aux projets</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(139, 92, 246, 0.3);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.1);
        }
    </style>
</section>
<!--Project Details End-->

<?php include 'includes/footer.php'; ?>
