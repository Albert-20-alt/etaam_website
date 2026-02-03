<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';

$pageTitle = "Gestion Forum | Admin ETAAM";
$current_page = "forum";

try {
    // Basic stats for the dashboard header
    $stmt = $pdo->query("SELECT COUNT(*) FROM forum_topics");
    $total_topics = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM forum_replies");
    $total_replies = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM forum_topics WHERE id NOT IN (SELECT DISTINCT topic_id FROM forum_replies WHERE is_admin_reply = 1)");
    $pending_replies = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?></title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/notech-responsive.css" />
    <link rel="stylesheet" href="assets/css/notech-dark.css" />
    
    <!-- Admin Specific Styles -->
    <link rel="stylesheet" href="assets/css/admin-nexlink.css" />

    <style>
        :root {
            --admin-bg: #0b0f19;
            --admin-card-bg: rgba(255, 255, 255, 0.03);
            --admin-border: rgba(255, 255, 255, 0.08);
            --accent-color: #6366f1;
        }

        body {
            background-color: var(--admin-bg);
            font-family: 'Outfit', sans-serif;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background-color: var(--admin-card-bg);
            border-right: 1px solid var(--admin-border);
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
            background: var(--accent-color);
            border-radius: 10px;
        }

        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0 !important;
            }
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 99;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        .admin-main {
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            background: var(--admin-bg);
            padding-bottom: 50px;
        }

        .stat-card-premium {
            background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%);
            border: 1px solid var(--admin-border);
            border-radius: 20px;
            padding: 24px;
            transition: transform 0.3s ease;
        }

        .stat-card-premium:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .modern-table-container {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .admin-topic-row {
            transition: all 0.2s ease;
            cursor: pointer;
            border-bottom: 1px solid var(--admin-border);
        }

        .admin-topic-row:hover {
            background: rgba(255,255,255,0.02);
        }

        .admin-topic-row:last-child {
            border-bottom: none;
        }

        .badge-admin-forum {
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 500;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Reply Modal Premium */
        .premium-admin-modal .modal-content {
            background: #0f172a;
            border: 1px solid var(--admin-border);
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .reply-history-item {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 12px;
        }

        .reply-history-item.is-admin {
            border-left: 4px solid var(--accent-color);
            background: rgba(99, 102, 241, 0.03);
        }

        .admin-input-dark {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid var(--admin-border) !important;
            color: white !important;
            border-radius: 14px !important;
        }

        .admin-input-dark:focus {
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        }

        .icon-btn-premium {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--admin-border);
            color: white;
            transition: all 0.2s;
        }

        .icon-btn-premium:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .icon-btn-premium.delete:hover {
            background: #ef4444;
            border-color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <?php include 'includes/admin_sidebar.php'; ?>

    <main class="admin-main">
        <div class="dashboard-container px-4 py-4">
            
            <?php include 'includes/admin_header.php'; ?>

            <div class="row mb-5 mt-4">
                <div class="col-lg-12">
                    <h2 class="text-white fw-bold">Forum Moderation</h2>
                    <p class="text-white-50">Gestionnaire centralisé des discussions communautaires ETAAM.</p>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-card-premium">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <h3 class="text-white fw-bold h2 mb-1"><?php echo $total_topics; ?></h3>
                        <p class="text-white-50 mb-0 small uppercase ls-1">Total Questions</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card-premium">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-white fw-bold h2 mb-1"><?php echo $pending_replies; ?></h3>
                        <p class="text-white-50 mb-0 small uppercase ls-1">Attente Expert</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card-premium">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3 class="text-white fw-bold h2 mb-1"><?php echo $total_replies; ?></h3>
                        <p class="text-white-50 mb-0 small uppercase ls-1">Réponses Totales</p>
                    </div>
                </div>
            </div>

            <!-- Main Moderation Table -->
            <div class="modern-table-container">
                <div class="p-4 border-bottom border-light border-opacity-10 d-flex justify-content-between align-items-center">
                    <h5 class="text-white mb-0">Flux des discussions</h5>
                    <div class="d-flex gap-2">
                         <input type="text" id="adminForumSearch" class="form-control form-control-sm bg-dark border-secondary text-white rounded-pill px-3" placeholder="Rechercher..." style="width: 200px;">
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="text-white-50 small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3">Sujet / Question</th>
                                <th class="py-3">Auteur</th>
                                <th class="py-3">Catégorie</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="adminTopicsList">
                            <!-- JS content here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Admin Reply Modal Premium -->
    <div class="modal fade premium-admin-modal" id="adminReplyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 p-4 pb-0">
                    <h4 class="modal-title text-white fw-bold">Modération du Sujet</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="p-4 rounded-4 h-100" style="background: rgba(255,255,255,0.02); border: 1px solid var(--admin-border);">
                                <div id="modalTopicBadge" class="mb-3"></div>
                                <h3 id="modalTopicTitle" class="text-white fw-bold mb-3"></h3>
                                <div id="modalTopicMeta" class="text-white-50 small mb-4"></div>
                                <div id="modalTopicContent" class="text-white lh-base" style="font-weight: 300; font-size: 1.1rem;"></div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <h6 class="text-white-50 text-uppercase small mb-3">Historique des échanges</h6>
                            <div id="adminModalReplies" class="mb-4" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
                                <!-- Replies -->
                            </div>

                            <div class="p-4 rounded-4" style="background: rgba(99, 102, 241, 0.05); border: 1px solid rgba(99, 102, 241, 0.2);">
                                <h6 class="text-white mb-3">Ajouter une réponse experte</h6>
                                <form id="adminReplyForm">
                                    <input type="hidden" name="topic_id" id="adminReplyTopicId">
                                    <input type="hidden" name="author_name" value="Expert ETAAM">
                                    <input type="hidden" name="is_admin_reply" value="1">
                                    <textarea name="content" class="form-control admin-input-dark mb-3" rows="5" placeholder="Votre réponse officielle..." required></textarea>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4 rounded-pill fw-bold">Publier la réponse</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    let allTopics = [];

    document.addEventListener('DOMContentLoaded', function() {
        loadAdminTopics();

        document.getElementById('adminForumSearch').addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const filtered = allTopics.filter(t => 
                t.title.toLowerCase().includes(query) || 
                t.author_name.toLowerCase().includes(query) ||
                t.content.toLowerCase().includes(query)
            );
            renderAdminTopics(filtered);
        });

        function loadAdminTopics() {
            fetch('api/forum_api.php?action=get_topics')
                .then(res => res.json())
                .then(topics => {
                    allTopics = topics;
                    renderAdminTopics(topics);
                });
        }

        function renderAdminTopics(topics) {
            const list = document.getElementById('adminTopicsList');
            if (topics.length === 0) {
                list.innerHTML = '<tr><td colspan="6" class="text-center py-5 text-white-50">Aucune discussion trouvée.</td></tr>';
                return;
            }

            list.innerHTML = topics.map(topic => {
                const hasAdminReply = topic.reply_count > 0; // Simplified for display, ideal would be to check the flag
                const date = new Date(topic.created_at).toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
                
                return `
                    <tr class="admin-topic-row" onclick="openAdminReply(${topic.id})">
                        <td class="ps-4">
                            <div class="text-white fw-bold mb-0">${topic.title}</div>
                            <div class="text-white-50 small text-truncate" style="max-width: 250px;">${topic.content}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=${topic.author_name}&background=334155&color=fff" class="rounded-circle" width="24">
                                <span class="text-white-50 small">${topic.author_name}</span>
                            </div>
                        </td>
                        <td><span class="badge-admin-forum" style="background: rgba(99, 102, 241, 0.1); color: #818cf8;">${topic.category}</span></td>
                        <td class="text-white-50 small">${date}</td>
                        <td>
                            <span class="badge ${hasAdminReply ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning'} badge-admin-forum">
                                ${hasAdminReply ? 'Répondu' : 'En attente'}
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex gap-2 justify-content-end" onclick="event.stopPropagation()">
                                <button class="icon-btn-premium" onclick="openAdminReply(${topic.id})"><i class="fas fa-eye"></i></button>
                                <button class="icon-btn-premium delete" onclick="deleteTopic(${topic.id})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        window.openAdminReply = function(id) {
            const topic = allTopics.find(t => t.id == id);
            if (!topic) return;

            document.getElementById('modalTopicBadge').innerHTML = `<span class="badge-admin-forum" style="background: rgba(99, 102, 241, 0.1); color: #818cf8;">${topic.category}</span>`;
            document.getElementById('modalTopicTitle').innerText = topic.title;
            document.getElementById('modalTopicMeta').innerHTML = `Par <strong>${topic.author_name}</strong> le ${new Date(topic.created_at).toLocaleString()}`;
            document.getElementById('modalTopicContent').innerHTML = topic.content.replace(/\n/g, '<br>');
            document.getElementById('adminReplyTopicId').value = id;
            
            loadAdminModalReplies(id);
            new bootstrap.Modal(document.getElementById('adminReplyModal')).show();
        }

        function loadAdminModalReplies(topicId) {
            fetch('api/forum_api.php?action=get_replies&topic_id=' + topicId)
                .then(res => res.json())
                .then(replies => {
                    const container = document.getElementById('adminModalReplies');
                    if (replies.length === 0) {
                        container.innerHTML = '<div class="text-center py-4 text-white-50 italic small">Aucun historique pour ce sujet.</div>';
                        return;
                    }

                    container.innerHTML = replies.map(reply => `
                        <div class="reply-history-item ${reply.is_admin_reply ? 'is-admin' : ''}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="${reply.is_admin_reply ? 'text-primary' : 'text-white'} small">
                                    ${reply.author_name} ${reply.is_admin_reply ? '🛡️' : ''}
                                </strong>
                                <span class="text-white-50" style="font-size: 0.7rem;">${new Date(reply.created_at).toLocaleString()}</span>
                            </div>
                            <div class="text-white-50 small lh-base">${reply.content.replace(/\n/g, '<br>')}</div>
                        </div>
                    `).join('');
                });
        }

        document.getElementById('adminReplyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.disabled = true;
            btn.innerText = 'Publication...';

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            fetch('api/forum_api.php?action=post_reply', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerText = originalText;
                if (res.success) {
                    this.querySelector('textarea').value = '';
                    loadAdminModalReplies(data.topic_id);
                    loadAdminTopics();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Réponse publiée',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#1a1b21',
                        color: '#fff'
                    });
                }
            });
        });

        window.deleteTopic = function(id) {
            Swal.fire({
                title: 'Confirmer la suppression ?',
                text: "Toutes les réponses associées seront également effacées.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer définitivement',
                cancelButtonText: 'Annuler',
                background: '#0f172a',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('api/forum_api.php?action=delete_topic&id=' + id)
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                loadAdminTopics();
                                Swal.fire({
                                    title: 'Supprimé !',
                                    icon: 'success',
                                    background: '#0f172a',
                                    color: '#fff'
                                });
                            }
                        });
                }
            });
        }
    });
    </script>
</body>
</html>
