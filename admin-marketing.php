<?php include 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion Marketing | Administration ETAAM</title>
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
        /* Sidebar styles */
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

        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .admin-sidebar.show { transform: translateX(0); }
        }

        /* Page-specific styles */
        :root {
            --admin-sidebar-width: 280px;
            --admin-bg: #0f1014;
            --admin-card-bg: #1a1b21;
            --admin-border-color: rgba(255, 255, 255, 0.05);
        }

        body {
            background-color: var(--admin-bg);
            color: #fff;
        }

        .admin-main {
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            background: var(--admin-bg);
            padding: 30px;
        }

        @media (max-width: 991px) {
            .admin-main { margin-left: 0; padding: 20px; }
        }
        
        .admin-card {
            background: var(--admin-card-bg);
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            padding: 35px;
            margin-bottom: 30px;
            border: 1px solid var(--admin-border-color);
        }
        
        .section-header {
            color: #fff;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3B82F6;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control, textarea.form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 15px;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus, textarea.form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #3B82F6;
            outline: none;
            color: #fff !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .service-card, .testimonial-card, .stat-card {
            background: rgba(255, 255, 255, 0.03);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 20px;
        }

        .service-label {
            font-weight: 700;
            color: #3B82F6;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .btn-save {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            color: white;
            border: none;
            padding: 14px 35px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            box-shadow: 0 5px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .loading-spinner {
            text-align: center;
            padding: 60px 0;
            color: #3B82F6;
        }

        small.text-muted {
            color: rgba(255, 255, 255, 0.4);
            font-size: 12px;
        }

        .input-hint {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 5px;
        }

        hr {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 40px 0;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'marketing';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="container-fluid">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 style="font-weight: 800; color: #fff;">Gestion de la Page Marketing</h2>
                    <p style="color: rgba(255,255,255,0.6);">Gérez tous les contenus de votre page marketing digitale.</p>
                </div>
            </div>

            <div class="admin-card">
                <form id="marketingContentForm">
                    <!-- Loaded dynamically via JS -->
                    <div id="contentFormBuilder">
                        <div class="loading-spinner">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                            <p style="margin-top: 20px;">Chargement des données...</p>
                        </div>
                    </div>
                    <button type="submit" class="btn-save mt-4">
                        <i class="fas fa-save me-2"></i> Enregistrer toutes les modifications
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Sidebar Toggle
            $('#openSidebar').click(function () {
                $('#adminSidebar').addClass('show');
                $('#sidebarOverlay').addClass('show');
            });

            $('#closeSidebar, #sidebarOverlay').click(function () {
                $('#adminSidebar').removeClass('show');
                $('#sidebarOverlay').removeClass('show');
            });
            
            loadMarketingData();

            // Handle Form Save
            $('#marketingContentForm').on('submit', function(e) {
                e.preventDefault();
                saveMarketingData();
            });
        });

        // Global Data Storage
        let marketingData = {};

        function loadMarketingData() {
            fetch('api/get_marketing_data.php')
                .then(res => res.json())
                .then(data => {
                    marketingData = data;
                    renderMarketingForm(data);
                })
                .catch(err => {
                    console.error(err);
                    $('#contentFormBuilder').html('<div class="alert alert-danger">Erreur de chargement des données.</div>');
                });
        }

        function renderMarketingForm(data) {
            let html = '';
            
            // Ensure all sections exist with defaults
            if(!data.hero) data.hero = {};
            if(!data.stats) data.stats = {};
            if(!data.services) data.services = {};
            if(!data.process) data.process = {};
            if(!data.testimonials) data.testimonials = {};
            if(!data.cta) data.cta = {};

            // 1. HERO SECTION
            html += `
            <div class="section-header">
                <i class="fas fa-rocket"></i> Section Héro (En-tête)
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Titre Principal (HTML autorisé)</label>
                    <textarea class="form-control" rows="3" onchange="marketingData.hero.title = this.value">${data.hero.title || ''}</textarea>
                    <small class="input-hint">Utilisez &lt;br&gt; pour les sauts de ligne et &lt;span&gt; pour la couleur</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Sous-titre / Description</label>
                    <textarea class="form-control" rows="3" onchange="marketingData.hero.subtitle = this.value">${data.hero.subtitle || ''}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Texte Bouton 1</label>
                    <input type="text" class="form-control" value="${data.hero.cta1_text || ''}" onchange="marketingData.hero.cta1_text = this.value">
                </div>
                <div class="col-md-3 mb-3">
                    <label>URL Bouton 1</label>
                    <input type="text" class="form-control" value="${data.hero.cta1_url || ''}" onchange="marketingData.hero.cta1_url = this.value">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Texte Bouton 2</label>
                    <input type="text" class="form-control" value="${data.hero.cta2_text || ''}" onchange="marketingData.hero.cta2_text = this.value">
                </div>
                <div class="col-md-3 mb-3">
                    <label>URL Bouton 2</label>
                    <input type="text" class="form-control" value="${data.hero.cta2_url || ''}" onchange="marketingData.hero.cta2_url = this.value">
                </div>
            </div>
            <hr>`;

            // 2. STATS SECTION
            html += `
            <div class="section-header">
                <i class="fas fa-chart-bar"></i> Statistiques (4 cartes)
            </div>
            <div class="row">`;
            
            for(let i = 1; i <= 4; i++) {
                html += `
                <div class="col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="service-label">Statistique ${i}</div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Valeur (ex: 150+, 300%)</label>
                                <input type="text" class="form-control" value="${data.stats['stat'+i+'_value'] || ''}" onchange="marketingData.stats.stat${i}_value = this.value">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Libellé</label>
                                <input type="text" class="form-control" value="${data.stats['stat'+i+'_label'] || ''}" onchange="marketingData.stats.stat${i}_label = this.value">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Couleur (code hex)</label>
                                <input type="text" class="form-control" value="${data.stats['stat'+i+'_color'] || ''}" onchange="marketingData.stats.stat${i}_color = this.value" placeholder="#6A4C93">
                            </div>
                        </div>
                    </div>
                </div>`;
            }
            
            html += `</div><hr>`;

            // 3. SERVICES SECTION
            html += `
            <div class="section-header">
                <i class="fas fa-cogs"></i> Services Marketing (6 services)
            </div>
            <div class="row">`;
            
            for(let i = 1; i <= 6; i++) {
                const service = data.services['service'+i] || {};
                if(!marketingData.services['service'+i]) marketingData.services['service'+i] = service;
                
                html += `
                <div class="col-lg-6 mb-4">
                    <div class="service-card">
                        <div class="service-label">Service ${i}</div>
                        <div class="mb-3">
                            <label>Icône FontAwesome (classe)</label>
                            <input type="text" class="form-control" value="${service.icon || ''}" onchange="marketingData.services.service${i}.icon = this.value" placeholder="fas fa-bullseye">
                        </div>
                        <div class="mb-3">
                            <label>Couleur (hex)</label>
                            <input type="text" class="form-control" value="${service.color || ''}" onchange="marketingData.services.service${i}.color = this.value" placeholder="#6A4C93">
                        </div>
                        <div class="mb-3">
                            <label>Titre du Service</label>
                            <input type="text" class="form-control" value="${service.title || ''}" onchange="marketingData.services.service${i}.title = this.value">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" onchange="marketingData.services.service${i}.description = this.value">${service.description || ''}</textarea>
                        </div>
                        <div class="mb-2">
                            <label>Caractéristique 1</label>
                            <input type="text" class="form-control" value="${service.feature1 || ''}" onchange="marketingData.services.service${i}.feature1 = this.value">
                        </div>
                        <div class="mb-2">
                            <label>Caractéristique 2</label>
                            <input type="text" class="form-control" value="${service.feature2 || ''}" onchange="marketingData.services.service${i}.feature2 = this.value">
                        </div>
                        <div class="mb-2">
                            <label>Caractéristique 3</label>
                            <input type="text" class="form-control" value="${service.feature3 || ''}" onchange="marketingData.services.service${i}.feature3 = this.value">
                        </div>
                    </div>
                </div>`;
            }
            
            html += `</div><hr>`;

            // 4. PROCESS SECTION
            html += `
            <div class="section-header">
                <i class="fas fa-tasks"></i> Processus (4 étapes)
            </div>
            <div class="row">`;
            
            for(let i = 1; i <= 4; i++) {
                html += `
                <div class="col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="service-label">Étape ${i}</div>
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" class="form-control" value="${data.process['step'+i+'_title'] || ''}" onchange="marketingData.process.step${i}_title = this.value">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control" rows="2" onchange="marketingData.process.step${i}_description = this.value">${data.process['step'+i+'_description'] || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Gradient (CSS)</label>
                            <input type="text" class="form-control" value="${data.process['step'+i+'_color'] || ''}" onchange="marketingData.process.step${i}_color = this.value" placeholder="linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%)">
                        </div>
                    </div>
                </div>`;
            }
            
            html += `</div><hr>`;

            // 5. TESTIMONIALS SECTION
            html += `
            <div class="section-header">
                <i class="fas fa-star"></i> Témoignages Clients (3 témoignages)
            </div>
            <div class="row">`;
            
            for(let i = 1; i <= 3; i++) {
                const testimonial = data.testimonials['testimonial'+i] || {};
                if(!marketingData.testimonials['testimonial'+i]) marketingData.testimonials['testimonial'+i] = testimonial;
                
                html += `
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="service-label">Témoignage ${i}</div>
                        <div class="mb-3">
                            <label>Nom du Client</label>
                            <input type="text" class="form-control" value="${testimonial.name || ''}" onchange="marketingData.testimonials.testimonial${i}.name = this.value">
                        </div>
                        <div class="mb-3">
                            <label>Fonction</label>
                            <input type="text" class="form-control" value="${testimonial.role || ''}" onchange="marketingData.testimonials.testimonial${i}.role = this.value">
                        </div>
                        <div class="mb-3">
                            <label>Entreprise</label>
                            <input type="text" class="form-control" value="${testimonial.company || ''}" onchange="marketingData.testimonials.testimonial${i}.company = this.value">
                        </div>
                        <div class="mb-3">
                            <label>Citation</label>
                            <textarea class="form-control" rows="3" onchange="marketingData.testimonials.testimonial${i}.quote = this.value">${testimonial.quote || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Note (1-5)</label>
                            <input type="number" min="1" max="5" class="form-control" value="${testimonial.rating || 5}" onchange="marketingData.testimonials.testimonial${i}.rating = parseInt(this.value)">
                        </div>
                        <div class="mb-3">
                            <label>Gradient Avatar (CSS)</label>
                            <input type="text" class="form-control" value="${testimonial.color || ''}" onchange="marketingData.testimonials.testimonial${i}.color = this.value" placeholder="linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%)">
                        </div>
                    </div>
                </div>`;
            }
            
            html += `</div><hr>`;

            // 6. CTA SECTION
            html += `
            <div class="section-header">
                <i class="fas fa-bullhorn"></i> Appel à l'Action (CTA Final)
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Titre Principal</label>
                    <input type="text" class="form-control" value="${data.cta.title || ''}" onchange="marketingData.cta.title = this.value">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" onchange="marketingData.cta.description = this.value">${data.cta.description || ''}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Texte Bouton 1</label>
                    <input type="text" class="form-control" value="${data.cta.button1_text || ''}" onchange="marketingData.cta.button1_text = this.value">
                </div>
                <div class="col-md-3 mb-3">
                    <label>URL Bouton 1</label>
                    <input type="text" class="form-control" value="${data.cta.button1_url || ''}" onchange="marketingData.cta.button1_url = this.value">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Texte Bouton 2</label>
                    <input type="text" class="form-control" value="${data.cta.button2_text || ''}" onchange="marketingData.cta.button2_text = this.value">
                </div>
                <div class="col-md-3 mb-3">
                    <label>URL Bouton 2</label>
                    <input type="text" class="form-control" value="${data.cta.button2_url || ''}" onchange="marketingData.cta.button2_url = this.value">
                </div>
            </div>`;

            $('#contentFormBuilder').html(html);
        }

        function saveMarketingData() {
            fetch('api/save_marketing_data.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(marketingData)
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès !',
                        text: 'Les données marketing ont été enregistrées avec succès.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: res.error || 'Une erreur est survenue lors de la sauvegarde.'
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
