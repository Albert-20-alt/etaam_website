<?php
// Expects $service_id to be defined before inclusion
if (!isset($service_id)) {
    die("Service ID not specified.");
}

require_once __DIR__ . '/db_connect.php';

// Fetch Service Data
try {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$service_id]);
    $service_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service_data) {
        die("Service not found.");
    }
} catch (PDOException $e) {
    die("Error fetching service: " . $e->getMessage());
}

$pageTitle = $service_data['title'] . " | ETAAM";
$currentPage = "services";
include 'header.php';
?>

<!--Page Header Start-->
<section class="page-header" style="position: relative; overflow: hidden; padding: 120px 0 100px; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #1E3A5F 60%, #3B82F6 100%);">
    <div style="position: absolute; inset: 0; overflow: hidden;">
        <div style="position: absolute; top: 10%; left: 5%; width: 120px; height: 120px; background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
        <div style="position: absolute; top: 60%; right: 10%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(16, 185, 129, 0.2), transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;"></div>
        <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px;"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="page-header__inner text-center">
            <nav style="margin-bottom: 25px;">
                <ul class="thm-breadcrumb list-unstyled" style="display: flex; justify-content: center; align-items: center; gap: 10px; margin: 0;">
                    <li><a href="index.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Accueil</a></li>
                    <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                    <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none;">Services</a></li>
                    <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                    <li class="active" style="color: #3B82F6;"><?php echo htmlspecialchars($service_data['title']); ?></li>
                </ul>
            </nav>
            <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #3B82F6 50%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                <?php echo htmlspecialchars($service_data['title']); ?>
            </h1>
            <p style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                <?php echo htmlspecialchars($service_data['description']); ?>
            </p>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Service Details Start-->
<section class="service-details" style="background: linear-gradient(180deg, #0f0f23 0%, #1a1a2e 100%); padding: 80px 0;">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-5">
                <div class="service-details__left">
                    <div class="service-details__service" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 30px; margin-bottom: 30px;">
                        <h3 class="service-details__title" style="color: white; font-size: 22px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #3B82F6;">Nos Services</h3>
                        <ul class="service-details__service-list list-unstyled" style="margin: 0;">
                            <?php 
                            if (!isset($services)) { include 'services_data.php'; }
                            $current_slug = basename($_SERVER['PHP_SELF']);
                            foreach ($services as $s): 
                                $isActive = ($s['id'] == $service_id); 
                                $liClass = $isActive ? 'active' : '';
                                $liStyle = $isActive ? '' : 'margin-bottom: 12px;';
                                $aStyle = $isActive 
                                    ? 'display: flex; align-items: center; justify-content: space-between; background: linear-gradient(135deg, #3B82F6 0%, #1E3A5F 100%); color: white; padding: 15px 20px; border-radius: 10px; text-decoration: none; font-weight: 500;' 
                                    : 'display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.8); padding: 15px 20px; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;';
                            ?>
                            <li class="<?php echo $liClass; ?>" style="<?php echo $liStyle; ?>">
                                <a href="<?php echo $s['link']; ?>" style="<?php echo $aStyle; ?>">
                                    <?php echo htmlspecialchars($s['title']); ?> <i class="fas fa-arrow-right"></i>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div style="background: linear-gradient(135deg, #3B82F6 0%, #1E3A5F 100%); border-radius: 20px; padding: 40px 30px; text-align: center; margin-bottom: 30px;">
                        <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-phone-alt" style="font-size: 30px; color: white;"></i>
                        </div>
                        <h3 style="color: white; font-size: 20px; margin-bottom: 10px;">Besoin d'aide ?</h3>
                        <p style="color: rgba(255,255,255,0.85); margin-bottom: 20px;">Contactez nos experts</p>
                        <a href="contact.php" style="display: block; color: white; font-size: 22px; font-weight: 600; text-decoration: none;">Contactez-nous</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-xl-8 col-lg-7">
                <div class="service-details__right">
                    <?php if (!empty($service_data['image_url'])): ?>
                    <div style="border-radius: 20px; overflow: hidden; margin-bottom: 40px; position: relative;">
                        <img src="<?php echo htmlspecialchars($service_data['image_url']); ?>" alt="<?php echo htmlspecialchars($service_data['title']); ?>" style="width: 100%; height: auto;">
                    </div>
                    <?php endif; ?>

                    <div style="margin-bottom: 40px; color: rgba(255,255,255,0.8);">
                        <?php 
                        // Output the full HTML content stored in DB
                        // Ensure your admin verifies this content is safe or use a purifier if public input allowed
                        // For admin input, we assume it's trusted
                        echo $service_data['full_content']; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Service Details End-->

<?php include 'footer.php'; ?>
