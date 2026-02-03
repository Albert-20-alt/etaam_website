<?php
// Load Data from Database
require_once __DIR__ . '/includes/db_connect.php';

// Get member ID from URL
$memberId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$member = null;

if ($memberId > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
        $stmt->execute([$memberId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // Process Data to match View expectations
            $member = $data;
            
            // Decode JSON fields
            $member['skills'] = json_decode($data['skills'] ?? '[]', true) ?: [];
            $member['education'] = json_decode($data['education'] ?? '[]', true) ?: [];
            $member['history'] = json_decode($data['history'] ?? '[]', true) ?: [];
            
            // Map Social Links
            $member['social'] = [
                'linkedin' => ($data['social_linkedin'] && $data['social_linkedin'] !== '') ? $data['social_linkedin'] : '#',
                'twitter' => ($data['social_twitter'] && $data['social_twitter'] !== '') ? $data['social_twitter'] : '#',
                'facebook' => ($data['social_facebook'] && $data['social_facebook'] !== '') ? $data['social_facebook'] : '#'
            ];
            
// Fallbacks for text fields
$member['long_role'] = ($member['long_role'] ?? $member['role']) ?: $member['role']; // Use role if long_role is missing or empty
            
        }
    } catch (PDOException $e) {
        error_log("DB Error in team-details: " . $e->getMessage());
    }
}

// Redirect if member not found
if (!$member) {
    header("Location: team.php");
    exit();
}

$pageTitle = $member['name'] . " - " . $member['role'] . " | ETAAM";
$currentPage = "team";
include 'includes/header.php';
?>

<!--Page Header Start-->
        <section class="page-header"
            style="position: relative; overflow: hidden; padding: 120px 0 100px; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #1E3A5F 60%, #3B82F6 100%);">
            <div
                style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px;">
            </div>
            <div class="container" style="position: relative; z-index: 2;">
                <div class="page-header__inner text-center">
                    <ul class="thm-breadcrumb list-unstyled"
                        style="display: flex; justify-content: center; align-items: center; gap: 10px; margin: 0 0 25px;">
                        <li><a href="index.php"
                                style="color: rgba(255,255,255,0.7); text-decoration: none;">Accueil</a></li>
                        <li><span style="color: rgba(255,255,255,0.4);">/</span></li>
                        <li><a href="team.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Notre
                                Équipe</a></li>
                        <li><span style="color: rgba(255,255,255,0.4);">/</span></li>
                        <li class="active" style="color: #3B82F6;">Profil Expert</li>
                    </ul>
                    <h1 style="font-size: 48px; font-weight: 700;">Détails du Profil</h1>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Team Details Start-->
        <section class="team-details" style="background-color: #0b0d10; padding: 120px 0;">
            <div class="container">
                <div class="team-details__top">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="team-details__top-left">
                                <div class="team-details__top-img">
                                    <img src="<?php echo $member['image']; ?>" alt="<?php echo $member['name']; ?>"
                                        style="border-radius: 20px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="team-details__top-right">
                                <div class="team-details__top-content">
                                    <h3 class="team-details__top-name"
                                        style="color: white; font-size: 36px; margin-bottom: 10px;"><?php echo $member['name']; ?></h3>
                                    <p class="team-details__top-title"
                                        style="color: #3B82F6; font-size: 18px; margin-bottom: 25px;"><?php echo $member['long_role']; ?></p>
                                    <div class="team-details__social" style="margin-bottom: 30px;">
                                        <?php if ($member['social']['twitter']): ?>
                                        <a href="<?php echo $member['social']['twitter']; ?>" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;"><i class="fab fa-twitter"></i></a>
                                        <?php endif; ?>
                                        <?php if ($member['social']['facebook']): ?>
                                        <a href="<?php echo $member['social']['facebook']; ?>" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;"><i class="fab fa-facebook-f"></i></a>
                                        <?php endif; ?>
                                        <?php if ($member['social']['linkedin']): ?>
                                        <a href="<?php echo $member['social']['linkedin']; ?>" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;"><i class="fab fa-linkedin-in"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <p class="team-details__top-text-1"
                                        style="color: white; font-size: 24px; line-height: 1.4; margin-bottom: 20px;">
                                        "<?php echo $member['quote']; ?>"</p>
                                    <p class="team-details__top-text-2" style="color: #94a3b8; margin-bottom: 20px;">
                                        <?php echo $member['bio_1']; ?></p>
                                    <p class="team-details__top-text-3" style="color: #94a3b8;"><?php echo $member['bio_2']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-details__bottom">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="team-details__bottom-left">
                                <h4 class="team-details__bottom-left-title" style="color: white;">Compétences Techniques
                                </h4>
                                <p class="team-details__bottom-left-text" style="color: #94a3b8;">Expertise approfondie
                                    dans les technologies modernes et méthodologies.</p>
                                <div class="team-details__progress">
                                    <?php foreach ($member['skills'] as $skill): ?>
                                    <div class="team-details__progress-single">
                                        <h4 class="team-details__progress-title" style="color: white;"><?php echo $skill['name']; ?></h4>
                                        <div class="bar">
                                            <div class="bar-inner count-bar" data-percent="<?php echo $skill['percent']; ?>"
                                                style="background: #3B82F6; width: <?php echo $skill['percent']; ?>;">
                                                <div class="count-text" style="color: white;"><?php echo $skill['percent']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                           <!-- <div class="team-details__bottom-right">
                                <h4 class="team-details__bottom-right-title" style="color: white;">Formation & Parcours
                                </h4>
                                <ul class="list-unstyled team-details__education-awards">
                                    <?php foreach ($member['education'] as $edu): ?>
                                    <li>
                                        <h4 style="color: #3B82F6;"><?php echo $edu['school']; ?></h4>
                                        <p style="color: #94a3b8;"><span style="color: white;"><?php echo $edu['years']; ?></span> -
                                            <?php echo $edu['degree']; ?>.</p>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="list-unstyled team-details__education-awards-bottom">
                                    <?php foreach ($member['history'] as $hist): ?>
                                    <li style="color: #94a3b8;"><span style="color: #3B82F6;"><?php echo $hist['year']; ?></span> -
                                        <?php echo $hist['text']; ?>.</li>
                                    <?php endforeach; ?>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Team Details End-->

<?php include 'includes/footer.php'; ?>
