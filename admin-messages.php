<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';

$messages = [];
$unread_count = 0;
$filter = $_GET['filter'] ?? 'all';

try {
    // Count unread
    $stmt = $pdo->query("SELECT COUNT(*) FROM messages WHERE is_read = 0");
    $unread_count = $stmt->fetchColumn();

    // Fetch Messages based on filter
    $sql = "SELECT *, UNIX_TIMESTAMP(created_at) as timestamp FROM messages";
    if ($filter === 'unread') {
        $sql .= " WHERE is_read = 0 AND is_archived = 0";
    } elseif ($filter === 'archived') {
        $sql .= " WHERE is_archived = 1";
    } else {
         // all (exclude archived by default or include? usually 'all' means inbox + read, not archived)
         // Let's say 'all' = everything except archived, or literally all?
         // Standard is Inbox = Not Archived.
         // But the filter name is 'all'. Let's show All (Not Archived).
         $sql .= " WHERE is_archived = 0";
    }
    $sql .= " ORDER BY created_at DESC";
    
    $stmt = $pdo->query($sql);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messages | Administration ETAAM</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Gestion des messages ETAAM" />

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
        /* Sidebar overrides for consistency */
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

        /* Mobile Responsive Overrides */
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
            .search-bar {
                display: none;
            }
        }
        
        /* Message Specific Styles */
        .message-unread td {
            font-weight: 600;
            background: rgba(59, 130, 246, 0.05);
        }
        
        .message-unread td:first-child {
            border-left: 3px solid var(--brand-primary);
        }

        .filter-btn {
            background: transparent;
            border: 1px solid var(--admin-border-color);
            color: var(--admin-text-muted);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.2s;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: rgba(255,255,255,0.05);
            color: white;
            border-color: rgba(255,255,255,0.2);
        }
        
        .badge-count {
            background: var(--brand-primary);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'messages';
    include 'includes/admin_sidebar.php'; 
    ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="dashboard-container">
            
            <!-- Header -->
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <!-- Messages Container -->
            <div class="nex-card">
                <div class="table-header-nex">
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <h4 class="card-title-nex" style="margin-right: 15px;">Boîte de réception</h4>
                        <a href="?filter=all" class="filter-btn <?php echo ($filter === 'all') ? 'active' : ''; ?>">Tous</a>
                        <a href="?filter=unread" class="filter-btn <?php echo ($filter === 'unread') ? 'active' : ''; ?>">Non lus <?php if($unread_count > 0): ?><span class="badge-count" style="background: #EF4444;"><?php echo $unread_count; ?></span><?php endif; ?></a>
                        <a href="?filter=archived" class="filter-btn <?php echo ($filter === 'archived') ? 'active' : ''; ?>">Archivés</a>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button class="icon-btn" title="Actualiser" style="width: 38px; height: 38px;"><i class="fas fa-sync-alt"></i></button>
                        <button class="icon-btn" title="Paramètres" style="width: 38px; height: 38px;"><i class="fas fa-cog"></i></button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th style="width: 250px;">EXPÉDITEUR</th>
                                <th>SUJET</th>
                                <th style="width: 150px;">DATE</th>
                                <th style="width: 120px;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Unread Message 1 -->
<?php
                            // Logic moved to top of file
                            // $messages is already populated


                            if (empty($messages)) {
                                echo '<tr><td colspan="4" class="text-center" style="padding: 40px; color: rgba(255,255,255,0.5);">Aucun message reçu pour le moment.</td></tr>';
                            } else {
                                foreach ($messages as $msg) {
                                    $is_read = $msg['is_read'] ?? false;
                                    $row_class = $is_read ? '' : 'message-unread';
                                    
                                    // Generate Initials
                                    $names = explode(' ', $msg['name']);
                                    $initials = strtoupper(substr($names[0], 0, 1));
                                    if (count($names) > 1) {
                                        $initials .= strtoupper(substr(end($names), 0, 1));
                                    }

                                    // Format Date
                                    $msg_time = $msg['timestamp'];
                                    $today_time = strtotime('today');
                                    $yesterday_time = strtotime('yesterday');
                                    
                                    if ($msg_time >= $today_time) {
                                        $display_date = "Aujourd'hui, " . date('H:i', $msg_time);
                                    } elseif ($msg_time >= $yesterday_time) {
                                        $display_date = "Hier, " . date('H:i', $msg_time);
                                    } else {
                                        $display_date = date('d M, H:i', $msg_time);
                                    }

                                    // JSON safe string for JS
                                    $safe_msg = htmlspecialchars(json_encode($msg), ENT_QUOTES, 'UTF-8');
                            ?>
                            <tr class="<?php echo $row_class; ?>" style="cursor: pointer;" onclick="openMessage(this, <?php echo $safe_msg; ?>)">
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: <?php echo $is_read ? '#6B7280' : '#3B82F6'; ?>; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12px;"><?php echo $initials; ?></div>
                                        <div>
                                            <div style="font-weight: 600; font-size: 14px;">
                                                <?php echo htmlspecialchars($msg['name']); ?>
                                                <?php if (!$is_read): ?><span class="badge-count" style="margin-left: 5px;">Nouveau</span><?php endif; ?>
                                            </div>
                                            <div style="font-size: 11px; opacity: 0.6;"><?php echo htmlspecialchars($msg['email']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: <?php echo $is_read ? '400' : '600'; ?>; color: white;"><?php echo htmlspecialchars($msg['subject']); ?></div>
                                    <div style="font-size: 12px; opacity: 0.6; margin-top: 3px; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars($msg['message']); ?></div>
                                </td>
                                <td style="font-size: 13px; font-weight: <?php echo $is_read ? '400' : '600'; ?>;"><?php echo $display_date; ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;" onclick="event.stopPropagation();">
                                        <button class="icon-btn" style="width: 32px; height: 32px; font-size: 12px;" title="Répondre" onclick="window.location.href='mailto:<?php echo htmlspecialchars($msg['email']); ?>'"><i class="fas fa-reply"></i></button>
                                        <?php if(!($msg['is_archived'] ?? false)): ?>
                                        <button class="icon-btn" style="width: 32px; height: 32px; font-size: 12px;" title="Archiver" onclick="archiveMessage('<?php echo $msg['id']; ?>', this)"><i class="fas fa-archive"></i></button>
                                        <?php endif; ?>
                                        <button class="icon-btn" style="width: 32px; height: 32px; font-size: 12px; color: #EF4444; border-color: rgba(239,68,68,0.3);" title="Supprimer" onclick="deleteMessage('<?php echo $msg['id']; ?>', this)"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                } 
                            } 
                            ?>

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--admin-border-color);">
                    <div style="font-size: 13px; color: var(--admin-text-muted);">Affichage des derniers messages</div>
                </div>
            </div>

        </div>
    </main>

    <!-- Message Details Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: #1a1b21; border: 1px solid rgba(255,255,255,0.1); color: white;">
                <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <h5 class="modal-title" id="msgSubject" style="font-weight: 700;">Sujet du message</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <div style="display: flex; gap: 15px; margin-bottom: 25px;">
                        <div class="user-avatar-sm" id="msgAvatar" style="width: 50px; height: 50px; font-size: 18px; background: #3B82F6; display: flex; align-items: center; justify-content: center; font-weight: 600; border-radius: 50%;">MD</div>
                        <div>
                            <h4 id="msgName" style="font-size: 18px; font-weight: 700; margin: 0;">Nom de l'expéditeur</h4>
                            <div style="font-size: 13px; opacity: 0.7; margin-top: 2px;">
                                <span id="msgEmail">email@example.com</span> • <span id="msgDate">Date</span>
                            </div>
                            <div style="font-size: 13px; opacity: 0.7; margin-top: 2px;">Tél: <span id="msgPhone">77 000 00 00</span></div>
                        </div>
                    </div>
                    
                    <!-- Project Details Section -->
                    <div id="projectDetails" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 15px; margin-bottom: 20px; display: none;">
                        <h6 style="color: #60A5FA; font-size: 13px; text-transform: uppercase; margin-bottom: 10px; font-weight: 700;">Détails du Projet</h6>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 13px;">
                            <div><span style="opacity: 0.6;">Besoin:</span> <strong id="msgType" style="color: white; display:block;">-</strong></div>
                            <div><span style="opacity: 0.6;">Domaine:</span> <strong id="msgDomain" style="color: white; display:block;">-</strong></div>
                            <div><span style="opacity: 0.6;">Budget:</span> <strong id="msgBudget" style="color: white; display:block;">-</strong></div>
                            <div><span style="opacity: 0.6;">Délai:</span> <strong id="msgUrgency" style="color: white; display:block;">-</strong></div>
                        </div>
                    </div>

                    <!-- Appointment Section -->
                    <div id="appointmentDetails" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 15px; margin-bottom: 20px; display: none;">
                         <h6 style="color: #34D399; font-size: 13px; text-transform: uppercase; margin-bottom: 10px; font-weight: 700;"><i class="fas fa-calendar-check me-2"></i>Demande de Rendez-vous</h6>
                         <div style="font-size: 14px;">
                            <span style="opacity: 0.6;">Souhaité le:</span> <strong id="msgApptDate" style="color: white;">-</strong> à <strong id="msgApptTime" style="color: white;">-</strong>
                         </div>
                    </div>
                    
                    <div style="background: rgba(255,255,255,0.03); padding: 20px; border-radius: 12px; font-size: 15px; line-height: 1.6; white-space: pre-wrap;" id="msgContent">
                        Contenu du message...
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.05);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <a href="#" id="msgReplyBtn" class="btn btn-primary" style="background: #3B82F6; border: none;">Répondre</a>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update Unread Count safely
        let unreadCount = <?php echo $unread_count; ?>;

        function updateUnreadUI() {
            // Update badges in UI
            const badges = document.querySelectorAll('.notification-badge');
            badges.forEach(b => {
                b.textContent = unreadCount;
                if(unreadCount === 0) b.style.display = 'none';
            });
        }

        function openMessage(row, msg) {
            // Populate Modal
            document.getElementById('msgSubject').textContent = msg.subject;
            document.getElementById('msgName').textContent = msg.name;
            document.getElementById('msgEmail').textContent = msg.email;
            document.getElementById('msgPhone').textContent = msg.phone || 'Non renseigné';
            document.getElementById('msgDate').textContent = msg.date; // Note: 'date' key might need standardizing if msg.date is not passed by PHP, PHP passed 'timestamp'. Wait, checking PHP loop...
            // PHP uses $msg['timestamp']. But wait, openMessage(this, <?php echo $safe_msg; ?>) passes the whole row.
            // The row doesn't have a pre-formatted 'date' field in the array unless we added it.
            // In the PHP loop (lines 200+), we calculated $display_date but did NOT add it to $msg before json_encode.
            // We should use the timestamp or just rely on what we have.
            // Actually, let's fix the date display in JS or just let it be raw for now if it's missing.
            // Better: use the timestamp to format it in JS.
            let dateObj = new Date(msg.timestamp * 1000);
            document.getElementById('msgDate').textContent = dateObj.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });

            document.getElementById('msgContent').textContent = msg.message;
            document.getElementById('msgReplyBtn').href = 'mailto:' + msg.email;

            // Project Details
            if (msg.type || msg.domain || msg.budget || msg.urgency) {
                document.getElementById('projectDetails').style.display = 'block';
                document.getElementById('msgType').textContent = msg.type || '-';
                document.getElementById('msgDomain').textContent = msg.domain || '-';
                document.getElementById('msgBudget').textContent = msg.budget || '-';
                document.getElementById('msgUrgency').textContent = msg.urgency || '-';
            } else {
                document.getElementById('projectDetails').style.display = 'none';
            }

            // Appointment Details
            if (msg.appointment_date) {
                document.getElementById('appointmentDetails').style.display = 'block';
                document.getElementById('msgApptDate').textContent = new Date(msg.appointment_date).toLocaleDateString('fr-FR');
                document.getElementById('msgApptTime').textContent = msg.appointment_time || '';
            } else {
                document.getElementById('appointmentDetails').style.display = 'none';
            }

            // Avatar Initials
            let initials = msg.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
            document.getElementById('msgAvatar').textContent = initials;

            // Show Modal
            var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
            myModal.show();

            // Mark as Read Logic
            if (!msg.is_read) {
                // Optimistic UI Update
                row.classList.remove('message-unread');
                const badge = row.querySelector('.badge-count');
                if (badge) badge.remove();
                
                // Update styling of texts
                const subject = row.cells[1].querySelector('div:first-child');
                if (subject) subject.style.fontWeight = '400';
                
                // Call API
                fetch('api/update_message_status.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: msg.id })
                }).then(res => res.json())
                  .then(data => {
                      if (data.success) {
                          msg.is_read = true;
                          unreadCount = Math.max(0, unreadCount - 1);
                          updateUnreadUI();
                      }
                  });
            }
        }

        // Delete Message
        function deleteMessage(id, btn) {
            if(confirm('Êtes-vous sûr de vouloir supprimer ce message ? Cette action est irréversible.')) {
                // Optimistic UI for immediate feedback
                // Note: We do this inside the fetch success usually, but to make it feel instant we could do it here. 
                // For safety, let's wait for success.
                
                fetch('api/delete_message.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message_id: id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const row = btn.closest('tr');
                        if (row) {
                            // Update count if it was unread
                            if (row.classList.contains('message-unread')) {
                                unreadCount = Math.max(0, unreadCount - 1);
                                updateUnreadUI();
                            }
                            // Remove row with a nice fade out? For now just remove.
                            row.remove();
                            
                            // Check if table is empty (optional)
                            const tbody = document.querySelector('tbody');
                            if (tbody && tbody.children.length === 0) {
                                tbody.innerHTML = '<tr><td colspan="4" class="text-center" style="padding: 40px; color: rgba(255,255,255,0.5);">Aucun message.</td></tr>';
                            }
                        }
                    } else {
                        alert('Erreur: ' + (data.error || 'Impossible de supprimer'));
                    }
                });
            }
        }

        // Archive Message
        function archiveMessage(id, btn) {
            fetch('api/archive_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message_id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const row = btn.closest('tr');
                    if (row) {
                         // Update count if it was unread
                        if (row.classList.contains('message-unread')) {
                            unreadCount = Math.max(0, unreadCount - 1);
                            updateUnreadUI();
                        }
                        row.remove();
                         
                        const tbody = document.querySelector('tbody');
                        if (tbody && tbody.children.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="4" class="text-center" style="padding: 40px; color: rgba(255,255,255,0.5);">Aucun message.</td></tr>';
                        }
                    }
                } else {
                    alert('Erreur: ' + (data.error || 'Impossible d\'archiver'));
                }
            });
        }

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
        });
    </script>
</body>

</html>