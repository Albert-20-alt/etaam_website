<?php
include 'includes/auth_check.php';
require_once __DIR__ . '/includes/db_connect.php';

$unread_count = 0;
$messages_count = 0;
$services_count = 0;
$projects_count = 0;
$posts_count = 0;
$subscribers_count = 0;
$team_count = 0;

try {
    // Messages
    $stmt = $pdo->query("SELECT COUNT(*) FROM messages WHERE is_read = 0");
    $unread_count = $stmt->fetchColumn();
    $stmt = $pdo->query("SELECT COUNT(*) FROM messages");
    $messages_count = $stmt->fetchColumn();
    
    // Services
    $stmt = $pdo->query("SELECT COUNT(*) FROM services");
    $services_count = $stmt->fetchColumn();
    
    // Projects
    $stmt = $pdo->query("SELECT COUNT(*) FROM projects");
    $projects_count = $stmt->fetchColumn();

    // Blog Posts
    $stmt = $pdo->query("SELECT COUNT(*) FROM blog_posts");
    $posts_count = $stmt->fetchColumn();

    // Newsletter Subscribers
    $stmt = $pdo->query("SELECT COUNT(*) FROM newsletter_subscribers");
    $subscribers_count = $stmt->fetchColumn();

    // Team Members
    $stmt = $pdo->query("SELECT COUNT(*) FROM team_members");
    $team_count = $stmt->fetchColumn();
    
} catch (PDOException $e) {
    error_log("Db Error: " . $e->getMessage());
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
    <meta name="description" content="Panneau d'administration ETAAM" />

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
    
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        /* Sidebar overrides for this specific page structure */
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
                display: none; /* Hide search on mobile to save space */
            }
        }
        
        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-published { background: rgba(16, 185, 129, 0.1); color: #10B981; }
        .status-draft { background: rgba(245, 158, 11, 0.1); color: #F59E0B; }
        
        .module-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?php 
    $current_page = 'dashboard';
    include 'includes/admin_sidebar.php'; 
    ?>


    <!-- Main Content -->
    <main class="admin-main">
        <div class="dashboard-container">
            
            <!-- Header -->
            <?php include 'includes/admin_header.php'; ?>

            <!-- Stats Row -->
            <div class="stats-grid-nex">
                <!-- Stat 1: Messages -->
                <div class="nex-card stat-card-nex">
                    <div class="stat-icon orange">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Messages</h3>
                        <div class="value"><?php echo $unread_count; ?> <span style="font-size: 0.5em; opacity: 0.6;">/ <?php echo $messages_count; ?> total</span></div>
                    </div>
                </div>
                <!-- Stat 2: Projects -->
                <div class="nex-card stat-card-nex">
                    <div class="stat-icon green">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Projets Actifs</h3>
                        <div class="value"><?php echo $projects_count; ?></div>
                    </div>
                </div>
                <!-- Stat 3: Blog Posts -->
                <div class="nex-card stat-card-nex">
                    <div class="stat-icon purple">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Articles Blog</h3>
                        <div class="value"><?php echo $posts_count; ?></div>
                    </div>
                </div>
                <!-- Stat 4: Subscribers -->
                <div class="nex-card stat-card-nex">
                    <div class="stat-icon blue"> <!-- Blue isn't defined in CSS fallback to default or add style if needed, assuming nexlink.css handles it or we use custom style -->
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Abonnés</h3>
                        <div class="value"><?php echo $subscribers_count; ?></div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="charts-grid-nex">
                <!-- Main Line Chart -->
                <div class="nex-card">
                    <div class="card-header-nex">
                        <h4 class="card-title-nex">Aperçu du Trafic (Messages)</h4>
                        <select class="chart-select">
                            <option>Derniers 12 mois</option>
                        </select>
                    </div>
                    <div id="trafficChart" style="min-height: 300px;"></div>
                </div>

                <!-- Right Column: Gauge + Donut -->
                <div style="display: flex; flex-direction: column; gap: 25px;">
                    <!-- Target Card -->
                    <div class="nex-card target-card">
                        <div style="position: relative; z-index: 1; text-align: center; color: white;">
                            <h4 style="font-size: 16px; opacity: 0.9; margin-bottom: 5px;">Santé du Système</h4>
                            <div style="font-size: 32px; font-weight: 700;">100%</div>
                            <div style="font-size: 12px; opacity: 0.7;">Tous les services sont opérationnels</div>
                            
                            <div class="target-circle-bg">
                                <div class="target-circle-prog" style="width: 100%;"></div>
                            </div>
                            
                            <p style="margin-top: 15px; font-size: 13px; opacity: 0.8;">Base de données connectée.</p>
                        </div>
                    </div>

                    <!-- Donut Chart -->
                    <div class="nex-card">
                        <div class="card-header-nex">
                            <h4 class="card-title-nex">Types de Demandes</h4>
                        </div>
                        <div id="deviceChart" style="min-height: 200px; display: flex; justify-content: center;"></div>
                    </div>
                </div>
            </div>

            <!-- Modules Table Section -->
            <div class="nex-card">
                <div class="table-header-nex">
                    <h4 class="card-title-nex">Gestion des Modules</h4>
                    <div style="position: relative;">
                         <!-- Optional Filter -->
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>MODULE</th>
                                <th>DESCRIPTION</th>
                                <th>STATISTIQUES</th>
                                <th>DERNIÈRE ACTION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Services -->
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: rgba(59, 130, 246, 0.1); color: #3B82F6; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <span style="font-weight: 600;">Services</span>
                                    </div>
                                </td>
                                <td style="color: var(--admin-text-muted);">Gérer les offres de service</td>
                                <td><span class="badge bg-primary"><?php echo $services_count; ?> Services</span></td>
                                <td style="color: var(--admin-text-muted);">-</td>
                                <td>
                                    <a href="admin-services.php" class="btn btn-sm btn-outline-primary">Gérer</a>
                                </td>
                            </tr>
                             <!-- Projets -->
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: rgba(16, 185, 129, 0.1); color: #10B981; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-project-diagram"></i>
                                        </div>
                                        <span style="font-weight: 600;">Projets</span>
                                    </div>
                                </td>
                                <td style="color: var(--admin-text-muted);">Portfolio et réalisations</td>
                                <td><span class="badge bg-success"><?php echo $projects_count; ?> Projets</span></td>
                                <td style="color: var(--admin-text-muted);">-</td>
                                <td>
                                    <a href="admin-projects.php" class="btn btn-sm btn-outline-success">Gérer</a>
                                </td>
                            </tr>
                            <!-- Blog -->
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: rgba(139, 92, 246, 0.1); color: #8B5CF6; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-pen-nib"></i>
                                        </div>
                                        <span style="font-weight: 600;">Blog</span>
                                    </div>
                                </td>
                                <td style="color: var(--admin-text-muted);">Articles et actualités</td>
                                <td><span class="badge bg-info"><?php echo $posts_count; ?> Articles</span></td>
                                <td style="color: var(--admin-text-muted);">-</td>
                                <td>
                                    <a href="admin-blog.php" class="btn btn-sm btn-outline-info">Gérer</a>
                                </td>
                            </tr>
                             <!-- Team -->
                             <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <span style="font-weight: 600;">Équipe</span>
                                    </div>
                                </td>
                                <td style="color: var(--admin-text-muted);">Membres et profils</td>
                                <td><span class="badge bg-warning text-dark"><?php echo $team_count; ?> Membres</span></td>
                                <td style="color: var(--admin-text-muted);">-</td>
                                <td>
                                    <a href="admin-team.php" class="btn btn-sm btn-outline-warning">Gérer</a>
                                </td>
                            </tr>
                             <!-- Email Marketing -->
                             <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: rgba(239, 68, 68, 0.1); color: #EF4444; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-envelope-open-text"></i>
                                        </div>
                                        <span style="font-weight: 600;">Emailing</span>
                                    </div>
                                </td>
                                <td style="color: var(--admin-text-muted);">Newsletter et campagnes</td>
                                <td><span class="badge bg-danger"><?php echo $subscribers_count; ?> Abonnés</span></td>
                                <td style="color: var(--admin-text-muted);">-</td>
                                <td>
                                    <a href="admin-email-marketing.php" class="btn btn-sm btn-outline-danger">Gérer</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    
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
        });

        // Initialize ApexCharts
        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. Traffic Overview Chart: Messages Received last 12 months
            <?php
            // Prepare Data for Chart
            $chartData = [];
            
            try {
                // Get messages count grouped by month for last 12 months
                $stmt = $pdo->query("
                    SELECT 
                        DATE_FORMAT(created_at, '%b') as month_name,
                        COUNT(*) as count
                    FROM messages 
                    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
                    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                    ORDER BY DATE_FORMAT(created_at, '%Y-%m')
                ");
                $chartData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // ['Jan' => 5, 'Feb' => 2]
            } catch (PDOException $e) {
                // Ignore
            }

            // Fill missing months with 0
            $months = [];
            $values = [];
            for ($i = 11; $i >= 0; $i--) {
                $m = date('M', strtotime("-$i months"));
                // Map English short to French short
                $frMap = ['Jan'=>'Jan', 'Feb'=>'Fev', 'Mar'=>'Mar', 'Apr'=>'Avr', 'May'=>'Mai', 'Jun'=>'Juin', 'Jul'=>'Juil', 'Aug'=>'Aou', 'Sep'=>'Sep', 'Oct'=>'Oct', 'Nov'=>'Nov', 'Dec'=>'Dec'];
                $frM = $frMap[$m] ?? $m;
                
                $months[] = $frM;
                $values[] = $chartData[$m] ?? 0;
            }
            ?>
            
            var trafficOptions = {
                series: [{
                    name: 'Messages Reçus',
                    data: <?php echo json_encode($values); ?>
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: { show: false },
                    background: 'transparent'
                },
                colors: ['#3B82F6'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: <?php echo json_encode($months); ?>,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: { style: { colors: '#aaa' } }
                },
                yaxis: {
                    labels: { style: { colors: '#aaa' }, formatter: (val) => Math.floor(val) }
                },
                grid: {
                    borderColor: 'rgba(255,255,255,0.05)',
                },
                theme: { mode: 'dark' },
                fill: {
                  type: 'gradient',
                  gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3, // Faded
                    stops: [0, 90, 100]
                  }
                }
            };

            var trafficChart = new ApexCharts(document.querySelector("#trafficChart"), trafficOptions);
            trafficChart.render();
            
            // Update Card Title Not needed via JS as updated in HTML
            document.querySelector('.chart-select').style.display = 'none';

            // 2. Message Types Chart (Donut)
            <?php
            // Get stats by 'type' (Besoin defined in contact form)
            $typeData = [];
            $typeLabels = [];
            try {
                $stmt = $pdo->query("SELECT type, COUNT(*) as count FROM messages GROUP BY type");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $r) {
                     if($r['type']) {
                        $typeLabels[] = ucfirst($r['type']);
                        $typeData[] = (int)$r['count'];
                     }
                }
            } catch (PDOException $e) {}
            
            if(empty($typeData)) {
                $typeLabels = ['Aucune donnée'];
                $typeData = [1]; // dummy
            }
            ?>

            var deviceOptions = {
                series: <?php echo json_encode($typeData); ?>,
                labels: <?php echo json_encode($typeLabels); ?>,
                chart: {
                    type: 'donut',
                    height: 250,
                    background: 'transparent'
                },
                colors: ['#3B82F6', '#10B981', '#F59E0B', '#6A4C93'],
                legend: {
                    position: 'bottom',
                    labels: { colors: '#fff' }
                },
                dataLabels: { enabled: false },
                stroke: { show: false }
            };

            var deviceChart = new ApexCharts(document.querySelector("#deviceChart"), deviceOptions);
            deviceChart.render();
        });
    </script>
</body>
</html>