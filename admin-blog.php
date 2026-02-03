<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';
$pageTitle = "Gestion du Blog | Admin";
$current_page = "blog";

// REMOVED include 'includes/header.php' to avoid double HTML/Preloader issues.
// We strictly follow admin.php structure now.

$file_path = __DIR__ . '/data/messages.json';
$unread_count = 0;

if (file_exists($file_path)) {
    $json_content = file_get_contents($file_path);
    $msgs = json_decode($json_content, true) ?? [];
    
    foreach ($msgs as $m) {
        if (!($m['is_read'] ?? false) && !($m['is_archived'] ?? false)) {
            $unread_count++;
        }
    }
}

// Load blog data from DB
$posts = [];
try {
    $stmt = $pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
    // Remap to key by slug for compatibility with existing loop or adjust loop
    // existing loop uses: foreach ($posts as $slug => $post)
    // we should just fetchAsAll and change the Loop slightly OR rekey.
    // Let's rekey by slug to minimize changes to the view logic below? 
    // Actually, let's just fetch all and adjust the loop variable.
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $r) {
        $posts[$r['slug']] = $r;
        // Fix date format for display if needed
        $posts[$r['slug']]['date'] = date('d M Y', strtotime($r['created_at']));
    }
    
} catch (PDOException $e) {
    error_log("DB Error Blog: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion du Blog | Administration ETAAM</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Gestion du Blog ETAAM" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/notech-responsive.css" />
    <link rel="stylesheet" href="assets/css/notech-dark.css" />
    
    <!-- Admin Specific Styles -->
    <link rel="stylesheet" href="assets/css/admin-nexlink.css" />

    <style>
        /* Sidebar overrides for consistency */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background-color: var(--admin-card-bg);
            border-right: 1px solid var(--admin-border-color);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            padding: 30px 10px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: var(--accent-color) transparent;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .admin-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #3B82F6;
            border-radius: 10px;
        }

        .admin-main {
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            background: var(--admin-bg);
        }

        /* Mobile Responsive Overrides */
        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .search-bar {
                display: none;
            }
        }
        
        /* Modal & Form Styles */
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-top: 5px;
            font-family: inherit;
        }
        .mb-3 { margin-bottom: 1rem; }
        .row { display: flex; margin: 0 -10px; }
        .col-md-8, .col-md-4, .col-md-6 { padding: 0 10px; }
        .col-md-8 { width: 66.666%; }
        .col-md-4 { width: 33.333%; }
        .col-md-6 { width: 50%; }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'blog';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="dashboard-container">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <!-- Stats Overview -->
            <div class="stats-grid-nex">
                <div class="nex-card stat-card-nex">
                    <div class="stat-icon purple" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Articles Total</h3>
                        <div class="value"><?php echo count($posts); ?></div>
                    </div>
                </div>
                <!-- Additional stats can be added here if needed -->
            </div>

            <!-- Blog Posts Table -->
            <div class="nex-card">
                <div class="table-header-nex">
                    <h4 class="card-title-nex">Liste des Articles</h4>
                    <div>
                         <button class="btn btn-primary" onclick="openModal()" style="background: var(--brand-primary); border: none; padding: 8px 16px; border-radius: 8px;"><i class="fas fa-plus"></i> Nouvel Article</button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>ARTICLE</th>
                                <th>AUTEUR</th>
                                <th>CATÉGORIE</th>
                                <th>DATE</th>
                                <th>STATUT</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($posts)): ?>
                            <tr>
                                <td colspan="6" class="text-center" style="padding: 30px; color: rgba(255,255,255,0.5);">Aucun article trouvé.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($posts as $slug => $post): ?>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-sm" style="width: 40px; height: 40px; border-radius: 4px; background-image: url('<?php echo htmlspecialchars($post['image']); ?>'); background-size: cover; background-position: center;"></div>
                                            <div>
                                                <div style="font-weight: 600;"><?php echo htmlspecialchars($post['title']); ?></div>
                                                <div style="color: var(--admin-text-muted); font-size: 0.8em;"><?php echo $slug; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($post['author']); ?></td>
                                    <td><span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;"><?php echo htmlspecialchars($post['category']); ?></span></td>
                                    <td><?php echo htmlspecialchars($post['date']); ?></td>
                                    <td>
                                        <?php if(($post['status'] ?? 'published') == 'published'): ?>
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">Publié</span>
                                        <?php else: ?>
                                        <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B;">Brouillon</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            <button class="icon-btn" style="width: 32px; height: 32px; font-size: 14px;" onclick="editPost('<?php echo $slug; ?>')" title="Modifier"><i class="fas fa-edit"></i></button>
                                            <button class="icon-btn delete" style="width: 32px; height: 32px; font-size: 14px; color: #EF4444; border-color: rgba(239,68,68,0.3);" onclick="deletePost('<?php echo $slug; ?>', this)" title="Supprimer"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Modal -->
    <div id="postModal" class="modal" tabindex="-1" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; overflow-y: auto;">
        <div class="modal-dialog" style="margin: 50px auto; max-width: 800px; background: white; border-radius: 12px; padding: 25px; position: relative; pointer-events: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 class="modal-title" id="modalTitle" style="font-size: 1.5rem; font-weight: 700; color: #333;">Nouvel Article</h5>
                <button type="button" class="btn-close" onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333;">&times;</button>
            </div>
            <div class="modal-body">
                <form id="postForm" style="color: #333;">
                    <!-- Hidden Slug (Original Slug for editing) -->
                    <input type="hidden" id="originalSlug" name="originalSlug">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Titre</label>
                                <input type="text" class="form-control" id="title" name="title" required oninput="generateSlug()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Slug (URL)</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Auteur</label>
                                <input type="text" class="form-control" id="author" name="author" value="Admin">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Catégorie</label>
                                <input type="text" class="form-control" id="category" name="category" list="categoryList">
                                <datalist id="categoryList">
                                    <option value="Innovation">
                                    <option value="AgriTech">
                                    <option value="Cybersécurité">
                                    <option value="Digital">
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="image" name="image" placeholder="assets/images/blog/...">
                            <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="uploadImage(this)">
                            <button type="button" class="btn" style="border: 1px solid #ddd;" onclick="triggerUpload()" title="Uploader une image"><i class="fas fa-upload"></i></button>
                        </div>
                        <img id="imagePreview" src="" alt="Preview" style="display:none; max-height: 100px; margin-top: 10px; border-radius: 6px; border: 1px solid #eee;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Extrait</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="2" placeholder="Brève description..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contenu</label>
                        <textarea class="form-control" id="content" name="content" rows="10" placeholder="Écrivez votre article ici... (Une ligne par paragraphe ou utiliser HTML)"></textarea>
                        <small class="text-muted">Conseil : Séparez les paragraphes par des sauts de ligne.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mots-clés (séparés par des virgules)</label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="Tech, Sénégal, Innovation">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select class="form-control" id="status" name="status">
                            <option value="published">Publié</option>
                            <option value="draft">Brouillon</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-secondary" onclick="closeModal()" style="background: #f3f4f6; color: #333; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="savePost()" style="background: #3B82F6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Enregistrer</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Summernote Lite (No API Key required) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const blogPosts = <?php echo json_encode($posts); ?>;

        // Initialize Summernote
        $(document).ready(function() {
            $('#content').summernote({
                placeholder: 'Écrivez votre article ici... (Utiliser la barre d\'outils pour le formatage)',
                tabsize: 2,
                height: 300,
                toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link', 'picture', 'video']],
                  ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        function generateSlug() {
            const title = document.getElementById('title').value;
            const originalSlug = document.getElementById('originalSlug').value;
            if (!originalSlug) {
                document.getElementById('slug').value = slugify(title);
            }
        }

        function openModal() {
            document.getElementById('postForm').reset();
            document.getElementById('originalSlug').value = '';
            document.getElementById('modalTitle').innerText = 'Nouvel Article';
            document.getElementById('imagePreview').style.display = 'none';
            // Reset Summernote
            $('#content').summernote('reset');
            document.getElementById('postModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('postModal').style.display = 'none';
        }

        function editPost(slug) {
            const post = blogPosts[slug];
            if (!post) {
                alert('Article introuvable');
                return;
            }

            document.getElementById('modalTitle').innerText = 'Modifier l\'Article';
            document.getElementById('originalSlug').value = slug;
            document.getElementById('title').value = post.title;
            document.getElementById('slug').value = slug;
            document.getElementById('author').value = post.author;
            document.getElementById('category').value = post.category;
            document.getElementById('image').value = post.image;
            document.getElementById('excerpt').value = post.excerpt;
            
            // Set content in Summernote
            let content = post.content;
            if(Array.isArray(content)) content = content.join('\n\n');
            $('#content').summernote('code', content);
            
            let tags = post.tags;
            if(Array.isArray(tags)) tags = tags.join(', ');
            document.getElementById('tags').value = tags;
            
            document.getElementById('status').value = post.status || 'published';
            
            // Show preview if image exists
            const imgPrev = document.getElementById('imagePreview');
            if(post.image) {
                imgPrev.src = post.image;
                imgPrev.style.display = 'block';
            } else {
                imgPrev.style.display = 'none';
            }

            document.getElementById('postModal').style.display = 'block';
        }

        function triggerUpload() {
            document.getElementById('fileInput').click();
        }

        function uploadImage(input) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('file', input.files[0]);

                fetch('api/upload_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        document.getElementById('image').value = data.url;
                        const validUrl = data.url.startsWith('http') ? data.url : data.url; 
                        document.getElementById('imagePreview').src = validUrl;
                        document.getElementById('imagePreview').style.display = 'block';
                    } else {
                        alert('Erreur upload: ' + data.error);
                    }
                })
                .catch(err => alert('Erreur réseau: ' + err));
            }
        }

        function savePost() {
            const form = document.getElementById('postForm');
            
            // Check form validity (HTML5)
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Identify action type
            const originalSlug = document.getElementById('originalSlug').value;
            const actionText = originalSlug ? 'Modifier cet article ?' : 'Publier cet article ?';
            const confirmButtonText = originalSlug ? 'Oui, modifier' : 'Oui, publier';

            Swal.fire({
                title: 'Confirmation',
                text: actionText,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    performSave();
                }
            });
        }

        function performSave() {
            const saveBtn = document.querySelector('#postModal .btn-primary');
            const originalText = saveBtn.innerText;
            saveBtn.innerText = 'Enregistrement...';
            saveBtn.disabled = true;
            
            // Get content from Summernote
            const contentHtml = $('#content').summernote('code');

            const formData = {
                title: document.getElementById('title').value,
                slug: document.getElementById('slug').value,
                originalSlug: document.getElementById('originalSlug').value,
                author: document.getElementById('author').value,
                category: document.getElementById('category').value,
                image: document.getElementById('image').value,
                excerpt: document.getElementById('excerpt').value,
                content: contentHtml, 
                tags: document.getElementById('tags').value.split(',').map(t => t.trim()),
                status: document.getElementById('status').value,
                date: new Date().toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
            };

            fetch('api/save_blog_post.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    Swal.fire(
                        'Succès!',
                        'L\'article a été enregistré.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        'Erreur',
                        data.error || 'Une erreur est survenue',
                        'error'
                    );
                    saveBtn.innerText = originalText;
                    saveBtn.disabled = false;
                }
            })
            .catch(err => {
                Swal.fire(
                    'Erreur Réseau',
                    err.toString(),
                    'error'
                );
                saveBtn.innerText = originalText;
                saveBtn.disabled = false;
            });
        }

        function deletePost(slug, btn) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('api/delete_blog_post.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ slug: slug })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire(
                                'Supprimé!',
                                'L\'article a été supprimé.',
                                'success'
                            );
                            btn.closest('tr').remove();
                        } else {
                            Swal.fire(
                                'Erreur',
                                data.error || 'Erreur lors de la suppression',
                                'error'
                            );
                        }
                    })
                    .catch(err => Swal.fire('Erreur', err.toString(), 'error'));
                }
            });
        }
        
        // Better click outside handling
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('postModal');
            if (event.target === modal) {
               // Only close if not in swal
               if (!Swal.isVisible()) {
                   closeModal();
               }
            }
        });

        // Sidebar Toggle
        $(document).ready(function () {
            $('#openSidebar').click(function () {
                $('#adminSidebar').addClass('show');
                $('#sidebarOverlay').addClass('show');
            });

            $('#closeSidebar, #sidebarOverlay').click(function () {
                $('#adminSidebar').removeClass('show');
                $('#sidebarOverlay').removeClass('show');
            });
        });
    </script>
</body>
</html>
