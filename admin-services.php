<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';

$pageTitle = "Gestion des Services | Admin";
$current_page = "services";

$services = [];
try {
    $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
    $services = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Error fetching services: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?></title>
     <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    
    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/notech-responsive.css" />
    <link rel="stylesheet" href="assets/css/notech-dark.css" />
    <link rel="stylesheet" href="assets/css/admin-nexlink.css" />
    <link rel="stylesheet" href="assets/vendors/notech-icons/style.css"> <!-- For service icons -->

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
        }
        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php include 'includes/admin_sidebar.php'; ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="dashboard-container">
            <?php include 'includes/admin_header.php'; ?>

            <div class="nex-card">
                <div class="table-header-nex d-flex justify-content-between align-items-center">
                    <h4 class="card-title-nex mb-0">Gestion des Services</h4>
                    <button class="btn btn-primary btn-sm" onclick="openAddModal()">
                        <i class="fas fa-plus me-2"></i>Ajouter un service
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>SERVICE</th>
                                <th>DESCRIPTION</th>
                                <th>ICÔNE</th>
                                <th class="text-end">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $s): ?>
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6; display: flex; align-items: center; justify-content: center;">
                                            <i class="<?php echo $s['icon']; ?>"></i>
                                        </div>
                                        <span style="font-weight: 600;"><?php echo htmlspecialchars($s['title']); ?></span>
                                    </div>
                                </td>
                                <td><div style="max-width:300px; font-size: 13px; opacity: 0.8;"><?php echo htmlspecialchars($s['description']); ?></div></td>
                                <td style="font-family: monospace; color: var(--admin-text-muted);"><?php echo htmlspecialchars($s['icon']); ?></td>
                                <td class="text-end">
                                    <button class="icon-btn text-primary" onclick='editService(<?php echo htmlspecialchars(json_encode($s), ENT_QUOTES, 'UTF-8'); ?>)' title="Modifier"><i class="fas fa-edit"></i></button>
                                    <button class="icon-btn text-danger" onclick='deleteService(<?php echo $s["id"]; ?>)' title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($services)): ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">Aucun service trouvé.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: white; color: #333;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Mes Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="serviceForm">
                        <input type="hidden" id="serviceId">
                        <input type="hidden" id="serviceAction" value="create">
                        
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" id="serviceTitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="serviceDesc" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Classe Icône (ex: icon-coding)</label>
                            <input type="text" class="form-control" id="serviceIcon">
                            <small class="text-muted d-block mt-1">Utilisez les classes 'icon-...' du thème.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lien (optionnel)</label>
                            <input type="text" class="form-control" id="serviceLink">
                            <small class="text-muted">Laisser vide pour générer automatiquement (ex: mon-service.php)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image URL (Grande image)</label>
                            <input type="text" class="form-control" id="serviceImage">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contenu Complet (HTML)</label>
                            <textarea class="form-control" id="serviceContent" rows="10" placeholder="<h3>Titre de section</h3><p>Votre texte ici...</p>"></textarea>
                            <small class="text-muted">Vous pouvez utiliser du HTML pour formater la page de détail.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="saveService()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));

        // Auto-generate link from title
        document.getElementById('serviceTitle').addEventListener('input', function() {
            const title = this.value;
            const action = document.getElementById('serviceAction').value;
            // Only auto-fill if creating new or if link is empty
            if (action === 'create' || document.getElementById('serviceLink').value === '') {
                const slug = title.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, "") // Remove accents
                    .trim()
                    .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/-+/g, '-'); // Remove duplicate dashes
                
                if (slug) {
                    document.getElementById('serviceLink').value = slug + '.php';
                } else {
                    document.getElementById('serviceLink').value = '';
                }
            }
        });

        function openAddModal() {
            document.getElementById('serviceForm').reset();
            document.getElementById('serviceId').value = '';
            document.getElementById('serviceAction').value = 'create';
            document.getElementById('modalTitle').innerText = 'Ajouter un Service';
            serviceModal.show();
        }

        function editService(service) {
            document.getElementById('serviceId').value = service.id;
            document.getElementById('serviceTitle').value = service.title;
            document.getElementById('serviceDesc').value = service.description;
            document.getElementById('serviceIcon').value = service.icon;
            document.getElementById('serviceLink').value = service.link;
            document.getElementById('serviceImage').value = service.image_url || '';
            document.getElementById('serviceContent').value = service.full_content || '';
            
            document.getElementById('serviceAction').value = 'update';
            document.getElementById('modalTitle').innerText = 'Modifier le Service';
            serviceModal.show();
        }

        function saveService() {
            const action = document.getElementById('serviceAction').value;
            const data = {
                action: action,
                id: document.getElementById('serviceId').value,
                title: document.getElementById('serviceTitle').value,
                description: document.getElementById('serviceDesc').value,
                icon: document.getElementById('serviceIcon').value,
                link: document.getElementById('serviceLink').value,
                image_url: document.getElementById('serviceImage').value,
                full_content: document.getElementById('serviceContent').value
            };

            fetch('api/save_service.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Service enregistré avec succès',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else {
                    Swal.fire('Erreur', data.error, 'error');
                }
            })
            .catch(err => Swal.fire('Erreur', 'Erreur de connexion', 'error'));
        }

        function deleteService(id) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('api/save_service.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'delete', id: id })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire(
                                'Supprimé !',
                                'Le service a été supprimé.',
                                'success'
                            ).then(() => location.reload());
                        } else {
                            Swal.fire('Erreur', data.error, 'error');
                        }
                    });
                }
            });
        }

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
