<?php
session_start();
include 'connect.php';
include 'functions.php';

if (isset($_GET['registered']) && $_GET['registered'] == 1) {
  set_message('Account created successfully. Please log in.', 'success');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if ($email === '' || $password === '') {
    set_message('Please enter both email and password.', 'danger');
    header('Location: login.php'); exit;
  }

  $stmt = mysqli_prepare($connect, "SELECT id, email, password_hash FROM users WHERE email = ? LIMIT 1");
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($res);

  if ($user && password_verify($password, $user['password_hash'])) {

    session_regenerate_id(true);

    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_email'] = $user['email'];

    header('Location: index.php'); 
    exit;

  } else {
    set_message('Incorrect email or password.', 'danger');
    header('Location: login.php'); 
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

<h2 class="text-center mb-4">Login</h2>

<?php get_message(); ?>

<div class="row justify-content-center">
  <div class="col-md-4">

    <form method="post">

      <div class="mb-3">
        <label>Email</label>
        <input class="form-control" type="email" name="email">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input class="form-control" type="password" name="password">
      </div>

      <button class="btn btn-primary w-100">Login</button>
    </form>

    <p class="text-center mt-3">
      <a href="register.php">Register</a>
    </p>

  </div>
</div>

</body>
</html>
