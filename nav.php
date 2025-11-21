<?php
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
?>

<nav class="mb-3">
    <div>
        <a href="index.php" class="btn btn-primary btn-sm">Home</a>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="addplayer.php" class="btn btn-primary btn-sm">Add Player</a>
            <!-- <a href="users.php" class="btn btn-secondary btn-sm">Users</a> -->
            <!-- Li,pengcheng: Logout button: Allows the user to end the session and return to the login screen -->
            <div class="text-end mb-3">
                <a class="btn btn-outline-danger btn-sm" href="logout.php">Logout</a>
            </div>
        <?php else: ?>
            <a href="login.php" class="btn btn-success btn-sm">Login</a>
            <!-- <a href="register.php" class="btn btn-secondary btn-sm">Register</a> -->
        <?php endif; ?>
    </div>
</nav>