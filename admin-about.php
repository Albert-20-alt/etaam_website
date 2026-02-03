<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';
$pageTitle = "Gestion À Propos | Administration ETAAM";

// Fetch unread messages count for sidebar
$unread_count = 0;
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'unread'");
    $unread_count = $stmt->fetchColumn();
} catch (PDOException $e) {}

// Ensure data folder exists (though we use DB now, keeping for legacy/media if needed)
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
        :root {
            --admin-bg: #0f1014;
            --admin-card-bg: #1a1b21;
            --admin-border-color: rgba(255, 255, 255, 0.05);
            --admin-text-muted: #94a3b8;
            --accent-color: #3B82F6;
            --admin-sidebar-width: 280px;
        }

        body {
            background-color: var(--admin-bg);
            color: #fff;
            font-family: 'Kumbh Sans', sans-serif;
        }

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

        .admin-sidebar::-webkit-scrollbar { width: 4px; }
        .admin-sidebar::-webkit-scrollbar-track { background: transparent; }
        .admin-sidebar::-webkit-scrollbar-thumb { background: var(--accent-color); border-radius: 10px; }

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
        
        .admin-card {
            background: var(--admin-card-bg);
            border-radius: 16px;
            border: 1px solid var(--admin-border-color);
            padding: 30px;
            margin-bottom: 25px;
        }
        
        label { font-weight: 600; color: #94a3b8; margin-bottom: 10px; font-size: 14px; display: block; }
        
        .form-control {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 12px !important;
            padding: 12px 18px !important;
            font-size: 15px !important;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
            outline: none;
        }

        h4 { 
            color: #fff; 
            font-weight: 700; 
            margin-bottom: 25px; 
            font-size: 18px; 
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        h4::before {
            content: '';
            display: block;
            width: 4px;
            height: 20px;
            background: var(--accent-color);
            border-radius: 10px;
        }

        hr { border-top-color: var(--admin-border-color); margin: 30px 0; opacity: 1; }

        /* Custom file input */
        input[type="file"]::file-selector-button {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            padding: 5px 12px;
            margin-right: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="file"]::file-selector-button:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'about';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="container-fluid">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 style="font-weight: 800; color: #1e293b;">Gestion de la page À Propos</h2>
                    <p style="color: #64748b;">Modifiez le contenu textuel de la page.</p>
                </div>
            </div>

            <!-- Feedback Message -->
            <div id="feedback" class="alert" style="display:none;"></div>

            <div class="admin-card">
                <form id="aboutContentForm">
                    <!-- Loaded dynamically via JS -->
                    <div id="contentFormBuilder">Loading...</div>
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
            $('#aboutContentForm').on('submit', function(e) {
                e.preventDefault();
                savePageData();
            });
        });

        // Global Data Storage
        let pageData = {};

        // --- PAGE CONTENT LOGIC ---
        // --- PAGE CONTENT LOGIC ---
        function loadPageData() {
            fetch('api/get_about_data.php')
                .then(res => res.json())
                .then(data => {
                    pageData = data;
                    renderContentForm(data);
                })
                .catch(err => {
                    console.error(err);
                    $('#contentFormBuilder').html('<div class="alert alert-danger">Erreur lors du chargement des données.</div>');
                });
        }

        function renderContentForm(data) {
            let html = '';
            
            // Header Section
            html += `<h4>En-tête de page</h4><div class="row">
                <div class="col-md-6 mb-3">
                    <label>Titre Principal</label>
                    <input type="text" class="form-control" value="${data.page_header?.title || ''}" onchange="pageData.page_header.title = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image de Fond de l'Entête</label>
                    <div class="d-flex align-items-center gap-3">
                        <img src="${data.page_header?.background_image || ''}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                        <input type="file" class="form-control" accept="image/*" onchange="uploadImage(this, (url) => pageData.page_header.background_image = url)">
                    </div>
                </div>
            </div><hr>`;

            // Why Choose Us / About Intro
            html += `<h4>Section Identité ETAAM</h4>
                <div class="row">
                    <div class="col-md-6 mb-3"><label>Tagline</label><input type="text" class="form-control" value="${data.why_choose_us?.tagline || ''}" onchange="pageData.why_choose_us.tagline = this.value"></div>
                    <div class="col-md-6 mb-3"><label>Titre</label><input type="text" class="form-control" value="${data.why_choose_us?.title || ''}" onchange="pageData.why_choose_us.title = this.value"></div>
                    <div class="col-md-6 mb-3">
                        <label>Image Graphique</label>
                        <div class="d-flex align-items-center gap-3">
                            <img src="${data.why_choose_us?.image || ''}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                            <input type="file" class="form-control" accept="image/*" onchange="uploadImage(this, (url) => pageData.why_choose_us.image = url)">
                        </div>
                    </div>
                    <div class="col-12 mb-3"><label>Texte Principal</label><textarea rows="4" class="form-control" onchange="pageData.why_choose_us.main_text = this.value">${data.why_choose_us?.main_text || ''}</textarea></div>
                </div><hr>`;

            // Values Section
            html += `<h4>Section Nos Valeurs</h4>
                <div class="row">
                    <div class="col-md-6 mb-3"><label>Tagline</label><input type="text" class="form-control" value="${data.values_section?.tagline || 'Nos Valeurs'}" onchange="pageData.values_section = pageData.values_section || {}; pageData.values_section.tagline = this.value"></div>
                    <div class="col-md-6 mb-3"><label>Titre</label><input type="text" class="form-control" value="${data.values_section?.title || 'Ce Qui Nous Définit'}" onchange="pageData.values_section = pageData.values_section || {}; pageData.values_section.title = this.value"></div>
                </div>
                <div class="row">`;
            
            const defaultValues = [
                { title: 'Innovation', text: 'Nous repoussons les limites technologiques.', icon: 'assets/images/icons/icon-innovation.png' },
                { title: 'Intégrité', text: 'La transparence guide nos actions.', icon: 'assets/images/icons/icon-integrity.png' },
                { title: 'Excellence', text: 'Nous visons l\'excellence.', icon: 'assets/images/icons/icon-excellence.png' },
                { title: 'Engagement Local', text: 'Contribuer au développement numérique.', icon: 'assets/images/icons/icon-engagement.png' }
            ];
            
            const values = data.values_section?.values || defaultValues;
            values.forEach((val, idx) => {
                html += `<div class="col-md-6 col-lg-3 mb-3">
                    <div style="background: rgba(255,255,255,0.02); padding:20px; border-radius:16px; border:1px solid rgba(255,255,255,0.05); height:100%;">
                        <label>Valeur ${idx + 1} - Titre</label>
                        <input type="text" class="form-control mb-2" value="${val.title}" onchange="updateValue(${idx}, 'title', this.value)">
                        <label>Description</label>
                        <textarea class="form-control mb-2" rows="2" onchange="updateValue(${idx}, 'text', this.value)">${val.text}</textarea>
                        <label>Icône</label>
                        <div class="d-flex align-items-center gap-2">
                            <img src="${val.icon}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 8px;">
                            <input type="file" class="form-control" accept="image/*" onchange="uploadValueIcon(this, ${idx})" style="font-size: 11px;">
                        </div>
                    </div>
                </div>`;
            });
            html += `</div><hr>`;

            // Business From / CTA Section
            html += `<h4>Section CTA (Appel à l'Action)</h4><div class="row">
                <div class="col-md-6 mb-3"><label>Sous-titre</label><input type="text" class="form-control" value="${data.business_from?.subtitle || ''}" onchange="pageData.business_from.subtitle = this.value"></div>
                <div class="col-md-6 mb-3"><label>Titre</label><textarea class="form-control" onchange="pageData.business_from.title = this.value">${data.business_from?.title || ''}</textarea></div>
                <div class="col-md-6 mb-3"><label>Texte du Bouton</label><input type="text" class="form-control" value="${data.business_from?.button_text || ''}" onchange="pageData.business_from.button_text = this.value"></div>
                <div class="col-md-6 mb-3"><label>URL du Bouton</label><input type="text" class="form-control" value="${data.business_from?.button_url || ''}" onchange="pageData.business_from.button_url = this.value"></div>
            </div>`;

            $('#contentFormBuilder').html(html);
        }

        function updateValue(index, field, value) {
            if (!pageData.values_section) pageData.values_section = { values: [] };
            if (!pageData.values_section.values) pageData.values_section.values = [];
            if (!pageData.values_section.values[index]) pageData.values_section.values[index] = {};
            pageData.values_section.values[index][field] = value;
        }

        function uploadValueIcon(input, index) {
            if (input.files && input.files[0]) {
                let fd = new FormData();
                fd.append('file', input.files[0]);
                
                fetch('api/upload_about_image.php', { method: 'POST', body: fd })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        $(input).closest('.d-flex').find('img').attr('src', data.url);
                        updateValue(index, 'icon', data.url);
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Icône uploadée',
                            showConfirmButton: false,
                            timer: 1500,
                            background: '#1a1b21',
                            color: '#fff'
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Erreur', text: data.error, background: '#1a1b21', color: '#fff' });
                    }
                })
                .catch(err => {
                    console.error('Upload Error:', err);
                    Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur réseau.', background: '#1a1b21', color: '#fff' });
                });
            }
        }

        function uploadImage(input, callback) {
            if (input.files && input.files[0]) {
                let fd = new FormData();
                fd.append('file', input.files[0]);
                
                fetch('api/upload_about_image.php', { method: 'POST', body: fd })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        $(input).closest('.d-flex').find('img').attr('src', data.url);
                        callback(data.url);
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Image uploadée',
                            showConfirmButton: false,
                            timer: 1500,
                            background: '#1a1b21',
                            color: '#fff'
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Erreur', text: data.error, background: '#1a1b21', color: '#fff' });
                    }
                })
                .catch(err => {
                    console.error('Upload Error:', err);
                    Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur réseau.', background: '#1a1b21', color: '#fff' });
                });
            }
        }

        function savePageData() {
            fetch('api/save_about_data.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(pageData)
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Enregistré !',
                        text: 'Le contenu a été mis à jour dans la base de données.',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#1a1b21',
                        color: '#fff'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: res.error || 'Une erreur est survenue.',
                        background: '#1a1b21',
                        color: '#fff'
                    });
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Impossible de contacter le serveur.',
                    background: '#1a1b21',
                    color: '#fff'
                });
            });
        }
    </script>
</body>
</html>
