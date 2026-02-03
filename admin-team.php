<?php
include 'includes/auth_check.php';
$pageTitle = "Gestion Équipe | Administration ETAAM";
// Ensure data folder exists
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
        /* Custom Admin Styles matches admin-blog.php aesthetics */
        body { background-color: #f4f6f9; }
        .admin-container { padding: 150px 0 60px; } /* Increased top padding for fixed header */
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        /* Grid Layout */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Member Card Design */
        .team-member-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #eef2f6;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 30px 20px;
        }
        
        .team-member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            border-color: #3B82F6;
        }

        /* Avatar */
        .member-avatar-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            padding: 4px; /* Space for border */
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
            margin-bottom: 20px;
            position: relative;
        }
        
        .member-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            background-color: #f1f5f9;
        }

        /* Info */
        .member-name {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }
        
        .member-role {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        /* Actions Overlay */
        .member-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 20; /* Ensure buttons are clickable */
        }    
        
        .team-member-card:hover .member-actions {
            opacity: 1;
            transform: translateY(0);
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .btn-edit { background: #eff6ff; color: #3B82F6; }
        .btn-edit:hover { background: #3B82F6; color: white; }
        
        .btn-delete { background: #fef2f2; color: #EF4444; }
        .btn-delete:hover { background: #EF4444; color: white; }
        
        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px;
            background: #fff;
            border-radius: 16px;
            border: 2px dashed #e2e8f0;
            color: #94a3b8;
        }

        /* Modal Styles */
        .img-preview {
            max-width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: none;
        }
            
        /* Form Styles */
        label { font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 14px; }
        .form-control {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 15px;
            color: #1e293b;
        }
        .form-control:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: #fff;
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
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'team';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="container-fluid">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 style="font-weight: 800; color: #1e293b; margin-bottom: 5px;">Équipe & Talents</h2>
                    <p style="color: #64748b; margin: 0;">Gérez les membres qui composent votre organisation.</p>
                </div>
                <button class="thm-btn" onclick="openTeamModal()">
                    <i class="fas fa-plus me-2"></i> Ajouter un Membre
                </button>
            </div>

            <div id="teamGrid" class="team-grid">
                <!-- Team list loaded here -->
            </div>
        </div>
    </main>

    <!-- Team Modal -->
    <div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-hidden="true" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg" role="document" style="pointer-events: auto;">
            <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                <div class="modal-header" style="border-bottom: 1px solid #eef2f6; padding: 25px;">
                    <h5 class="modal-title" style="font-weight: 700;">Détails du Membre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#teamModal').modal('hide')" style="border:none; background:none; font-size: 24px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body" style="padding: 30px;">
                    <form id="teamForm">
                        <input type="hidden" id="teamMemberId">
                        
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs mb-4" id="teamTab" role="tablist" style="border-bottom: 2px solid #eef2f6;">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" style="font-weight:600; border:none; border-bottom: 2px solid transparent;">Général</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="skills-tab" data-toggle="tab" href="#skills" role="tab" style="font-weight:600; border:none; border-bottom: 2px solid transparent;">Compétences</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="parcours-tab" data-toggle="tab" href="#parcours" role="tab" style="font-weight:600; border:none; border-bottom: 2px solid transparent;">Parcours</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="teamTabContent">
                            <!-- TAB 1: GENERAL -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                <div class="row">
                                    <!-- Left Col: Image -->
                                    <div class="col-lg-4 mb-4 text-center">
                                        <div style="width: 150px; height: 150px; background: #f1f5f9; border-radius: 12px; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px dashed #cbd5e1; cursor: pointer;" onclick="$('#m_image_input').click()">
                                            <img id="m_image_preview" class="img-fluid" style="width:100%; height:100%; object-fit:cover; display:none;">
                                            <div id="upload_placeholder" style="color: #94a3b8;">
                                                <i class="fas fa-camera fa-2x mb-2"></i><br>
                                                <small>Changer photo</small>
                                            </div>
                                        </div>
                                        <input type="file" id="m_image_input" accept="image/*" style="display: none;" onchange="uploadTeamImage(this)">
                                        <input type="hidden" id="m_image">
                                    </div>

                                    <!-- Right Col: Info -->
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Nom complet</label>
                                                <input type="text" class="form-control" id="m_name" placeholder="Ex: Jean Dupont" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Poste / Rôle</label>
                                                <input type="text" class="form-control" id="m_role" placeholder="Ex: CEO, Développeur..." required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Bio Courte / Citation</label>
                                                <textarea class="form-control" id="m_quote" rows="2" placeholder="Une phrase d'accroche..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12"><hr class="my-4" style="border-top-color: #eef2f6;"></div>

                                    <div class="col-12">
                                        <h6 style="font-weight: 700; margin-bottom: 15px;">Biographie Détaillée</h6>
                                        <div class="mb-3">
                                            <label>Paragraphe 1</label>
                                            <textarea class="form-control" id="m_bio_1" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Paragraphe 2</label>
                                            <textarea class="form-control" id="m_bio_2" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12"><hr class="my-4" style="border-top-color: #eef2f6;"></div>

                                    <div class="col-12 mb-3">
                                        <h6 style="font-weight: 700; margin-bottom: 15px;">Réseaux Sociaux</h6>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label><i class="fab fa-linkedin text-primary"></i> LinkedIn</label>
                                                <input type="text" class="form-control" id="m_linkedin" placeholder="https://linkedin.com/in/...">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label><i class="fab fa-twitter text-info"></i> Twitter</label>
                                                <input type="text" class="form-control" id="m_twitter" placeholder="https://twitter.com/...">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label><i class="fab fa-facebook text-primary"></i> Facebook</label>
                                                <input type="text" class="form-control" id="m_facebook" placeholder="https://facebook.com/...">
                                            </div>
                                        </div>
                                    </div>
                            <div class="tab-pane fade" id="skills" role="tabpanel">
                                <h6 class="mb-3 font-weight-bold">Compétences Techniques</h6>
                                <div id="skills_container">
                                    <!-- Dynamic Skills Rows -->
                                </div>
                                <button type="button" class="btn btn-sm btn-light text-primary mt-2" onclick="addSkillRow()">
                                    <i class="fas fa-plus-circle"></i> Ajouter une compétence
                                </button>
                            </div>

                            <!-- TAB 3: PARCOURS -->
                            <div class="tab-pane fade" id="parcours" role="tabpanel">
                                <h6 class="mb-3 font-weight-bold">Formation (Éducation)</h6>
                                <div id="education_container" class="mb-4">
                                    <!-- Dynamic Education Rows -->
                                </div>
                                <button type="button" class="btn btn-sm btn-light text-primary mb-5" onclick="addEducationRow()">
                                    <i class="fas fa-plus-circle"></i> Ajouter Formation
                                </button>

                                <div style="border-top: 1px solid #eee; margin: 20px 0;"></div>

                                <h6 class="mb-3 font-weight-bold">Historique / Expérience</h6>
                                <div id="history_container">
                                    <!-- Dynamic History Rows -->
                                </div>
                                <button type="button" class="btn btn-sm btn-light text-primary mt-2" onclick="addHistoryRow()">
                                    <i class="fas fa-plus-circle"></i> Ajouter Historique
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #eef2f6; padding: 25px; background: #f8fafc; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                    <button type="button" class="btn btn-light text-muted font-weight-bold" data-dismiss="modal" onclick="$('#teamModal').modal('hide')">Annuler</button>
                    <button type="button" class="thm-btn" onclick="saveTeamMember()">Enregistrer le profil</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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
            
            // Explicit Tab Click Handling (Fix for stuck tabs)
            $('#teamTab a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
            
            // Initial Load
            loadTeamData();

            // --- DELEGATED EVENT LISTENERS (More Robust) ---
            
            // Delete Member
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Stop bubbling
                let id = $(this).data('id');
                deleteMember(id);
            });

            // Edit Member
            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                let id = $(this).data('id');
                editMember(id);
            });
            
            // Modal Save
            $('#saveMemberBtn').off('click').click(function() {
                saveTeamMember();
            });
        });

        // Global Data Storage
        let teamData = [];
        let listTimestamp = new Date().getTime();

        // --- TEAM LOGIC ---
        function loadTeamData() {
            // Using $.ajax for better compatibility/visual debugging
            $.ajax({
                url: 'api/team_api.php?t=' + listTimestamp,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.error) {
                        console.error("API Error:", data.error);
                        Swal.fire('Erreur API', data.error, 'error');
                        return;
                    }
                    console.log("Team Data Loaded:", data);
                    
                    // Convert Array to Object Map for compatibility with ID lookups
                    if (Array.isArray(data)) {
                        let map = {};
                        data.forEach(m => {
                            map[m.id] = m;
                        });
                        teamData = map;
                    } else {
                        teamData = data;
                    }
                    
                    renderTeamList();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.log('Response Text:', xhr.responseText);
                    
                    // Try to show meaningful error to user
                    let msg = 'Impossible de charger les données.';
                    if (xhr.status === 200 && xhr.responseText) {
                         // Likely JSON parse error
                         msg += ' Format de réponse invalide. Voir console.';
                    } else {
                         msg += ' (' + error + ')';
                    }
                    Swal.fire('Erreur Système', msg, 'error');
                }
            });
        }

        function renderTeamList() {
            let html = '';
            
            // Handle both Array and Object responses
            let entries = Object.entries(teamData);
            let count = entries.length;
            
            console.log("Rendering " + count + " members.");

            if (count === 0) {
                html = `
                <div class="empty-state">
                    <div style="font-size: 48px; margin-bottom: 20px;">👥</div>
                    <h3>Aucun membre dans l'équipe</h3>
                    <p>Commencez par ajouter votre premier collaborateur.</p>
                </div>`;
            } else {
                for (let [id, member] of entries) {
                    // Safe handling of missing image
                    let img = member.image || 'assets/images/resources/user.png';
                    
                    // Ensure social exists for safety
                    member.social = member.social || {};
                    
                    // Use database ID if available, otherwise array index key
                    let dataId = member.id || id; 

                    html += `
                    <div class="team-member-card">
                        <div class="member-actions">
                            <button class="action-btn btn-edit" data-id="${dataId}" title="Éditer">
                                <i class="fas fa-pen" style="pointer-events: none;"></i>
                            </button>
                            <button class="action-btn btn-delete" data-id="${dataId}" title="Supprimer">
                                <i class="fas fa-trash-alt" style="pointer-events: none;"></i>
                            </button>
                        </div>
                        
                        <div class="member-avatar-container">
                            <img src="${img}" alt="${member.name}" class="member-avatar" onerror="this.src='assets/images/resources/user.png'">
                        </div>
                        
                        <h3 class="member-name">${member.name}</h3>
                        <span class="member-role">${member.role}</span>
                        
                        <div style="width: 100%; border-top: 1px solid #f1f5f9; margin: 15px 0;"></div>
                        
                        <p style="font-size: 13px; color: #94a3b8; font-style: italic; margin-bottom: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            "${member.quote || 'Aucune citation'}"
                        </p>
                    </div>`;
                }
            }
            $('#teamGrid').html(html);
        }

        function openTeamModal(id = null) {
            // Reset Form and Preview
            $('#teamForm')[0].reset();
            $('#m_image_preview').hide();
            $('#upload_placeholder').show();
            $('#m_image').val('');
            $('#m_linkedin').val('');
            $('#m_twitter').val('');
            $('#m_facebook').val('');
            
            // Clear Dynamic Fields
            $('#skills_container').empty();
            $('#education_container').empty();
            $('#history_container').empty();
            
            // Reset Tabs
            $('#general-tab').tab('show');

            if (id && teamData[id]) {
                // Edit Mode
                let m = teamData[id];
                $('#teamMemberId').val(id);
                $('#m_name').val(m.name);
                $('#m_role').val(m.role);
                $('#m_quote').val(m.quote);
                $('#m_bio_1').val(m.bio_1);
                $('#m_bio_2').val(m.bio_2);
                
                // Socials
                if(m.social) {
                    $('#m_linkedin').val(m.social.linkedin || '');
                    $('#m_twitter').val(m.social.twitter || '');
                    $('#m_facebook').val(m.social.facebook || '');
                }

                if(m.image) {
                    $('#m_image').val(m.image);
                    $('#m_image_preview').attr('src', m.image).show();
                    $('#upload_placeholder').hide();
                }

                // Populate Skills
                if (m.skills && Array.isArray(m.skills)) {
                    m.skills.forEach(s => addSkillRow(s.name, s.percent));
                }

                // Populate Education
                if (m.education && Array.isArray(m.education)) {
                    m.education.forEach(e => addEducationRow(e.school, e.years, e.degree));
                }

                // Populate History
                if (m.history && Array.isArray(m.history)) {
                    m.history.forEach(h => addHistoryRow(h.year, h.text));
                }

            } else {
                // Create Mode - Add one empty row for each as starting point? No, let them add.
                $('#teamMemberId').val(''); 
            }

            $('#teamModal').modal('show');
        }

        // --- DYNAMIC ROWS HELPERS ---

        function addSkillRow(name = '', percent = '') {
            let html = `
            <div class="row align-items-center mb-2 skill-row">
                <div class="col-7">
                    <input type="text" class="form-control form-control-sm skill-name" placeholder="Nom (Ex: Architecture)" value="${name}">
                </div>
                <div class="col-3">
                    <input type="text" class="form-control form-control-sm skill-percent" placeholder="%" value="${percent}">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="$(this).closest('.skill-row').remove()">&times;</button>
                </div>
            </div>`;
            $('#skills_container').append(html);
        }

        function addEducationRow(school = '', years = '', degree = '') {
            let html = `
            <div class="card p-3 mb-3 education-row" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="text-muted m-0" style="font-size:12px;">Formation</h6>
                    <button type="button" class="btn btn-sm text-danger p-0" onclick="$(this).closest('.education-row').remove()"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control form-control-sm edu-school" placeholder="École / Université" value="${school}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control form-control-sm edu-years" placeholder="Années (ex: 2010-2014)" value="${years}">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control form-control-sm edu-degree" placeholder="Diplôme / Titre" value="${degree}">
                    </div>
                </div>
            </div>`;
            $('#education_container').append(html);
        }

        function addHistoryRow(year = '', text = '') {
            let html = `
            <div class="row align-items-center mb-2 history-row">
                <div class="col-3">
                    <input type="text" class="form-control form-control-sm hist-year" placeholder="Année" value="${year}">
                </div>
                <div class="col-7">
                    <input type="text" class="form-control form-control-sm hist-text" placeholder="Description courte (Ex: Lead Tech...)" value="${text}">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="$(this).closest('.history-row').remove()">&times;</button>
                </div>
            </div>`;
            $('#history_container').append(html);
        }


        function uploadTeamImage(input) {
            if (input.files && input.files[0]) {
                let fd = new FormData();
                fd.append('file', input.files[0]);
                
                fetch('api/upload_team_image.php', { method: 'POST', body: fd })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        $('#m_image').val(data.url);
                        $('#m_image_preview').attr('src', data.url).show();
                        $('#upload_placeholder').hide();
                    } else {
                        Swal.fire('Erreur', data.error, 'error');
                    }
                })
                .catch(err => console.error('Upload Error:', err));
            }
        }

        function saveTeamMember() {
            let id = $('#teamMemberId').val();
            let name = $('#m_name').val();
            
            if (!name) {
                Swal.fire('Erreur', 'Le nom est obligatoire', 'error');
                return;
            }

            // Collection Skills
            let skills = [];
            $('.skill-row').each(function() {
                let n = $(this).find('.skill-name').val();
                let p = $(this).find('.skill-percent').val();
                if(n) skills.push({ name: n, percent: p });
            });

            // Collection Education
            let education = [];
            $('.education-row').each(function() {
                let s = $(this).find('.edu-school').val();
                let y = $(this).find('.edu-years').val();
                let d = $(this).find('.edu-degree').val();
                if(s || d) education.push({ school: s, years: y, degree: d });
            });

            // Collection History
            let history = [];
            $('.history-row').each(function() {
                let y = $(this).find('.hist-year').val();
                let t = $(this).find('.hist-text').val();
                if(y || t) history.push({ year: y, text: t });
            });
            
            // Handle ID generation if new
            // For DB, we send empty ID and let DB assign, then reload list or assign from response?
            // API returns success:true. It doesn't return the new ID yet.
            // But we reload the list anyway or we can add it partially.
            // Ideally we reload.
            
            // NOTE: The previous logic generated a string ID.
            // New logic: ID is numeric.
            
            let newID = id;
            if (!id) {
                newID = 'new'; // Flag for API
            }

            let newMember = {
                name: name,
                role: $('#m_role').val(),
                long_role: $('#m_role').val(), 
                image: $('#m_image').val() || 'assets/images/resources/user.png',
                quote: $('#m_quote').val(),
                bio_1: $('#m_bio_1').val(),
                bio_2: $('#m_bio_2').val(),
                social: { 
                    linkedin: $('#m_linkedin').val(),
                    twitter: $('#m_twitter').val(),
                    facebook: $('#m_facebook').val()
                },
                skills: skills,
                education: education,
                history: history
            };

            // Don't update local teamData[id] yet, wait for reload
            
            fetch('api/team_api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    action: 'save', 
                    id: newID, 
                    member: newMember 
                })
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    $('#teamModal').modal('hide');
                    loadTeamData(); // Reload from server to get new IDs
                    Swal.fire({
                        icon: 'success',
                        title: 'Enregistré',
                        text: 'Profil mis à jour avec succès',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire('Erreur', res.error || 'Erreur inconnue', 'error');
                }
            })
            .catch(err => {
                console.error('Save Error:', err);
                Swal.fire('Erreur', 'Erreur réseau lors de la sauvegarde.', 'error');
            });
        }

        function deleteMember(id) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (!teamData[id]) return;
                    
                    // delete teamData[id]; // Don't delete locally yet, wait for success
                    
                    fetch('api/team_api.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'delete', id: id })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.success) {
                            delete teamData[id]; // Update local data on success
                            renderTeamList();
                            Swal.fire(
                                'Supprimé !',
                                'Le membre a été supprimé.',
                                'success'
                            );
                        } else {
                            Swal.fire('Erreur', res.error || 'Impossible de supprimer.', 'error');
                        }
                    })
                    .catch(err => {
                        console.error('Delete Network Error:', err);
                        Swal.fire('Erreur', 'Erreur réseau lors de la suppression.', 'error');
                    });
                }
            });
        }
        
        function editMember(id) {
            openTeamModal(id);
        }
    </script>
</body>
</html>