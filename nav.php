<?php
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
?>



<nav class="mb-3 bg-transparent border-bottom border-light p-2">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="index.php" class="btn btn-primary btn-sm">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="addplayer.php" class="btn btn-primary btn-sm">Add Player</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-success btn-sm">Login</a>
            <?php endif; ?>
        </div>

         <div class="text-center flex-grow-1">
            <span class="medium text-white mb-0">Fantasy Premier League</span>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a class="btn btn-outline-danger btn-sm" href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</nav>
