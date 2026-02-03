<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';

$pageTitle = "Gestion des Projets | Admin";
$current_page = "projects";

$unread_count = 0;
$projects = [];

try {
    // Unread Count
    $stmt = $pdo->query("SELECT COUNT(*) FROM messages WHERE is_read = 0");
    $unread_count = $stmt->fetchColumn();
    
    // Load Projects
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des Projets | Administration ETAAM</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Gestion des Projets ETAAM" />

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
        /* Reusing Admin Styles */
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
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-top: 5px;
            font-family: inherit;
        }
        .mb-3 { margin-bottom: 1rem; }

        /* Summernote Fix for visibility */
        .note-editor .note-editable {
            background-color: #fff !important;
        }
        .note-editor .note-editable, 
        .note-editor .note-editable p,
        .note-editor .note-editable div,
        .note-editor .note-editable span,
        .note-editor .note-editable ul,
        .note-editor .note-editable li {
            color: #333 !important;
        }
        .note-placeholder {
            color: #999 !important;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'projects';
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
                    <div class="stat-icon purple" style="background: rgba(139, 92, 246, 0.1); color: #8B5CF6;">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Projets Total</h3>
                        <div class="value"><?php echo count($projects); ?></div>
                    </div>
                </div>
            </div>

            <!-- Projects Table -->
            <div class="nex-card">
                <div class="table-header-nex">
                    <h4 class="card-title-nex">Liste des Projets</h4>
                    <div>
                         <button class="btn btn-primary" onclick="openModal()" style="background: var(--brand-primary); border: none; padding: 8px 16px; border-radius: 8px;"><i class="fas fa-plus"></i> Nouveau Projet</button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>PROJET</th>
                                <th>CLIENT</th>
                                <th>CATÉGORIE</th>
                                <th>LIEU</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($projects)): ?>
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 30px; color: rgba(255,255,255,0.5);">Aucun projet trouvé.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-sm" style="width: 40px; height: 40px; border-radius: 4px; background-image: url('<?php echo htmlspecialchars($project['image'] ?? 'assets/images/project/etaam-project-1.png'); ?>'); background-size: cover; background-position: center;"></div>
                                            <div>
                                                <div style="font-weight: 600;"><?php echo htmlspecialchars($project['title']); ?></div>
                                                <div style="color: var(--admin-text-muted); font-size: 0.8em;"><?php echo htmlspecialchars($project['id']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($project['client']); ?></td>
                                    <td><span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6;"><?php echo htmlspecialchars($project['category']); ?></span></td>
                                    <td><?php echo htmlspecialchars($project['location']); ?></td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            <button class="icon-btn" style="width: 32px; height: 32px; font-size: 14px;" onclick="editProject('<?php echo $project['id']; ?>')" title="Modifier"><i class="fas fa-edit"></i></button>
                                            <button class="icon-btn delete" style="width: 32px; height: 32px; font-size: 14px; color: #EF4444; border-color: rgba(239,68,68,0.3);" onclick="deleteProject('<?php echo $project['id']; ?>', this)" title="Supprimer"><i class="fas fa-trash"></i></button>
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
    <div id="projectModal" class="modal" tabindex="-1" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; overflow-y: auto;">
        <div class="modal-dialog" style="margin: 50px auto; max-width: 800px; background: white; border-radius: 12px; padding: 25px; position: relative; pointer-events: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 class="modal-title" id="modalTitle" style="font-size: 1.5rem; font-weight: 700; color: #333;">Nouveau Projet</h5>
                <button type="button" class="btn-close" onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333;">&times;</button>
            </div>
            <div class="modal-body">
                <form id="projectForm" style="color: #333;">
                    <input type="hidden" id="originalId" name="originalId">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">ID (Unique)</label>
                            <input type="text" class="form-control" id="id" name="id" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Client</label>
                            <input type="text" class="form-control" id="client" name="client">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Catégorie</label>
                            <input type="text" class="form-control" id="category" name="category" list="catList">
                            <datalist id="catList">
                                <option value="Infrastructure Cloud">
                                <option value="Développement Mobile">
                                <option value="Cybersécurité">
                                <option value="Formation">
                            </datalist>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Lieu</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Durée</label>
                            <input type="text" class="form-control" id="duration" name="duration">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image Principale (URL)</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="image" name="image" placeholder="assets/images/project/...">
                            <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="uploadImage(this)">
                            <button type="button" class="btn" style="border: 1px solid #ddd;" onclick="triggerUpload()" title="Uploader une image"><i class="fas fa-upload"></i></button>
                        </div>
                        <img id="imagePreview" src="" alt="Preview" style="display:none; max-height: 100px; margin-top: 10px; border-radius: 6px; border: 1px solid #eee;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Titre de la Description (Optionnel)</label>
                        <input type="text" class="form-control" id="description_title" name="description_title" placeholder="Par défaut: Titre du projet">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (HTML autorisé)</label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Challenge</label>
                        <textarea class="form-control" id="challenge" name="challenge" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image Processus (Optionnel)</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="process_image" name="process_image" placeholder="assets/images/project/...">
                            <input type="file" id="processFileInput" style="display: none;" accept="image/*" onchange="uploadProcessImage(this)">
                            <button type="button" class="btn" style="border: 1px solid #ddd;" onclick="triggerProcessUpload()" title="Uploader"><i class="fas fa-upload"></i></button>
                        </div>
                        <img id="processImagePreview" src="" alt="Preview" style="display:none; max-height: 100px; margin-top: 10px; border-radius: 6px; border: 1px solid #eee;">
                    </div>

                    <!-- Dynamic Lists Section -->
                    <hr>
                    <h5 class="mb-3">Contenu Détaillé</h5>

                    <!-- Livrables -->
                    <div class="mb-3 border p-3 rounded bg-light">
                        <label class="form-label fw-bold">Livrables (Ce que nous avons livré)</label>
                        <div id="deliverablesContainer"></div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDeliverable()"><i class="fas fa-plus"></i> Ajouter un livrable</button>
                    </div>

                    <!-- Résultats -->
                    <div class="mb-3 border p-3 rounded bg-light">
                        <label class="form-label fw-bold">Résultats (Chiffres)</label>
                        <div id="resultsContainer"></div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addResultItem()"><i class="fas fa-plus"></i> Ajouter un résultat</button>
                    </div>

                    <!-- Impact -->
                    <div class="mb-3 border p-3 rounded bg-light">
                        <label class="form-label fw-bold">Impact (Liste à puces)</label>
                        <div id="impactContainer"></div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addImpactItem()"><i class="fas fa-plus"></i> Ajouter un impact</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-secondary" onclick="closeModal()" style="background: #f3f4f6; color: #333; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveProject()" style="background: #3B82F6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Enregistrer</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Summernote Lite -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Inject projects data safely into JS
        const projectsData = <?php echo json_encode($projects); ?>;
        
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Description du projet...',
                tabsize: 2,
                height: 200,
                toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link']],
                  ['view', ['codeview', 'help']]
                ]
            });
        });
        
        // Helper to find project by ID
        function getProjectById(id) {
            return projectsData.find(p => p.id === id);
        }

        function openModal() {
            document.getElementById('projectForm').reset();
            $('#description').summernote('reset'); 
            document.getElementById('originalId').value = '';
            document.getElementById('modalTitle').innerText = 'Nouveau Projet';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('processImagePreview').style.display = 'none';
            
            // Clear Dynamic Lists
            document.getElementById('deliverablesContainer').innerHTML = '';
            document.getElementById('resultsContainer').innerHTML = '';
            document.getElementById('impactContainer').innerHTML = '';
            
            document.getElementById('projectModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('projectModal').style.display = 'none';
        }

        function editProject(id) {
            const project = getProjectById(id);
            if (!project) {
                Swal.fire('Erreur', 'Projet introuvable', 'error');
                return;
            }

            document.getElementById('modalTitle').innerText = 'Modifier le Projet';
            document.getElementById('originalId').value = project.id || '';
            document.getElementById('id').value = project.id || '';
            document.getElementById('title').value = project.title || '';
            document.getElementById('description_title').value = project.description_title || '';
            document.getElementById('client').value = project.client || '';
            document.getElementById('category').value = project.category || '';
            document.getElementById('location').value = project.location || '';
            document.getElementById('duration').value = project.duration || '';
            document.getElementById('image').value = project.image && project.image !== 'undefined' ? project.image : '';
            document.getElementById('process_image').value = project.process_image || '';
            document.getElementById('challenge').value = project.challenge || '';
            
            // Set Description
            $('#description').summernote('code', project.description || '');

            // Previews
            updateImagePreview('image', 'imagePreview');
            updateImagePreview('process_image', 'processImagePreview');

            // Dynamic Lists
            loadDynamicList('deliverablesContainer', project.deliverables, renderDeliverable);
            loadDynamicList('resultsContainer', project.results, renderResultItem);
            loadDynamicList('impactContainer', project.impact, renderImpactItem);

            document.getElementById('projectModal').style.display = 'block';
        }

        function updateImagePreview(inputId, imgId) {
            const val = document.getElementById(inputId).value;
            const img = document.getElementById(imgId);
            if(val) {
                img.src = val;
                img.style.display = 'block';
            } else {
                img.style.display = 'none';
            }
        }

        // --- Dynamic Lists Logic ---
        function loadDynamicList(containerId, dataStr, renderFunc) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            let data = [];
            try {
                // Determine if dataStr is JSON string or object
                if (typeof dataStr === 'string') {
                    data = JSON.parse(dataStr);
                } else if (Array.isArray(dataStr)) {
                     data = dataStr;
                }
            } catch(e) { data = []; }

            if (Array.isArray(data)) {
                data.forEach(item => {
                    container.appendChild(renderFunc(item));
                });
            }
        }

        // DELIVERABLES (Icon, Title, Text)
        function addDeliverable() {
            document.getElementById('deliverablesContainer').appendChild(renderDeliverable({}));
        }
        function renderDeliverable(item) {
            const div = document.createElement('div');
            div.className = 'input-group mb-2 gap-2';
            div.innerHTML = `
                <input type="text" class="form-control" placeholder="Icon Class (fas fa-check)" value="${item.icon || ''}" style="max-width: 150px;">
                <input type="text" class="form-control" placeholder="Titre" value="${item.title || ''}">
                <input type="text" class="form-control" placeholder="Texte" value="${item.text || ''}">
                <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">X</button>
            `;
            return div;
        }
        function getDeliverables() {
            const items = [];
            document.querySelectorAll('#deliverablesContainer .input-group').forEach(div => {
                const inputs = div.querySelectorAll('input');
                if(inputs[1].value) { // Require title
                    items.push({
                        icon: inputs[0].value,
                        title: inputs[1].value,
                        text: inputs[2].value
                    });
                }
            });
            return JSON.stringify(items);
        }

        // RESULTS (Value, Label)
        function addResultItem() {
            document.getElementById('resultsContainer').appendChild(renderResultItem({}));
        }
        function renderResultItem(item) {
            const div = document.createElement('div');
            div.className = 'input-group mb-2 gap-2';
            div.innerHTML = `
                <input type="text" class="form-control" placeholder="Valeur (ex: +40%)" value="${item.value || ''}">
                <input type="text" class="form-control" placeholder="Label (ex: Croissance)" value="${item.label || ''}">
                <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">X</button>
            `;
            return div;
        }
        function getResults() {
            const items = [];
            document.querySelectorAll('#resultsContainer .input-group').forEach(div => {
                const inputs = div.querySelectorAll('input');
                if(inputs[0].value) {
                    items.push({
                        value: inputs[0].value,
                        label: inputs[1].value
                    });
                }
            });
            return JSON.stringify(items);
        }

         // IMPACT (Text only)
        function addImpactItem() {
            document.getElementById('impactContainer').appendChild(renderImpactItem(''));
        }
        function renderImpactItem(text) {
            const div = document.createElement('div');
            div.className = 'input-group mb-2 gap-2';
            // Adjust for if 'text' is an object (legacy check) or string
            const val = (typeof text === 'object' && text !== null) ? (text.text || '') : text; 
            
            div.innerHTML = `
                <input type="text" class="form-control" placeholder="Impact..." value="${val}">
                <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">X</button>
            `;
            return div;
        }
        function getImpact() {
            const items = [];
            document.querySelectorAll('#impactContainer .input-group').forEach(div => {
                const val = div.querySelector('input').value;
                if(val) items.push(val);
            });
            return JSON.stringify(items);
        }

        // --- Uploaders ---
        function triggerUpload() { document.getElementById('fileInput').click(); }
        function triggerProcessUpload() { document.getElementById('processFileInput').click(); }

        function uploadImage(input) { handleUpload(input, 'image', 'imagePreview'); }
        function uploadProcessImage(input) { handleUpload(input, 'process_image', 'processImagePreview'); }

        function handleUpload(input, targetInputId, previewId) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('file', input.files[0]);

                fetch('api/upload_project_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        document.getElementById(targetInputId).value = data.url;
                        const img = document.getElementById(previewId);
                        img.src = data.url;
                        img.style.display = 'block';
                    } else {
                        Swal.fire('Erreur', 'Upload échoué: ' + data.error, 'error');
                    }
                })
                .catch(err => Swal.fire('Erreur', 'Problème réseau: ' + err, 'error'));
            }
        }

        function saveProject() {
            const form = document.getElementById('projectForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const isNew = document.getElementById('originalId').value === '';
            const actionText = isNew ? "Créer ce projet ?" : "Modifier ce projet ?";
            const confirmText = isNew ? "Oui, créer" : "Oui, modifier";

            Swal.fire({
                title: 'Confirmation',
                text: actionText,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmText,
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    performSave();
                }
            });
        }

        function performSave() {
            const formData = {
                originalId: document.getElementById('originalId').value,
                id: document.getElementById('id').value,
                title: document.getElementById('title').value,
                description_title: document.getElementById('description_title').value,
                client: document.getElementById('client').value,
                category: document.getElementById('category').value,
                location: document.getElementById('location').value,
                duration: document.getElementById('duration').value,
                image: document.getElementById('image').value,
                process_image: document.getElementById('process_image').value,
                description: $('#description').summernote('code'),
                challenge: document.getElementById('challenge').value,
                
                // Complex JSON fields
                deliverables: getDeliverables(),
                results: getResults(),
                impact: getImpact()
            };

            const btn = document.querySelector('#projectModal .btn-primary');
            const originalText = btn.innerText;
            btn.innerText = 'Sauvegarde...';
            btn.disabled = true;

            fetch('api/save_projects.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    Swal.fire('Succès', 'Projet enregistré avec succès !', 'success')
                    .then(() => location.reload());
                } else {
                    Swal.fire('Erreur', data.error || 'Une erreur est survenue', 'error');
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            })
            .catch(err => {
                Swal.fire('Erreur', 'Erreur réseau: ' + err, 'error');
                btn.innerText = originalText;
                btn.disabled = false;
            });
        }

        function deleteProject(id, btn) {
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
                    fetch('api/save_projects.php', { 
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'delete', id: id })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Supprimé !', 'Le projet a été supprimé.', 'success');
                            btn.closest('tr').remove();
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
