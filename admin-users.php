<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';

$pageTitle = "Gestion des Utilisateurs | Admin";
$current_page = "users";

$users = [];
try {
    $stmt = $pdo->query("SELECT id, username, role, created_at, permissions FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error fetching users: " . $e->getMessage());
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
        
        /* Fix for Modal Visibility */
        .form-check-label {
            color: #333 !important; /* Force dark text for visibility */
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'users';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="dashboard-container">
            <?php include 'includes/admin_header.php'; ?>

            <!-- Stats Overview -->
            <div class="stats-grid-nex">
                <div class="nex-card stat-card-nex">
                    <div class="stat-icon blue" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Utilisateurs Total</h3>
                        <div class="value"><?php echo count($users); ?></div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="nex-card">
                <div class="table-header-nex">
                    <h4 class="card-title-nex">Administrateurs</h4>
                    <button class="btn btn-primary" onclick="openAddModal()" style="background: var(--brand-primary); border: none; padding: 8px 16px; border-radius: 8px;">
                        <i class="fas fa-plus me-2"></i>Ajouter
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>UTILISATEUR</th>
                                <th>RÔLE</th>
                                <th>CRÉÉ LE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: #3B82F6; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; width: 40px; height: 40px; border-radius: 50%;">
                                            <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;"><?php echo htmlspecialchars($user['username']); ?></div>
                                            <?php if($user['id'] == $_SESSION['admin_user_id']): ?>
                                                <span class="badge bg-success" style="font-size: 10px;">Vous</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;"><?php echo htmlspecialchars($user['role']); ?></span>
                                </td>
                                <td><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <button class="icon-btn" title="Modifier" style="width: 32px; height: 32px;" onclick="openEditModal(<?php echo $user['id']; ?>, '<?php echo htmlspecialchars($user['username']); ?>', '<?php echo htmlspecialchars($user['role']); ?>', <?php echo htmlspecialchars($user['permissions'] ?: '[]'); ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if($user['id'] != $_SESSION['admin_user_id']): ?>
                                        <button class="icon-btn delete" title="Supprimer" style="width: 32px; height: 32px; color: #EF4444; border-color: rgba(239,68,68,0.3);" onclick="deleteUser(<?php echo $user['id']; ?>, this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal" tabindex="-1" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; overflow-y: auto;">
        <div class="modal-dialog" style="margin: 50px auto; max-width: 500px; background: white; border-radius: 12px; padding: 25px; position: relative; pointer-events: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 class="modal-title" style="font-size: 1.5rem; font-weight: 700; color: #333;">Nouvel Administrateur</h5>
                <button type="button" class="btn-close" onclick="closeAddModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333;">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" style="color: #333;">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="newUsername" required style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Mot de passe</label>
                        <div class="input-group mb-3" style="display: flex;">
                            <input type="password" class="form-control" id="newPassword" required style="width: auto; flex: 1; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px 0 0 6px; border-right: none;">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('newPassword', this)" style="border: 1px solid #e5e7eb; border-radius: 0 6px 6px 0; background: #f9fafb; padding: 0 15px;">
                                <i class="fas fa-eye text-muted"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Rôle</label>
                        <select id="newRole" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px;">
                            <option value="admin">Super Admin (Accès Total)</option>
                            <option value="editor">Éditeur (Accès Limité)</option>
                        </select>
                    </div>

                    <div class="mb-3" id="newPermissionsContainer" style="display: none;">
                        <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Permissions</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="dashboard" id="new_perm_dashboard">
                                <label class="form-check-label" for="new_perm_dashboard">Dashboard</label>
                            </div>
                            <!-- ... (Using a simplified JS helper to build this might be cleaner but duplicating checks is safer for quick edit) -->
                            <!-- Replicating Full List for 'Add' -->
                           <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="messages" id="new_perm_messages">
                                <label class="form-check-label" for="new_perm_messages">Messages</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="home" id="new_perm_home">
                                <label class="form-check-label" for="new_perm_home">Accueil</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="blog" id="new_perm_blog">
                                <label class="form-check-label" for="new_perm_blog">Blog</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="projects" id="new_perm_projects">
                                <label class="form-check-label" for="new_perm_projects">Projets</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="services" id="new_perm_services">
                                <label class="form-check-label" for="new_perm_services">Services</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="team" id="new_perm_team">
                                <label class="form-check-label" for="new_perm_team">Équipe</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="about" id="new_perm_about">
                                <label class="form-check-label" for="new_perm_about">À Propos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="users" id="new_perm_users">
                                <label class="form-check-label" for="new_perm_users">Utilisateurs</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="settings" id="new_perm_settings">
                                <label class="form-check-label" for="new_perm_settings">Paramètres</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-secondary" onclick="closeAddModal()" style="background: #f3f4f6; color: #333; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveUser()" style="background: #3B82F6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Créer</button>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal" tabindex="-1" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; overflow-y: auto;">
        <div class="modal-dialog" style="margin: 50px auto; max-width: 500px; background: white; border-radius: 12px; padding: 25px; position: relative; pointer-events: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 class="modal-title" style="font-size: 1.5rem; font-weight: 700; color: #333;">Modifier l'Utilisateur</h5>
                <button type="button" class="btn-close" onclick="closeEditModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333;">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editUserId">
                
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="editUsername" required style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Mot de passe (Optionnel)</label>
                    <div class="input-group mb-3" style="display: flex;">
                        <input type="password" class="form-control" id="editPassword" placeholder="Laisser vide pour ne pas changer" style="width: auto; flex: 1; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px 0 0 6px; border-right: none;">
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('editPassword', this)" style="border: 1px solid #e5e7eb; border-radius: 0 6px 6px 0; background: #f9fafb; padding: 0 15px;">
                            <i class="fas fa-eye text-muted"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Rôle</label>
                    <select id="editRole" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px;">
                        <option value="admin">Super Admin (Accès Total)</option>
                        <option value="editor">Éditeur (Accès Limité)</option>
                    </select>
                </div>
                
                <div class="mb-3" id="editPermissionsContainer" style="display: none;">
                    <label class="form-label" style="font-weight: 500; margin-bottom: 8px; display: block;">Permissions</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="dashboard" id="perm_dashboard">
                            <label class="form-check-label" for="perm_dashboard">Dashboard</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="messages" id="perm_messages">
                            <label class="form-check-label" for="perm_messages">Messages</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="home" id="perm_home">
                            <label class="form-check-label" for="perm_home">Accueil</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="blog" id="perm_blog">
                            <label class="form-check-label" for="perm_blog">Blog</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="projects" id="perm_projects">
                            <label class="form-check-label" for="perm_projects">Projets</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="services" id="perm_services">
                            <label class="form-check-label" for="perm_services">Services</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="team" id="perm_team">
                            <label class="form-check-label" for="perm_team">Équipe</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="about" id="perm_about">
                            <label class="form-check-label" for="perm_about">À Propos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="users" id="perm_users">
                            <label class="form-check-label" for="perm_users">Utilisateurs</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="settings" id="perm_settings">
                            <label class="form-check-label" for="perm_settings">Paramètres</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()" style="background: #f3f4f6; color: #333; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="updateUser()" style="background: #3B82F6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Enregistrer</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Password Toggle Logic
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Role Change Listeners
        document.getElementById('newRole').addEventListener('change', function() {
            document.getElementById('newPermissionsContainer').style.display = this.value === 'editor' ? 'block' : 'none';
        });
        document.getElementById('editRole').addEventListener('change', function() {
            document.getElementById('editPermissionsContainer').style.display = this.value === 'editor' ? 'block' : 'none';
        });

        // Helper to get checked permissions
        function getPermissions(prefix) {
            const perms = [];
            const checkboxes = document.querySelectorAll(`input[id^="${prefix}_perm_"]:checked`);
            checkboxes.forEach(cb => perms.push(cb.value));
            return perms;
        }

        // Helper to set checkboxes
        function setPermissions(prefix, permissionsArray) {
            // Uncheck all first
            document.querySelectorAll(`input[id^="${prefix}_perm_"]`).forEach(cb => cb.checked = false);
            // Check based on array
            if(Array.isArray(permissionsArray)) {
                permissionsArray.forEach(perm => {
                     const cb = document.getElementById(`${prefix}_perm_${perm}`);
                     if(cb) cb.checked = true;
                });
            }
        }

        // Modal Logic
        function openAddModal() {
            document.getElementById('addUserForm').reset();
            // Reset permissions view based on default role (admin)
            document.getElementById('newPermissionsContainer').style.display = 'none'; 
            document.getElementById('addUserModal').style.display = 'block';
        }

        function closeAddModal() {
            document.getElementById('addUserModal').style.display = 'none';
        }
        
        function openEditModal(id, username, role, permissionsJSON) {
            document.getElementById('editUserId').value = id;
            document.getElementById('editUsername').value = username;
            document.getElementById('editRole').value = role;
            document.getElementById('editPassword').value = '';
            
            // Handle Permissions Visibility
            const permContainer = document.getElementById('editPermissionsContainer');
            if (role === 'editor') {
                permContainer.style.display = 'block';
                let perms = [];
                try {
                     if (typeof permissionsJSON === 'string') {
                         perms = JSON.parse(permissionsJSON);
                     } else if(Array.isArray(permissionsJSON)) {
                         perms = permissionsJSON;
                     }
                } catch(e) { console.error('Error parsing perms', e); }
                setPermissions('perm', perms);
            } else {
                permContainer.style.display = 'none';
            }

            document.getElementById('editUserModal').style.display = 'block';
        }
        function closeEditModal() {
            document.getElementById('editUserModal').style.display = 'none';
        }

        function saveUser() {
            const username = document.getElementById('newUsername').value;
            const password = document.getElementById('newPassword').value;
            const role = document.getElementById('newRole').value;
            const permissions = role === 'editor' ? getPermissions('new') : [];

            if(!username || !password) {
                Swal.fire('Erreur', 'Tous les champs sont requis', 'error');
                return;
            }

            Swal.fire({
                title: 'Créer cet utilisateur ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, créer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('api/save_user.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'create', username, password, role, permissions })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Succès', 'Utilisateur créé avec succès', 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Erreur', data.error, 'error');
                        }
                    })
                    .catch(err => Swal.fire('Erreur', 'Erreur réseau: ' + err, 'error'));
                }
            });
        }

        function updateUser() {
            const id = document.getElementById('editUserId').value;
            const username = document.getElementById('editUsername').value;
            const role = document.getElementById('editRole').value;
            const password = document.getElementById('editPassword').value;
            const permissions = role === 'editor' ? getPermissions('perm') : [];

            if(!username) {
                Swal.fire('Erreur', 'Nom d\'utilisateur requis', 'error');
                return;
            }

            Swal.fire({
                title: 'Confirmer les modifications ?',
                text: password ? "Le mot de passe sera également mis à jour." : "Seuls les détails seront mis à jour.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, enregistrer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('api/save_user.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'update_user', id, username, password, role, permissions }) 
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Succès', 'Utilisateur modifié avec succès', 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Erreur', data.error, 'error');
                        }
                    })
                    .catch(err => Swal.fire('Erreur', 'Erreur réseau: ' + err, 'error'));
                }
            });
        }

        function deleteUser(id, btn) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Supprimer cet administrateur ? Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ... same delete logic ...
                    fetch('api/save_user.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ action: 'delete', id })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Supprimé !', 'L\'utilisateur a été supprimé.', 'success');
                            btn.closest('tr').remove();
                        } else {
                            Swal.fire('Erreur', data.error, 'error');
                        }
                    })
                    .catch(err => Swal.fire('Erreur', 'Erreur réseau: ' + err, 'error'));
                }
            });
        }

        // Sidebar Toggle match
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
