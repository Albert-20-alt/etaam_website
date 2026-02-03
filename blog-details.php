<?php
require_once __DIR__ . '/includes/db_connect.php';

// Get post ID from URL (slug)
$slug = isset($_GET['id']) ? $_GET['id'] : 'innovation-numerique-casamance';

// Fetch Post
$post = null;
try {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ?");
    $stmt->execute([$slug]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($post) {
        // Fix tags and content format if needed
        // Content might be JSON array or string
        // The migration script saved content as string (imploded) or string
        // but older json was array. 
        // Database field is LONGTEXT.
        // Let's normalize for the view below.
        
        $post['date'] = date('d M Y', strtotime($post['created_at']));
        // If content is just string, we are good.
        
        // Tags
        if ($post['tags']) {
            $post['tags'] = explode(',', $post['tags']);
        } else {
            $post['tags'] = [];
        }
    }
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
}

if (!$post) {
    header("Location: blog-sidebar.php");
    exit();
}

$pageTitle = $post['title'] . " | Blog ETAAM";
$currentPage = "blog";
include 'includes/header.php';

// Fetch Recent Posts for sidebar (re-query)
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
        <section class="page-header">
            <div class="page-header-bg"
                style="background-image: url(assets/images/backgrounds/blog_header_senegal_tech.png)">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.php">Accueil</a></li>
                        <li><span>/</span></li>
                        <li><a href="blog-sidebar.php">Le Blog</a></li>
                        <li><span>/</span></li>
                        <li class="active">Détails</li>
                    </ul>
                    <h2 style="color: white;"><?php echo $post['title']; ?></h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Blog Details Start-->
        <section class="blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-details__left">
                            <div class="blog-details__img">
                                <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
                            </div>
                            <div class="blog-details__content">
                                <ul class="list-unstyled blog-details__meta">
                                    <li><a href="#"><i class="far fa-clock"></i> <?php echo $post['date']; ?></a>
                                    </li>
                                    <li><a href="#"><i class="far fa-user-circle"></i> par <?php echo $post['author']; ?></a>
                                    </li>
                                </ul>
                                <h3 class="blog-details__title"><?php echo $post['title']; ?></h3>
                                
                                <div class="blog-details__text-1" style="margin-bottom: 20px;">
                                    <?php 
                                    if (is_array($post['content'])) {
                                        foreach ($post['content'] as $paragraph) {
                                            echo "<p>" . $paragraph . "</p>";
                                        }
                                    } else {
                                        // It's a string (HTML from Summernote)
                                        echo $post['content'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="blog-details__bottom">
                                <p class="blog-details__tags">
                                    <span>Mots-clés</span>
                                    <?php 
                                    $tags = is_array($post['tags']) ? $post['tags'] : explode(',', $post['tags']);
                                    foreach ($tags as $tag): 
                                    ?>
                                    <a href="#"><?php echo trim($tag); ?></a>
                                    <?php endforeach; ?>
                                </p>
                                <div class="blog-details__social-list">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="blgo-details__pagenation-box">
                                <ul class="list-unstyled blog-details__pagenation">
                                    <li><a href="blog-sidebar.php">Retour au Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="sidebar">
                            <div class="sidebar__single sidebar__search">
                                <form action="blog-sidebar.php" method="GET" class="sidebar__search-form">
                                    <input type="search" name="q" placeholder="Rechercher...">
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
                                        <a href="blog-sidebar.php?category=<?php echo urlencode($category); ?>">
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
                                    <a href="blog-sidebar.php?tag=<?php echo urlencode($tag); ?>"><?php echo $tag; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Details End-->

<?php include 'includes/footer.php'; ?>
