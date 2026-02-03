<?php
$pageTitle = "Blog | ETAAM";
$currentPage = "blog";
include 'includes/header.php';

// Database Connection
require_once __DIR__ . '/includes/db_connect.php';

// Pagination Setup
$postsPerPage = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $postsPerPage;

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$categoryQuery = isset($_GET['category']) ? trim($_GET['category']) : '';
$tagQuery = isset($_GET['tag']) ? trim($_GET['tag']) : '';

// Build Query
$where = "WHERE status = 'published'";
$params = [];

if ($searchQuery) {
    $where .= " AND (title LIKE ? OR excerpt LIKE ? OR content LIKE ? OR tags LIKE ?)";
    $like = "%$searchQuery%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

if ($categoryQuery) {
    $where .= " AND category = ?";
    $params[] = $categoryQuery;
}

if ($tagQuery) {
    $where .= " AND tags LIKE ?";
    $params[] = "%" . $tagQuery . "%";
}

// Fetch Count for Pagination
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM blog_posts $where");
$countStmt->execute($params);
$totalPosts = $countStmt->fetchColumn();
$totalPages = ceil($totalPosts / $postsPerPage);

// Fetch Posts
$sql = "SELECT * FROM blog_posts $where ORDER BY created_at DESC LIMIT $postsPerPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$currentPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare Posts for Display
foreach ($currentPosts as &$post) {
    // Format Date
    $post['date'] = date('d M Y', strtotime($post['created_at']));
    // Key by slug for loop compatibility if needed, though simple array is fine if we update loop
}
// We will use $currentPosts as array, updating the loop variable structure slightly.

// Fetch Sidebar Data (Recent, Categories, Tags)
$recentPosts = [];
try {
    $stmt = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");
    $recentPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($recentPosts as &$rp) {
         $rp['date'] = date('d M Y', strtotime($rp['created_at']));
    }
} catch (PDOException $e) {}

// Categories (Distinct)
$categories = [];
try {
    $stmt = $pdo->query("SELECT DISTINCT category FROM blog_posts WHERE status = 'published' ORDER BY category");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {}

// Tags - Aggregate
$tags = [];
try {
    $stmt = $pdo->query("SELECT tags FROM blog_posts WHERE status = 'published'");
    $allTagsRows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($allTagsRows as $rowTags) {
        if ($rowTags) {
            $tParts = explode(',', $rowTags);
            foreach($tParts as $t) {
                $tags[] = trim($t);
            }
        }
    }
    $tags = array_unique($tags);
    sort($tags);
} catch (PDOException $e) {}
?>

<!--Page Header Start-->
        <section class="page-header"
            style="position: relative; overflow: hidden; padding: 120px 0 100px; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #3B82F6 60%, #10B981 100%);">
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
                    <i class="fas fa-blog"></i>
                </div>
                <div
                    style="position: absolute; bottom: 30%; left: 10%; color: rgba(16, 185, 129, 0.25); font-size: 40px; animation: floatIcon 9s ease-in-out infinite reverse;">
                    <i class="fas fa-rss"></i>
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
                            <li class="active" style="color: #3B82F6;">Le Blog</li>
                        </ul>
                    </nav>
                    <h1
                        style="font-size: 48px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #3B82F6 50%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Actualités & Analyses
                    </h1>
                    <p style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                        Restez informé des dernières tendances tech et de nos activités au Sénégal
                    </p>
                </div>
            </div>

            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 80px;">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 100%;">
                    <path d="M0,60 C150,120 350,0 600,60 C850,120 1050,0 1200,60 L1200,120 L0,120 Z" fill="#f8f9fa">
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
                    <div class="col-xl-4 col-lg-5">
                        <div class="sidebar">
                            <div class="sidebar__single sidebar__search">
                                <form action="blog-sidebar.php" method="GET" class="sidebar__search-form">
                                    <input type="search" name="q" placeholder="Rechercher..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                                    <button type="submit"><i class="icon-magnifying-glass"></i></button>
                                </form>
                            </div>
                            <div class="sidebar__single sidebar__post">
                                <h3 class="sidebar__title">Articles Récents</h3>
                                <ul class="sidebar__post-list list-unstyled">
                                    <?php foreach ($recentPosts as $recent): ?>
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="<?php echo $recent['image']; ?>" alt="">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h3>
                                                <span class="sidebar__post-content-meta"><i class="far fa-clock"></i> <?php echo $recent['date']; ?></span>
                                                <a href="blog-details.php?id=<?php echo $recent['slug']; ?>"><?php echo $recent['title']; ?></a>
                                            </h3>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="sidebar__single sidebar__category">
                                <h3 class="sidebar__title">Catégories</h3>
                                <ul class="sidebar__category-list list-unstyled">
                                    <?php foreach ($categories as $category): ?>
                                    <li>
                                        <a href="blog-sidebar.php?category=<?php echo urlencode($category); ?>" class="<?php echo ($categoryQuery === $category) ? 'active' : ''; ?>">
                                            <?php echo $category; ?> 
                                            <span class="fa fa-long-arrow-alt-right"></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="sidebar__single sidebar__tags">
                                <h3 class="sidebar__title">Mots-clés</h3>
                                <div class="sidebar__tags-list">
                                    <?php foreach ($tags as $tag): ?>
                                    <a href="blog-sidebar.php?tag=<?php echo urlencode($tag); ?>" class="<?php echo ($tagQuery === $tag) ? 'active' : ''; ?>"><?php echo $tag; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-sidebar__content">
                                <?php if (empty($currentPosts)): ?>
                                    <div class="blog-sidebar__single" style="padding: 40px; text-align: center;">
                                        <div class="blog-sidebar__content-box">
                                            <h3 class="blog-sidebar__title">Aucun résultat trouvé</h3>
                                            <p class="blog-sidebar__text">Désolé, nous n'avons trouvé aucun article correspondant à votre recherche "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>".</p>
                                            <div class="blog-sidebar__bottom" style="justify-content: center; border-top: none; margin-top: 20px;">
                                                <a href="blog-sidebar.php" class="blog-sidebar__read-more">Voir tous les articles</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($currentPosts as $post): ?>
                                    <!--Blog Sidebar Single-->
                                    <div class="blog-sidebar__single">
                                        <div class="blog-sidebar__img">
                                            <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
                                        </div>
                                        <div class="blog-sidebar__content-box">
                                            <ul class="list-unstyled blog-sidebar__meta">
                                                <li><a href="blog-details.php?id=<?php echo $post['slug']; ?>"><i class="far fa-clock"></i> <?php echo $post['date']; ?></a>
                                                </li>
                                                <li><a href="blog-details.php?id=<?php echo $post['slug']; ?>"><i class="far fa-user-circle"></i> par
                                                        <?php echo $post['author']; ?></a></li>
                                            </ul>
                                            <h3 class="blog-sidebar__title">
                                                <a href="blog-details.php?id=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
                                            </h3>
                                            <p class="blog-sidebar__text"><?php echo $post['excerpt']; ?></p>
                                            <div class="blog-sidebar__bottom">
                                                <a href="blog-details.php?id=<?php echo $post['slug']; ?>" class="blog-sidebar__read-more">Lire la
                                                    suite</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="blog-sidebar__bottom-box">
                                <div class="blog-sidebar__bottom-box-icon">
                                    <img src="assets/images/icon/blog-sidebar-bottom-box-icon.png" alt="">
                                </div>
                                <p class="blog-sidebar__bottom-box-text">ETAAM s'engage à fournir des analyses de pointe
                                    et des solutions technologiques adaptées aux réalités locales.</p>
                            </div>
                            <div class="blog-sidebar__delivering-services">
                                <div class="blog-sidebar__delivering-services-icon">
                                    <a href="blog-details.php"><img
                                            src="assets/images/icon/blog-sidebar__delivering-services-icon.png"
                                            alt=""></a>
                                </div>
                                <h3 class="blog-sidebar__delivering-services-title"><a
                                        href="blog-details.php">Excellence
                                        technologique et expertise locale</a></h3>
                            </div>
                            <div class="col-lg-12">
                                <div class="blog-pagination">
                                    <?php if ($totalPages > 1): ?>
                                        <?php if ($page > 1): ?>
                                            <a class="prev page-numbers" href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($searchQuery); ?>"><i class="fa fa-angle-left"></i></a>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <?php if ($i == $page): ?>
                                                <span class="page-numbers current"><?php echo $i; ?></span>
                                            <?php else: ?>
                                                <a class="page-numbers" href="?page=<?php echo $i; ?>&q=<?php echo urlencode($searchQuery); ?>"><?php echo $i; ?></a>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        
                                        <?php if ($page < $totalPages): ?>
                                            <a class="next page-numbers" href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($searchQuery); ?>"><i class="fa fa-angle-right"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- /.blog-pagination -->
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Sidebar End-->

<?php include 'includes/footer.php'; ?>
<style>
/* Active State for Sidebar Links */
.sidebar__category-list li a.active {
    color: var(--thm-base);
    font-weight: bold;
}
.sidebar__tags-list a.active {
    background-color: var(--thm-base);
    color: #fff;
    border-color: var(--thm-base);
}
</style>
