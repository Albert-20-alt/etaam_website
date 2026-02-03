<?php include 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Marketing | Administration ETAAM</title>
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

        .stat-widget {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
            padding: 25px;
            border-radius: 15px;
            color: white;
            text-align: center;
        }

        .stat-value {
            font-size: 3rem;
            font-weight: 800;
            margin: 10px 0;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: #F59E0B;
            box-shadow: none;
        }

        .table {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .table thead th {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'email-marketing';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="container-fluid">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 style="font-weight: 800; color: #fff;">Email Marketing</h2>
                    <p style="color: rgba(255,255,255,0.6);">Gérez vos abonnés et envoyez des campagnes.</p>
                </div>
            </div>

            <div class="row">
                <!-- Stats -->
                <div class="col-md-4 mb-4">
                    <div class="stat-widget">
                        <h3>Abonnés Newsletter</h3>
                        <div class="stat-value" id="subscriberCount">0</div>
                        <p>Total Actifs</p>
                    </div>
                </div>

                <!-- Send Campaign -->
                <div class="col-md-8 mb-4">
                    <div class="admin-card text-white">
                        <h4 class="mb-4"><i class="fas fa-paper-plane me-2"></i> Nouvelle Campagne</h4>
                        <form id="campaignForm">
                            <div class="mb-3">
                                <label class="form-label">Sujet de l'email</label>
                                <input type="text" class="form-control" id="emailSubject" required placeholder="Ex: Découvrez nos nouvelles offres !">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contenu (HTML autorisé)</label>
                                <textarea class="form-control" id="emailContent" rows="6" required placeholder="Bonjour, ..."></textarea>
                                <small class="text-white-50">Vous pouvez utiliser des balises HTML simples pour la mise en forme.</small>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" style="background-color: #F59E0B; border:none; padding: 10px 30px;">
                                    <i class="fas fa-paper-plane me-2"></i> Envoyer à tous les abonnés
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Subscribers -->
                <div class="col-md-6 mb-4">
                    <div class="admin-card">
                        <h4 class="text-white mb-4">Derniers Abonnés</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Date d'inscription</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody id="subscribersList">
                                    <tr><td colspan="3" class="text-center">Chargement...</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Campaigns -->
                <div class="col-md-6 mb-4">
                    <div class="admin-card">
                        <h4 class="text-white mb-4">Historique des Campagnes</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Sujet</th>
                                        <th>Date d'envoi</th>
                                        <th>Destinataires</th>
                                    </tr>
                                </thead>
                                <tbody id="campaignsList">
                                    <tr><td colspan="3" class="text-center">Chargement...</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
            
            loadData();

            $('#campaignForm').on('submit', function(e) {
                e.preventDefault();
                let subject = $('#emailSubject').val();
                let content = $('#emailContent').val();

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cet email sera envoyé à tous les abonnés actifs.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#F59E0B',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, envoyer !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendCampaign(subject, content);
                    }
                })
            });
        });

        function loadData() {
            fetch('api/get_newsletter_data.php')
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        $('#subscriberCount').text(data.total_subscribers);
                        
                        // Render Subscribers
                        let subHtml = '';
                        if(data.subscribers.length > 0) {
                            data.subscribers.forEach(sub => {
                                subHtml += `
                                <tr>
                                    <td>${sub.email}</td>
                                    <td>${new Date(sub.created_at).toLocaleDateString('fr-FR')}</td>
                                    <td><span class="badge bg-success">${sub.status}</span></td>
                                </tr>`;
                            });
                        } else {
                            subHtml = '<tr><td colspan="3" class="text-center text-white-50">Aucun abonné pour le moment.</td></tr>';
                        }
                        $('#subscribersList').html(subHtml);

                        // Render Campaigns
                        let campHtml = '';
                        if(data.campaigns.length > 0) {
                            data.campaigns.forEach(camp => {
                                campHtml += `
                                <tr>
                                    <td>${camp.subject}</td>
                                    <td>${new Date(camp.sent_at).toLocaleDateString('fr-FR')}</td>
                                    <td>${camp.recipient_count}</td>
                                </tr>`;
                            });
                        } else {
                            campHtml = '<tr><td colspan="3" class="text-center text-white-50">Aucune campagne envoyée.</td></tr>';
                        }
                        $('#campaignsList').html(campHtml);
                    }
                });
        }

        function sendCampaign(subject, content) {
            Swal.fire({
                title: 'Envoi en cours...',
                didOpen: () => { Swal.showLoading() }
            });

            fetch('api/send_campaign.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ subject: subject, content: content })
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    Swal.fire('Envoyé !', res.message, 'success');
                    $('#campaignForm')[0].reset();
                    loadData(); // Refresh history
                } else {
                    Swal.fire('Erreur', res.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Erreur', 'Erreur de connexion serveur.', 'error');
            });
        }
    </script>
</body>
</html>
