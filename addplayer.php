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
    <h2>Add Player</h2>
    <?php include('nav.php'); ?>
    <form method="POST" enctype="multipart/form-data">
        <label for="fullName">Full Name:</label>
        <input class="form-control mb-2" type="text" name="fullName" placeholder="Full name" required>

        <label for="position">Position:</label>
        <select name="position" id="position">
            <option value="FWD">FWD</option>
            <option value="MID">MID</option>
            <option value="DEF">DEF</option>
            <option value="GK">GK</option>
        </select>

        <br>
        <!-- <label for="position">Position:</label>
        <input class="form-control mb-2" type="text" name="position" placeholder="FWD, MID, DEF, GK" required> -->

        <label for="price">Price (£m):</label>
        <input class="form-control mb-2" type="number" name="price" step="0.1" placeholder="eg. 7.5" required>

        <label for="position">Position:</label>
        <input class="form-control mb-2" type="number" name="points" placeholder="Enter the points for the current game week" required>

        <label for="totalPoints">Position:</label>
        <input class="form-control mb-2" type="number" name="totalPoints" placeholder="Enter the cumulative points" required>

        <label for="fk_team">Team:</label>
        <select class="form-control mb-3" name="fk_team" required>
            <option value="">Select Team</option>
            <?php
                include 'connect.php';
                $query = "SELECT team_id, team_name FROM teams ORDER BY team_name";

                $result = mysqli_query($connect, $query);

                while($teams = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$teams['team_id']}'>{$teams['team_id']}. {$teams['team_name']}</option>";
                }
            ?>
        </select>    
        <!-- TODO -->
        <!-- <input class="form-control mb-2" type="file" name="image"> -->
        <button class="btn btn-success" type="submit" name="addPlayer">Submit</button>
    </form>

    <?php
        // require('connect.php');

        if (isset($_POST['addPlayer'])) {
            $fullName = $_POST['fullName'];
            $position = $_POST['position'];
            $price = $_POST['price'];
            $points = $_POST['points'];
            $totalPoints = $_POST['totalPoints'];
            $fk_team = $_POST['fk_team'];

            // TODO
            // if (!empty($_FILES['image']['name'])) {
            //     $targetDir = "uploads/";
            //     if (!is_dir($targetDir)) 
            //         mkdir($targetDir);
            //     $fileName = time() . "_" . basename($_FILES["image"]["name"]);
            //     $targetFilePath = $targetDir . $fileName;
            //     move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
            //     $imagePath = $targetFilePath;
            // }

            $query = "INSERT INTO players (full_name, position, price, points, total_points, fk_team) VALUES ('$fullName', '$position', '$price', '$points', '$totalPoints', '$fk_team')";
            $result = mysqli_query($connect, $query);
            if ($result)
            {
                header("Location: index.php");
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