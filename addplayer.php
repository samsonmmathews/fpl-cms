<?php
    session_start();
    if (!isset($_SESSION['user_id'])) 
    {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Add User</h2>
    <?php include('nav.php'); ?>
    <form method="POST" enctype="multipart/form-data">
        <label for="fullName">Full Name:</label>
        <input class="form-control mb-2" type="text" name="fullName" placeholder="Full name" required>
        <label for="position">Position:</label>
        <input class="form-control mb-2" type="text" name="position" placeholder="FWD, MID, DEF, GK" required>
        <label for="price">Price:</label>
        <input class="form-control mb-2" type="number" name="price" step="0.1" placeholder="7.5" required>
        <label for="position">Position:</label>
        <input class="form-control mb-2" type="number" name="points" placeholder="Enter the points for the current game week" required>
        <label for="totalPoints">Position:</label>
        <input class="form-control mb-2" type="number" name="totalPoints" placeholder="Enter the cumulative points" required>
        <!-- TODO -->
        <!-- <input class="form-control mb-2" type="file" name="image"> -->
        <button class="btn btn-success" type="submit" name="addPlayer">Submit</button>
    </form>

    <?php
        require('connect.php');

        if (isset($_POST['addUser'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $imagePath = null;

            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) 
                    mkdir($targetDir);
                $fileName = time() . "_" . basename($_FILES["image"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
                $imagePath = $targetFilePath;
            }

            $query = "INSERT INTO users (name, email, password, image) VALUES ('$name', '$email', '$password', '$imagePath')";
            $result = mysqli_query($connect, $query);
            if ($query)
            {
                header("Location: users.php");
                echo "User added successfully.";
                exit();
            }
            else
            {
                echo "Failed: " . $connect->error;
            }
        }
    ?>
</body>
</html>