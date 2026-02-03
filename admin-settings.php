<?php include 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paramètres | Administration ETAAM</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Paramètres de configuration ETAAM" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="assets/vendors/notech-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/timepicker/timePicker.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/notech-responsive.css" />
    <link rel="stylesheet" href="assets/css/notech-dark.css" />

    <style>
        :root {
            --admin-sidebar-width: 280px;
            --admin-header-height: 80px;
            --admin-bg: #0f1014;
            --admin-card-bg: #1a1b21;
        }

        body {
            background-color: var(--admin-bg);
            color: #fff;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background-color: var(--admin-card-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
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

        .admin-logo {
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
        }

        .admin-nav-item {
            margin-bottom: 10px;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .admin-nav-link.active,
        .admin-nav-link:hover {
            background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);
            color: #fff;
        }

        .admin-nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: var(--admin-sidebar-width);
            padding: 30px 40px;
        }

        /* Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #3B82F6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        /* Settings Forms */
        .settings-card {
            background: var(--admin-card-bg);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .settings-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 15px;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.05);
            border-color: #3B82F6;
            outline: none;
            color: #fff !important;
        }

        .btn-save {
            background: #3B82F6;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-save:hover {
            background: #2563EB;
        }

        /* Media Queries */
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
                padding: 20px;
            }

            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            margin-right: 15px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        .sidebar-overlay.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'settings';
    include 'includes/admin_sidebar.php'; 
    ?>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div style="display: flex; align-items: center;">
                    <button class="mobile-toggle" id="openSidebar"><i class="fas fa-bars"></i></button>
                    <div>
                        <h2 class="section-title__title" style="font-size: 28px; margin: 0;">Paramètres</h2>
                        <p style="color: rgba(255,255,255,0.5); margin: 5px 0 0;">Configuration générale du site</p>
                    </div>
                </div>
                <div class="admin-user">
                    <div class="text-end" style="margin-right: 15px;">
                        <div style="font-weight: 600;">Administrateur</div>
                        <div style="font-size: 13px; color: rgba(255,255,255,0.5);">Super Admin</div>
                    </div>
                    <div class="admin-avatar">A</div>
                </div>
            </header>

            <!-- Settings Grid -->
            <div class="row">
                <!-- General Settings -->
                <div class="col-lg-6">
                    <div class="settings-card">
                        <h3 class="settings-title">Informations Générales</h3>
                        <form id="generalForm">
                            <div class="form-group">
                                <label class="form-label">Nom du Site</label>
                                <input type="text" class="form-control" id="input_site_name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Logo du Site</label>
                                <div class="d-flex align-items-center">
                                    <img id="preview_logo" src="" style="height: 50px; width: auto; max-width: 100px; object-fit: contain; border-radius: 4px; margin-right: 15px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
                                    <div style="flex-grow: 1;">
                                        <input type="file" class="form-control" accept="image/*" onchange="uploadLogo(this)">
                                        <input type="hidden" id="input_logo">
                                        <small style="color: rgba(255,255,255,0.4); font-size: 11px;">PNG ou SVG transparent recommandé</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Slogan</label>
                                <input type="text" class="form-control" id="input_tagline">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email de Contact</label>
                                <input type="email" class="form-control" id="input_email">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="input_phone">
                            </div>
                            <button type="button" class="btn-save" onclick="saveSettings()">Enregistrer</button>
                        </form>
                    </div>
                </div>

                <!-- Location & Social -->
                <div class="col-lg-6">
                    <div class="settings-card">
                        <h3 class="settings-title">Localisation & Réseaux</h3>
                        <form id="socialForm">
                            <div class="form-group">
                                <label class="form-label">Adresse</label>
                                <textarea class="form-control" rows="3" id="input_address"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Facebook URL</label>
                                <input type="text" class="form-control" id="input_facebook">
                            </div>
                            <div class="form-group">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="text" class="form-control" id="input_linkedin">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Twitter/X URL</label>
                                <input type="text" class="form-control" id="input_twitter">
                            </div>
                            <button type="button" class="btn-save" onclick="saveSettings()">Enregistrer</button>
                        </form>
                    </div>
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

            // Initial Load
            loadSettings();
        });

        function loadSettings() {
            fetch('api/get_settings.php')
                .then(res => res.json())
                .then(data => {
                    if(data.error) return console.error(data.error);
                    
                    // Reconstruct structure from flat keys for our form logic
                    // The PHP returns flat: {site_name: ..., address: ...}
                    
                    // General
                    $('#input_site_name').val(data.site_name || '');
                    $('#input_tagline').val(data.tagline || '');
                    $('#input_email').val(data.email || '');
                    $('#input_phone').val(data.phone || '');
                    
                    // Logo
                    if(data.logo) {
                        $('#input_logo').val(data.logo);
                        $('#preview_logo').attr('src', data.logo);
                    } else {
                        $('#preview_logo').attr('src', 'assets/images/resources/logo-2.png'); // Default fallback
                    }

                    // Social
                    $('#input_address').val(data.address || '');
                    $('#input_facebook').val(data.facebook || '');
                    $('#input_linkedin').val(data.linkedin || '');
                    $('#input_twitter').val(data.twitter || '');
                })
                .catch(err => console.error('Error loading settings:', err));
        }

        function uploadLogo(input) {
            if (input.files && input.files[0]) {
                let fd = new FormData();
                fd.append('file', input.files[0]);
                
                // Reusing the about image uploader as it does the job (validates images, saves to resources)
                fetch('api/upload_about_image.php', { method: 'POST', body: fd })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        $('#preview_logo').attr('src', data.url);
                        $('#input_logo').val(data.url);
                        
                        Swal.fire({
                            toast: true, position: 'top-end', icon: 'success', 
                            title: 'Logo uploadé', showConfirmButton: false, timer: 1500
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

        function saveSettings() {
            const settings = {
                general: {
                    site_name: $('#input_site_name').val(),
                    tagline: $('#input_tagline').val(),
                    email: $('#input_email').val(),
                    phone: $('#input_phone').val(),
                    logo: $('#input_logo').val()
                },
                social: {
                    address: $('#input_address').val(),
                    facebook: $('#input_facebook').val(),
                    linkedin: $('#input_linkedin').val(),
                    twitter: $('#input_twitter').val()
                }
            };

            fetch('api/save_settings.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(settings)
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Paramètres enregistrés avec succès !',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire('Erreur', 'Impossible d\'enregistrer les données.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Erreur', 'Erreur de communication avec le serveur.', 'error');
            });
        }
    </script>
</body>

</html>