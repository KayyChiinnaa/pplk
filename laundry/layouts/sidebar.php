<aside class="sidebar">
    <div class="sidebar-header">
        LAUNDRY BN
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="/laundry/dashboard.php" class="sidebar-link <?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : '' ?>">
                🏠 Dashboard
            </a>
        </li>
        <li>
            <a href="/laundry/modules/outlet/index.php" class="sidebar-link <?= (strpos($_SERVER['PHP_SELF'], '/outlet/') !== false) ? 'active' : '' ?>">
                🏢 Outlet
            </a>
        </li>
        <li>
            <a href="/laundry/modules/member/index.php" class="sidebar-link <?= (strpos($_SERVER['PHP_SELF'], '/member/') !== false) ? 'active' : '' ?>">
                👥 Member
            </a>
        </li>
        <li>
            <a href="/laundry/modules/user/index.php" class="sidebar-link <?= (strpos($_SERVER['PHP_SELF'], '/user/') !== false) ? 'active' : '' ?>">
                ⚙️ User
            </a>
        </li>
        <li style="margin-top: auto;">
            <a href="/laundry/logout.php" class="sidebar-link" style="color: var(--danger);">
                🚪 Logout
            </a>
        </li>
    </ul>
</aside>
