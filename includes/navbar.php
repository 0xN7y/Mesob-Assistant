<?php $rootPrefix = (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) ? '../' : ''; ?>
<nav class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="<?= $rootPrefix ?>index.php"><span class="brand-mark">M</span> MISA</a>
        <div class="nav-links">
            <a href="<?= $rootPrefix ?>index.php">Home</a>
            <a href="<?= $rootPrefix ?>services.php">Services</a>
            <a href="<?= $rootPrefix ?>chat.php">Ask MISA</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= $rootPrefix ?>dashboard.php">Dashboard</a>
                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                    <a href="<?= $rootPrefix ?>admin/dashboard.php">Admin</a>
                <?php endif; ?>
                <a class="nav-login" href="<?= $rootPrefix ?>logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-login" href="<?= $rootPrefix ?>login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>