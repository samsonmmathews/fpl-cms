<?php
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
?>



<nav class="navbar">
    <div class="nav-left">
        <a href="index.php" class="nav-btn">Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="addplayer.php" class="nav-btn">Add Player</a>
        <?php else: ?>
            <a href="login.php" class="nav-btn">Login</a>
        <?php endif; ?>
    </div>

    <div class="nav-center">
        <span class="nav-title">Fantasy Premier League</span>
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a class="nav-btn logout-btn" href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</nav>
