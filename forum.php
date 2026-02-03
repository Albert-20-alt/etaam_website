<?php
$page_title = "Community Forum | ETAAM";
include('includes/header.php');
?>

<div class="stricky-header-spacer"></div>

<!-- Custom Forum CSS -->
<style>
    :root {
        --forum-bg: #0b0f19;
        --card-bg: rgba(255, 255, 255, 0.03);
        --card-border: rgba(255, 255, 255, 0.08);
        --accent-color: #6366f1;
        --accent-hover: #4f46e5;
        --glass-effect: blur(10px) saturate(180%);
    }

    body {
        background-color: var(--forum-bg);
    }

    /* Hero Section Enhancement */
    .forum-hero-enhanced {
        background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent),
                    radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.1), transparent),
                    #0f172a;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid var(--card-border);
    }

    .forum-hero-enhanced::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('assets/images/shapes/site-footer-shape-1.png') center/cover no-repeat;
        opacity: 0.1;
        pointer-events: none;
    }

    /* Sidebar Styling */
    .forum-sidebar-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 20px;
        padding: 25px;
        backdrop-filter: var(--glass-effect);
        position: sticky;
        top: 100px;
    }

    .category-filter-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-radius: 12px;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .category-filter-item:hover, .category-filter-item.active {
        background: rgba(99, 102, 241, 0.1);
        color: #fff;
    }

    .category-filter-item i {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.05);
        border-radius: 8px;
        margin-right: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .category-filter-item.active i {
        background: var(--accent-color);
        color: white;
    }

    /* Topic Card Redesign */
    .topic-card-modern {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .topic-card-modern:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(99, 102, 241, 0.4);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    }

    .topic-card-modern::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: var(--accent-color);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .topic-card-modern:hover::after {
        opacity: 1;
    }

    .topic-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: rgba(99, 102, 241, 0.1);
        color: var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    /* Search Bar */
    .forum-search-wrapper {
        position: relative;
        margin-bottom: 30px;
    }

    .forum-search-input {
        background: rgba(255,255,255,0.05);
        border: 1px solid var(--card-border);
        border-radius: 15px;
        padding: 15px 20px 15px 50px;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
    }

    .forum-search-input:focus {
        background: rgba(255,255,255,0.08);
        border-color: var(--accent-color);
        box-shadow: none;
        outline: none;
    }

    .forum-search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.4);
    }

    /* Badges */
    .badge-forum {
        padding: 6px 12px;
        font-weight: 500;
        font-size: 11px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-radius: 8px;
    }

    .badge-cat-general { background: rgba(14, 165, 233, 0.1); color: #38bdf8; }
    .badge-cat-tech { background: rgba(168, 85, 247, 0.1); color: #c084fc; }
    .badge-cat-marketing { background: rgba(34, 197, 94, 0.1); color: #4ade80; }
    .badge-cat-branding { background: rgba(245, 158, 11, 0.1); color: #fbbf24; }

    /* Modals Enhancement */
    .modal-content.premium-modal {
        background: #0f172a;
        border: 1px solid var(--card-border);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .form-dark-input {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid var(--card-border) !important;
        color: white !important;
        border-radius: 12px !important;
        padding: 12px 15px !important;
    }

    .form-dark-input:focus {
        border-color: var(--accent-color) !important;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2) !important;
    }

    /* Reply Styling */
    .reply-card-modern {
        background: rgba(255,255,255,0.02);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 15px;
    }

    .admin-reply-premium {
        background: rgba(99, 102, 241, 0.03);
        border-left: 4px solid var(--accent-color);
    }
</style>

<!-- Forum Hero -->
<section class="forum-hero-enhanced">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Accueil</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Community Forum</li>
                    </ol>
                </nav>
                <h1 class="display-3 fw-bold text-white mb-3">ETAAM <span class="text-primary">Connect</span></h1>
                <p class="lead text-white-50 mb-0">Rejoignez la plus grande communauté d'experts technologiques au Sénégal. Posez, échangez et apprenez ensemble.</p>
            </div>
            <div class="col-lg-5 text-lg-end">
                <div class="hero-stats d-flex gap-4 justify-content-lg-end mt-4 mt-lg-0">
                    <div class="text-center">
                        <h3 class="text-white fw-bold mb-0" id="statTopics">0</h3>
                        <span class="text-white-50 small">Sujets</span>
                    </div>
                    <div class="text-center border-start border-secondary ps-4">
                        <h3 class="text-white fw-bold mb-0" id="statReplies">0</h3>
                        <span class="text-white-50 small">Réponses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Forum Content -->
<section class="forum-main py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="forum-sidebar-card">
                    <button class="btn btn-primary w-100 rounded-pill py-3 fw-bold mb-4 shadow-lg" data-bs-toggle="modal" data-bs-target="#newTopicModal">
                        <i class="fas fa-plus-circle me-2"></i> Poser une question
                    </button>

                    <h6 class="text-white-50 text-uppercase small ls-1 mb-3">Catégories</h6>
                    <div class="category-filters">
                        <div class="category-filter-item active" onclick="filterByCategory('All', this)">
                            <i class="fas fa-th-large"></i>
                            <span>Toutes les catégories</span>
                        </div>
                        <div class="category-filter-item" onclick="filterByCategory('General', this)">
                            <i class="fas fa-comments"></i>
                            <span>Général</span>
                        </div>
                        <div class="category-filter-item" onclick="filterByCategory('Tech', this)">
                            <i class="fas fa-code"></i>
                            <span>Technologie & IA</span>
                        </div>
                        <div class="category-filter-item" onclick="filterByCategory('Marketing', this)">
                            <i class="fas fa-bullhorn"></i>
                            <span>Digital Marketing</span>
                        </div>
                        <div class="category-filter-item" onclick="filterByCategory('Branding', this)">
                            <i class="fas fa-paint-brush"></i>
                            <span>Design & Branding</span>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top border-secondary">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4" style="background: rgba(99, 102, 241, 0.05);">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div>
                                <small class="text-white-50 d-block">Forum modéré</small>
                                <span class="text-white small fw-600">Experts ETAAM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Stream -->
            <div class="col-lg-9">
                <div class="forum-search-wrapper">
                    <i class="fas fa-search forum-search-icon"></i>
                    <input type="text" id="forumSearch" class="forum-search-input" placeholder="Rechercher une question, un mot-clé..." onkeyup="searchTopics()">
                </div>

                <div id="topicsContainer" class="d-flex flex-column gap-3">
                    <!-- Loading State -->
                    <div class="text-center py-5">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
<!-- New Topic Modal -->
<div class="modal fade" id="newTopicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content premium-modal">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h4 class="modal-title text-white fw-bold">Nouvelle Discussion</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="newTopicForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-white-50 small">Votre Nom d'affichage</label>
                            <input type="text" name="author_name" class="form-control form-dark-input" placeholder="Ex: Jean Dupont" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white-50 small">Catégorie</label>
                            <select name="category" class="form-select form-dark-input">
                                <option value="General">Général</option>
                                <option value="Marketing">Marketing Communication</option>
                                <option value="Tech">Technologie & IA</option>
                                <option value="Branding">Branding & Design</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white-50 small">Titre de votre question</label>
                            <input type="text" name="title" class="form-control form-dark-input" placeholder="Soyez précis pour obtenir de meilleures réponses" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white-50 small">Détails de votre message</label>
                            <textarea name="content" class="form-control form-dark-input" rows="6" placeholder="Décrivez votre situation ou votre question en détails..." required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-link text-white-50 text-decoration-none" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="newTopicForm" class="btn btn-primary px-5 rounded-pill fw-bold">Publier le sujet</button>
            </div>
        </div>
    </div>
</div>

<!-- Topic Detail Modal -->
<div class="modal fade" id="topicDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content premium-modal">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <div class="d-flex align-items-center gap-3">
                    <div id="detailCatBadge"></div>
                    <h4 class="modal-title text-white fw-bold" id="detailModalTitle"></h4>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="topicDetailContent" class="mb-5 pb-4 border-bottom border-secondary">
                    <!-- Topic detail loaded here -->
                </div>
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="text-white mb-0"><i class="far fa-comments me-2 text-primary"></i> Réponses</h5>
                    <button class="btn btn-sm btn-outline-primary rounded-pill" onclick="document.getElementById('replyInput').scrollIntoView({behavior: 'smooth'})">Répondre</button>
                </div>

                <div id="repliesContainer">
                    <!-- Replies loaded here -->
                </div>
                
                <div id="replyInput" class="mt-5 p-4 rounded-4 border border-secondary" style="background: rgba(255,255,255,0.02);">
                    <h6 class="text-white mb-3">Ajouter votre réponse</h6>
                    <form id="replyForm">
                        <input type="hidden" name="topic_id" id="replyTopicId">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <input type="text" name="author_name" class="form-control form-dark-input" placeholder="Votre nom" required>
                            </div>
                            <div class="col-12">
                                <textarea name="content" class="form-control form-dark-input" rows="4" placeholder="Apportez votre contribution à cette discussion..." required></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">Envoyer la réponse</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let allTopics = [];
let currentCategory = 'All';

document.addEventListener('DOMContentLoaded', function() {
    loadTopics();

    // New Topic Form
    document.getElementById('newTopicForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        fetch('api/forum_api.php?action=create_topic', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                bootstrap.Modal.getInstance(document.getElementById('newTopicModal')).hide();
                this.reset();
                loadTopics();
            }
        });
    });

    // Reply Form
    document.getElementById('replyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        fetch('api/forum_api.php?action=post_reply', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                this.reset();
                loadReplies(data.topic_id);
                loadTopics(); // Update counter
            }
        });
    });
});

function loadTopics() {
    fetch('api/forum_api.php?action=get_topics')
        .then(response => response.json())
        .then(topics => {
            allTopics = topics;
            updateStats(topics);
            renderTopics(topics);
        });
}

function updateStats(topics) {
    document.getElementById('statTopics').innerText = topics.length;
    const totalReplies = topics.reduce((sum, t) => sum + parseInt(t.reply_count || 0), 0);
    document.getElementById('statReplies').innerText = totalReplies;
}

function renderTopics(topics) {
    const container = document.getElementById('topicsContainer');
    
    const filteredTopics = topics.filter(t => 
        currentCategory === 'All' || t.category === currentCategory
    );

    if (filteredTopics.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <div class="mb-3"><i class="fas fa-search fa-3x text-white-50 opacity-25"></i></div>
                <h5 class="text-white-50">Aucun sujet trouvé</h5>
                <p class="text-muted small">Essayez de changer vos filtres ou soyez le premier à poser une question !</p>
            </div>
        `;
        return;
    }

    container.innerHTML = filteredTopics.map(topic => {
        const catClass = `badge-cat-${topic.category.toLowerCase()}`;
        return `
            <div class="topic-card-modern d-flex align-items-center" onclick="viewTopic(${topic.id})">
                <div class="topic-icon-box me-4 d-none d-md-flex">
                    <i class="fas ${getCategoryIcon(topic.category)}"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge badge-forum ${catClass}">${topic.category}</span>
                        <span class="text-white-50 small">• ${timeAgo(topic.created_at)}</span>
                    </div>
                    <h5 class="text-white mb-2 fw-bold">${topic.title}</h5>
                    <div class="d-flex align-items-center text-white-50 small">
                        <img src="https://ui-avatars.com/api/?name=${topic.author_name}&background=6366f1&color=fff" class="rounded-circle me-2" style="width: 20px; height: 20px;">
                        <span>Par <strong class="text-white-50">${topic.author_name}</strong></span>
                    </div>
                </div>
                <div class="ms-4 text-center d-none d-sm-block" style="min-width: 80px;">
                    <div class="text-white fw-bold h5 mb-0">${topic.reply_count}</div>
                    <div class="text-white-50 small" style="font-size: 10px; text-transform: uppercase;">Réponses</div>
                </div>
                <div class="ms-3">
                    <i class="fas fa-chevron-right text-white-50 opacity-50"></i>
                </div>
            </div>
        `;
    }).join('');
}

function getCategoryIcon(cat) {
    const icons = {
        'General': 'fa-comments',
        'Tech': 'fa-code',
        'Marketing': 'fa-bullhorn',
        'Branding': 'fa-paint-brush'
    };
    return icons[cat] || 'fa-question';
}

function timeAgo(date) {
    const seconds = Math.floor((new Date() - new Date(date)) / 1000);
    let interval = seconds / 31536000;
    if (interval > 1) return 'il y a ' + Math.floor(interval) + ' ans';
    interval = seconds / 2592000;
    if (interval > 1) return 'il y a ' + Math.floor(interval) + ' mois';
    interval = seconds / 86400;
    if (interval > 1) return 'il y a ' + Math.floor(interval) + ' jours';
    interval = seconds / 3600;
    if (interval > 1) return 'il y a ' + Math.floor(interval) + ' heures';
    interval = seconds / 60;
    if (interval > 1) return 'il y a ' + Math.floor(interval) + ' min';
    return "à l'instant";
}

function filterByCategory(cat, element) {
    currentCategory = cat;
    
    // Update active class
    document.querySelectorAll('.category-filter-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');

    renderTopics(allTopics);
}

function searchTopics() {
    const query = document.getElementById('forumSearch').value.toLowerCase();
    const filtered = allTopics.filter(t => 
        (t.title.toLowerCase().includes(query) || t.content.toLowerCase().includes(query))
    );
    renderTopics(filtered);
}

window.viewTopic = function(id) {
    const topic = allTopics.find(t => t.id == id);
    if (!topic) return;

    const catClass = `badge-cat-${topic.category.toLowerCase()}`;
    document.getElementById('detailCatBadge').innerHTML = `<span class="badge badge-forum ${catClass}">${topic.category}</span>`;
    document.getElementById('detailModalTitle').innerText = topic.title;
    
    document.getElementById('topicDetailContent').innerHTML = `
        <div class="d-flex align-items-center gap-3 mb-4 mt-2">
            <img src="https://ui-avatars.com/api/?name=${topic.author_name}&background=6366f1&color=fff" class="rounded-circle" style="width: 45px; height: 45px;">
            <div>
                <div class="text-white fw-bold mb-0">${topic.author_name}</div>
                <div class="text-white-50 small">Posté ${timeAgo(topic.created_at)}</div>
            </div>
        </div>
        <div class="topic-main-content text-white-50 fs-5 lh-base mb-4" style="font-weight: 300;">
            ${topic.content.replace(/\n/g, '<br>')}
        </div>
    `;
    
    document.getElementById('replyTopicId').value = id;
    loadReplies(id);
    new bootstrap.Modal(document.getElementById('topicDetailModal')).show();
}

function loadReplies(topicId) {
    const container = document.getElementById('repliesContainer');
    container.innerHTML = '<div class="text-center py-4 text-white-50"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Chargement des réponses...</div>';

    fetch('api/forum_api.php?action=get_replies&topic_id=' + topicId)
        .then(res => res.json())
        .then(replies => {
            if (replies.length === 0) {
                container.innerHTML = '<div class="text-center py-5 p-4 rounded-4" style="background: rgba(255,255,255,0.01); border: 1px dashed var(--card-border);"><p class="text-white-50 mb-0">Aucune réponse pour le moment.</p></div>';
                return;
            }

            container.innerHTML = replies.map(reply => `
                <div class="reply-card-modern ${reply.is_admin_reply ? 'admin-reply-premium' : ''}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=${reply.author_name}&background=${reply.is_admin_reply ? '6366f1' : '334155'}&color=fff" class="rounded-circle" style="width: 32px; height: 32px;">
                            <strong class="${reply.is_admin_reply ? 'text-primary' : 'text-white'}">
                                ${reply.author_name} 
                                ${reply.is_admin_reply ? '<span class="badge bg-primary ms-1" style="font-size: 0.6rem; vertical-align: middle;">EXPERT ETAAM</span>' : ''}
                            </strong>
                        </div>
                        <span class="text-white-50 small" style="font-size: 0.75rem;">${timeAgo(reply.created_at)}</span>
                    </div>
                    <div class="text-white-50 reply-body" style="font-weight: 300;">
                        ${reply.content.replace(/\n/g, '<br>')}
                    </div>
                </div>
            `).join('');
        });
}
</script>

<?php include('includes/footer.php'); ?>
