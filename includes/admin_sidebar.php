<?php
// Default values if not set
if (!isset($current_page)) {
    $current_page = '';
}
if (!isset($unread_count)) {
    $unread_count = 0;
}
?>
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-logo">
            <img src="assets/images/resources/logo-2.png" alt="" width="140">
            <button class="mobile-toggle d-lg-none" id="closeSidebar" style="background:none; border:none; color:white; margin-left: auto;"><i class="fas fa-times"></i></button>
        </div>

        <nav class="admin-nav mt-4" style="flex: 1;">
            <?php
            // Helper function for checking permissions
            // Assuming this is available or we define it here if not in auth_check yet. 
            // Better to use data from session or fetch if not present.
            // For sidebar, we'll check session user role/permissions.
            
            $userRole = $_SESSION['admin_role'] ?? 'admin';
            $userPerms = $_SESSION['admin_permissions'] ?? [];
            if (is_string($userPerms)) $userPerms = json_decode($userPerms, true);
            if (!is_array($userPerms)) $userPerms = [];

            function hasPermission($perm, $role, $perms) {
                if ($role === 'admin') return true;
                return in_array($perm, $perms);
            }
            ?>

            <!-- Dashboard -->
            <?php if(hasPermission('dashboard', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin.php" class="admin-nav-link <?php echo ($current_page == 'dashboard') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'dashboard') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-th-large" style="width: 20px;"></i> Dashboard
                </a>
            </div>
            <?php endif; ?>

            <!-- Messages -->
            <?php if(hasPermission('messages', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-messages.php" class="admin-nav-link <?php echo ($current_page == 'messages') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'messages') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <div style="position: relative;">
                        <i class="fas fa-envelope" style="width: 20px;"></i>
                        <?php if($unread_count > 0): ?>
                        <span class="notification-badge" style="position: absolute; top: -8px; right: -8px; background: #EF4444; color: white; border-radius: 50%; width: 16px; height: 16px; font-size: 10px; display: flex; align-items: center; justify-content: center; border: 2px solid var(--admin-card-bg);"><?php echo $unread_count; ?></span>
                        <?php endif; ?>
                    </div>
                    Messages
                </a>
            </div>
            <?php endif; ?>

            <!-- Home Page -->
            <?php if(hasPermission('home', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-home.php" class="admin-nav-link <?php echo ($current_page == 'home') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'home') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-home" style="width: 20px;"></i> Accueil
                </a>
            </div>
            <?php endif; ?>

            <!-- Blog -->
            <?php if(hasPermission('blog', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-blog.php" class="admin-nav-link <?php echo ($current_page == 'blog') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'blog') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-pen-nib" style="width: 20px;"></i> Blog
                </a>
            </div>
            <?php endif; ?>

            <!-- Projects -->
            <?php if(hasPermission('projects', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-projects.php" class="admin-nav-link <?php echo ($current_page == 'projects') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'projects') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-project-diagram" style="width: 20px;"></i> Gestion Projets
                </a>
            </div>
            <?php endif; ?>

            <!-- Users -->
            <?php if(hasPermission('users', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-users.php" class="admin-nav-link <?php echo ($current_page == 'users') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'users') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-user-shield" style="width: 20px;"></i> Utilisateurs
                </a>
            </div>
            <?php endif; ?>

            <!-- Services -->
            <?php if(hasPermission('services', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-services.php" class="admin-nav-link <?php echo ($current_page == 'services') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'services') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-cube" style="width: 20px;"></i> Services
                </a>
            </div>
            <?php endif; ?>

            <!-- Forum -->
            <?php if(hasPermission('services', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-forum.php" class="admin-nav-link <?php echo ($current_page == 'forum') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'forum') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-comments" style="width: 20px;"></i> Gestion Forum
                </a>
            </div>
            <?php endif; ?>

            <!-- Marketing -->
            <?php if(hasPermission('marketing', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-marketing.php" class="admin-nav-link <?php echo ($current_page == 'marketing') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'marketing') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-bullhorn" style="width: 20px;"></i> Marketing
                </a>
            </div>
            <?php endif; ?>

            <!-- Email Marketing -->
            <?php if(hasPermission('marketing', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-email-marketing.php" class="admin-nav-link <?php echo ($current_page == 'email-marketing') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'email-marketing') ? 'background: linear-gradient(90deg, #F59E0B 0%, #D97706 100%);' : ''; ?>">
                    <i class="fas fa-envelope-open-text" style="width: 20px;"></i> Emailing
                </a>
            </div>
            <?php endif; ?>

            <!-- Team -->
            <?php if(hasPermission('team', $userRole, $userPerms)): ?>

            <div class="admin-nav-item mb-2">
                <a href="admin-team.php" class="admin-nav-link <?php echo ($current_page == 'team') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'team') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-users" style="width: 20px;"></i> Équipe
                </a>
            </div>
            <?php endif; ?>

            <!-- About -->
            <?php if(hasPermission('about', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-about.php" class="admin-nav-link <?php echo ($current_page == 'about') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'about') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-info-circle" style="width: 20px;"></i> À Propos
                </a>
            </div>
            <?php endif; ?>

            <!-- Settings -->
            <?php if(hasPermission('settings', $userRole, $userPerms)): ?>
            <div class="admin-nav-item mb-2">
                <a href="admin-settings.php" class="admin-nav-link <?php echo ($current_page == 'settings') ? 'active text-white' : 'text-white-50 text-decoration-none hover-bg-light'; ?> d-flex align-items-center gap-3 px-3 py-3 rounded-3" 
                   style="<?php echo ($current_page == 'settings') ? 'background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);' : ''; ?>">
                    <i class="fas fa-cog" style="width: 20px;"></i> Paramètres
                </a>
            </div>
            <?php endif; ?>
            
            <div class="mt-4 pt-4 border-top border-secondary border-opacity-25">
                 <div class="admin-nav-item mb-2">
                    <a href="index.php" class="admin-nav-link d-flex align-items-center gap-3 px-3 py-3 rounded-3 text-secondary text-decoration-none">
                        <i class="fas fa-external-link-alt" style="width: 20px;"></i> Retour au Site
                    </a>
                </div>
                 <div class="admin-nav-item mb-2">
                    <a href="logout.php" class="admin-nav-link d-flex align-items-center gap-3 px-3 py-3 rounded-3 text-danger text-decoration-none">
                        <i class="fas fa-sign-out-alt" style="width: 20px;"></i> Déconnexion
                    </a>
                </div>
            </div>
        </nav>

        <!-- Upgrade Card -->
        <div class="upgrade-card mt-4">
            <div style="font-size: 24px; margin-bottom: 10px;">🚀</div>
            <h5 style="font-size: 16px; font-weight: 700; margin-bottom: 5px; color: white;">Premium Features</h5>
            <p style="font-size: 12px; opacity: 0.7; margin-bottom: 15px;">Débloquez l'analyse avancée</p>
            <button class="upgrade-btn">Upgrade Now</button>
        </div>
    </aside>
