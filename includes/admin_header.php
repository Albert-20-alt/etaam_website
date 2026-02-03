<header class="dashboard-header">
    <button class="mobile-toggle d-lg-none icon-btn" id="openSidebar" style="margin-right: 15px;"><i class="fas fa-bars"></i></button>
    
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Rechercher...">
    </div>

    <div class="header-actions">
        <!-- Messages Notification -->
        <button class="icon-btn position-relative" onclick="window.location.href='admin-messages.php'" title="Messages">
            <i class="fas fa-bell"></i>
            <?php if(isset($unread_count) && $unread_count > 0): ?>
            <span style="position: absolute; top: 0; right: 0; background: #EF4444; width: 8px; height: 8px; border-radius: 50%;"></span>
            <?php endif; ?>
        </button>

        <!-- Calendar / Events (Placeholder) -->
        <button class="icon-btn" title="Calendrier"><i class="fas fa-calendar"></i></button>
        
        <!-- Logout Button -->
        <button class="icon-btn" title="Déconnexion" onclick="window.location.href='logout.php'" style="color: #EF4444; border-color: rgba(239,68,68,0.3);">
            <i class="fas fa-sign-out-alt"></i>
        </button>

        <!-- Profile Dropdown -->
        <div class="admin-profile d-flex align-items-center gap-3 ps-3 border-start border-secondary border-opacity-25">
            <div class="text-end d-none d-md-block">
                <div style="font-weight: 600; font-size: 14px;">ETAAM</div>
                <div style="font-size: 12px; color: var(--admin-text-muted);">Administrateur</div>
            </div>
            <div style="width: 45px; height: 45px; overflow: hidden; border-radius: 12px; border: 2px solid var(--admin-border-color); display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.05);">
                <img src="assets/images/resources/logo-3.png" alt="ETAAM" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
            </div>
        </div>
    </div>
</header>
