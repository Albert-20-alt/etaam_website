<?php
include 'includes/auth_check.php';
$pageTitle = "Gestion Accueil | Administration ETAAM";
if (!file_exists('data')) {
    mkdir('data', 0777, true);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administration | ETAAM</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    
    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/notech-responsive.css" />
    <link rel="stylesheet" href="assets/css/notech-dark.css" />
    
    <!-- Admin Specific Styles -->
    <link rel="stylesheet" href="assets/css/admin-nexlink.css" />

    <style>
        /* Sidebar overrides */
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
            padding: 30px;
        }

        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }
        
        /* content styles */
        .admin-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid #eef2f6;
        }
        
        label { font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 14px; }
        .form-control {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 15px;
            color: #1e293b;
        }
        h4 { color: #0f172a; font-weight: 700; margin-bottom: 20px; font-size: 18px; border-left: 4px solid #3B82F6; padding-left: 10px; }
        hr { border-top-color: #eef2f6; margin: 30px 0; }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'home';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="container-fluid">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 style="font-weight: 800; color: #1e293b;">Gestion de la Page d'Accueil</h2>
                    <p style="color: #64748b;">Gérez les sections principales (Bienvenue, Expertise, Appel à l'action).</p>
                </div>
            </div>

            <div class="admin-card">
                <form id="homeContentForm">
                    <!-- Loaded dynamically via JS -->
                    <div id="contentFormBuilder">
                        <div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x text-primary"></i></div>
                    </div>
                    <button type="submit" class="thm-btn mt-4">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </main>

    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
            
            loadPageData();

            // Handle Page Content Save
            $('#homeContentForm').on('submit', function(e) {
                e.preventDefault();
                savePageData();
            });
        });

        // Global Data Storage
        let pageData = {};

        // --- PAGE CONTENT LOGIC ---
        function loadPageData() {
            fetch('api/get_home_data.php')
                .then(res => res.json())
                .then(data => {
                    pageData = data;
                    renderContentForm(data);
                })
                .catch(err => {
                    console.error(err);
                    $('#contentFormBuilder').html('<div class="alert alert-danger">Erreur de chargement des données.</div>');
                });
        }

        function renderContentForm(data) {
            let html = '';
            
            // 0. Hero Section (Single)
            html += `<h4>Section Héro (Haut de page)</h4>
            <div class="alert alert-info py-2" style="font-size:13px;"><i class="fas fa-info-circle"></i> Cette section est statique (pas de slider). Modifiez le titre et l'image principale.</div>
            <div class="row">`;
            
            // Defensively ensure hero exists
            if(!data.hero) {
                data.hero = { title: '', subtitle: '', image: '' };
            }
            if(!pageData.hero) pageData.hero = data.hero;

            html += `<div class="col-md-12 mb-4">
                <div style="background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Titre Principal (HTML autorisé)</label>
                            <textarea class="form-control" rows="3" onchange="pageData.hero.title = this.value">${data.hero.title || ''}</textarea>
                            <small class="text-muted">Utilisez <code>&lt;span class="highlight-teal"&gt;mot&lt;/span&gt;</code> pour la couleur teal.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sous-titre / Description</label>
                            <textarea class="form-control" rows="3" onchange="pageData.hero.subtitle = this.value">${data.hero.subtitle || ''}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image Principale (Droite)</label>
                            <div class="d-flex align-items-center">
                                <img src="${data.hero.image || ''}" style="height: 100px; width: 100px; object-fit: cover; border-radius: 4px; margin-right: 15px; border: 1px solid #ddd; background:#eee;">
                                <input type="file" class="form-control" accept="image/*" onchange="uploadImage(this, (url) => pageData.hero.image = url)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            html += `</div><hr>`;

            // 0.5 Projects Section (New)
            html += `<h4>Projets à la Une</h4>
            <div class="row">`;
            
            // Defensively ensure projects exists
            if(!data.projects) {
                data.projects = {
                    project_1: { title: '', subtitle: '', image: '', link: '' },
                    project_2: { title: '', subtitle: '', image: '', link: '' },
                    project_3: { title: '', subtitle: '', image: '', link: '' },
                    project_4: { title: '', subtitle: '', image: '', link: '' }
                };
            }

            [1, 2, 3, 4].forEach(i => {
                let p = data.projects[`project_${i}`] || { title:'', subtitle:'', image:'', link:'' };
                // Ensure pageData binding
                if(!pageData.projects) pageData.projects = {};
                if(!pageData.projects[`project_${i}`]) pageData.projects[`project_${i}`] = p;

                html += `<div class="col-md-6 mb-4">
                    <div style="background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0; height:100%;">
                        <h6 class="text-primary mb-3">Projet ${i}</h6>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Image</label>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="${p.image || ''}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 4px; margin-right: 10px; border: 1px solid #ddd;">
                                    <input type="file" class="form-control p-1" accept="image/*" onchange="uploadImage(this, (url) => pageData.projects.project_${i}.image = url)" style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Petit Titre (Catégorie)</label>
                                <input type="text" class="form-control" value="${p.subtitle || ''}" onchange="pageData.projects.project_${i}.subtitle = this.value">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Titre Projet</label>
                                <input type="text" class="form-control" value="${p.title || ''}" onchange="pageData.projects.project_${i}.title = this.value">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Lien (URL)</label>
                                <input type="text" class="form-control" value="${p.link || ''}" onchange="pageData.projects.project_${i}.link = this.value">
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            html += `</div><hr>`;

            // 1. Welcome Section
            html += `<h4>Section : Qui Sommes-Nous</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tagline (Petit titre)</label>
                    <input type="text" class="form-control" value="${data.welcome.tagline || ''}" onchange="pageData.welcome.tagline = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Titre Principal</label>
                    <input type="text" class="form-control" value="${data.welcome.title || ''}" onchange="pageData.welcome.title = this.value">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Texte Paragraphe 1</label>
                    <textarea class="form-control" rows="2" onchange="pageData.welcome.text_1 = this.value">${data.welcome.text_1 || ''}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Texte Paragraphe 2</label>
                    <textarea class="form-control" rows="2" onchange="pageData.welcome.text_2 = this.value">${data.welcome.text_2 || ''}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image de la section</label>
                    <div class="d-flex align-items-center">
                        <img src="${data.welcome.image || ''}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 4px; margin-right: 10px; border: 1px solid #ddd;">
                        <input type="file" class="form-control" accept="image/*" onchange="uploadImage(this, (url) => pageData.welcome.image = url)">
                    </div>
                </div>
            </div><hr>`;

            // 2. Consult Section
            html += `<h4>Section : Expertise / Conseil</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tagline</label>
                    <input type="text" class="form-control" value="${data.consult.tagline || ''}" onchange="pageData.consult.tagline = this.value">
                </div>
                 <div class="col-md-6 mb-3">
                    <label>Titre</label>
                    <input type="text" class="form-control" value="${data.consult.title || ''}" onchange="pageData.consult.title = this.value">
                </div>
                 <div class="col-md-12 mb-3">
                    <label>Texte Principal</label>
                    <textarea class="form-control" rows="3" onchange="pageData.consult.text = this.value">${data.consult.text || ''}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image de la section</label>
                    <div class="d-flex align-items-center">
                        <img src="${data.consult.image || ''}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 4px; margin-right: 10px; border: 1px solid #ddd;">
                        <input type="file" class="form-control" accept="image/*" onchange="uploadImage(this, (url) => pageData.consult.image = url)">
                    </div>
                </div>
            </div><hr>`;

            // 3. Business From Section
            html += `<h4>Section : Appel à l'action (Business)</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Sous-titre</label>
                    <input type="text" class="form-control" value="${data.business_from.subtitle || ''}" onchange="pageData.business_from.subtitle = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Titre</label>
                    <input type="text" class="form-control" value="${data.business_from.title || ''}" onchange="pageData.business_from.title = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Texte Bouton</label>
                    <input type="text" class="form-control" value="${data.business_from.button_text || ''}" onchange="pageData.business_from.button_text = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Lien Bouton</label>
                    <input type="text" class="form-control" value="${data.business_from.button_url || ''}" onchange="pageData.business_from.button_url = this.value">
                </div>
            </div><hr>`;

            // 4. Notech More (Why Choose Us)
            html += `<h4>Section : Pourquoi Nous Choisir</h4>
            <div class="row">
                 <div class="col-md-6 mb-3">
                    <label>Tagline</label>
                    <input type="text" class="form-control" value="${data.notech_more.tagline || ''}" onchange="pageData.notech_more.tagline = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Titre</label>
                    <input type="text" class="form-control" value="${data.notech_more.title || ''}" onchange="pageData.notech_more.title = this.value">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Texte Principal</label>
                    <textarea class="form-control" rows="3" onchange="pageData.notech_more.text = this.value">${data.notech_more.text || ''}</textarea>
                </div>
                 <div class="col-md-6 mb-3">
                    <label>Image de la section</label>
                    <div class="d-flex align-items-center">
                        <img src="${data.notech_more.image || ''}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 4px; margin-right: 10px; border: 1px solid #ddd;">
                        <input type="file" class="form-control" accept="image/*" onchange="uploadImage(this, (url) => pageData.notech_more.image = url)">
                    </div>
                </div>
            </div>`;

            $('#contentFormBuilder').html(html);
        }

        function uploadImage(input, callback) {
            if (input.files && input.files[0]) {
                let fd = new FormData();
                fd.append('file', input.files[0]);
                
                fetch('api/upload_about_image.php', { method: 'POST', body: fd })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        $(input).prev('img').attr('src', data.url);
                        callback(data.url);
                        Swal.fire({
                            toast: true, position: 'top-end', icon: 'success', 
                            title: 'Image uploadée', showConfirmButton: false, timer: 1500
                        });
                    } else {
                        Swal.fire('Erreur', data.error, 'error');
                    }
                })
                .catch(err => {
                    console.error('Upload Error:', err);
                    Swal.fire('Erreur', 'Erreur réseau.', 'error');
                });
            }
        }

        function savePageData() {
            fetch('api/save_home_data.php', {
                method: 'POST',
                body: JSON.stringify(pageData)
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Enregistré !',
                        text: 'Le contenu de la page d\'accueil a été mis à jour.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la sauvegarde.'
                    });
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur Réseau',
                    text: 'Impossible de contacter le serveur.'
                });
            });
        }
    </script>
</body>
</html>
