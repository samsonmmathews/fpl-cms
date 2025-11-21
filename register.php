<?php
session_start();
include 'connect.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($name === '' || $email === '' || $password === '' || $confirm === '') {
        set_message('Please fill all fields', 'danger');
        header('Location: register.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_message('Invalid email format', 'danger');
        header('Location: register.php');
        exit;
    }

    if ($password !== $confirm) {
        set_message('Passwords do not match', 'danger');
        header('Location: register.php');
        exit;
    }

    if (strlen($password) < 8) {
        set_message('Password must be at least 8 characters', 'danger');
        header('Location: register.php');
        exit;
    }

    $check = mysqli_prepare($connect, "SELECT id FROM users WHERE email=? LIMIT 1");
    mysqli_stmt_bind_param($check, "s", $email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        set_message('Email already exists', 'danger');
        header('Location: register.php');
        exit;
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $insert = mysqli_prepare($connect, "INSERT INTO users (email, password_hash) VALUES (?, ?)");
    mysqli_stmt_bind_param($insert, "ss", $email, $hash);
    $ok = mysqli_stmt_execute($insert);

    if (!$ok) {
        set_message('DB error: ' . mysqli_error($connect), 'danger');
        header('Location: register.php');
        exit;
    }

    set_message('Registration successful. Please login.', 'success');
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Register</h2>

<?php get_message(); ?>

<form method="post" class="mt-3">

    <div class="mb-3">
        <label>Name</label>
        <input class="form-control" type="text" name="name">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input class="form-control" type="email" name="email">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input class="form-control" type="password" name="password">
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input class="form-control" type="password" name="confirm">
    </div>

    <button class="btn btn-success w-100">Register</button>

    <p class="mt-3 text-center">
        <a href="login.php">Already have an account?</a>
    </p>
</form>

</body>
</html>
