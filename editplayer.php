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
        <title>Edit Player</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="container py-5">
        <h2>Edit Player</h2>

        <?php 
            include('nav.php'); 

            require('connect.php');

            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $result = mysqli_query($connect, "SELECT * FROM players WHERE player_id=$id");
                $player = $result->fetch_assoc();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['player_id'];
                $fullName = $_POST['fullName'];
                $position = $_POST['position'];
                $price = $_POST['price'];
                $points = $_POST['points'];
                $totalPoints = $_POST['totalPoints'];
                $fk_team = $_POST['fk_team'];

                // if (!empty($_FILES['image']['name'])) {
                //     $targetDir = "uploads/";
                //     if (!is_dir($targetDir)) mkdir($targetDir);
                //     $fileName = time() . "_" . basename($_FILES["image"]["name"]);
                //     $targetFilePath = $targetDir . $fileName;
                //     move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
                //     $imagePath = $targetFilePath;
                // }

                $query = "UPDATE players SET 
                full_name = '$fullName',
                position = '$position',
                price = '$price',
                points = '$points',
                total_points = '$totalPoints',
                fk_team = '$fk_team'
                WHERE player_id = $id ";

                $result = mysqli_query($connect, $query);

                // if ($password) {
                //     $query = "UPDATE users SET `name`='$name', `email`='$email', `password`='$password', `image`='$imagePath' WHERE id=$id";
                //     $result = mysqli_query($connect, $query);
                // } else
                // {
                //     $query = $connect->prepare("UPDATE users SET `name`='$name', `email`='$email', `image`='$imagePath' WHERE id=$id");
                //     $result = mysqli_query($connect, $query);
                // }

                if ($result) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Failed: " . $connect->error;
                }
            }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="player_id" value="<?= $player['player_id'] ?>">

            <label>Full Name:</label>
            <input class="form-control mb-2" type="text" name="fullName" value="<?= $player['full_name'] ?>" required>

            <label for="position">Position:</label>
            <select class="form-control mb-2" name="position" required>
                <option value="GK" <?= $player['position']=='FWD'?'selected':'' ?> >FWD</option>
                <option value="DEF" <?= $player['position']=='MID'?'selected':'' ?> >MID</option>
                <option value="MID" <?= $player['position']=='DEF'?'selected':'' ?> >DEF</option>
                <option value="FWD" <?= $player['position']=='GK'?'selected':'' ?> >GK</option>
            </select>

            <label for="price">Price (£m):</label>
            <input class="form-control mb-2" type="number" name="price" step="0.1" value="<?= $player['price'] ?>" required>

            <label for="points">Points for the current gameweek:</label>
            <input class="form-control mb-2" type="number" name="points" value="<?= $player['points'] ?>" required>

            <label for="totalPoints">Total Points:</label>
            <input class="form-control mb-2" type="number" name="totalPoints" value="<?= $player['total_points'] ?>" required>

            <label for="fk_team">Team:</label>
            <select class="form-control mb-3" name="fk_team" required>
                <?php
                    $query = "SELECT team_id, team_name FROM teams ORDER BY team_name";
                    $result = mysqli_query($connect, $query);

                    while($teams = mysqli_fetch_assoc($result)) {
                        $selected = ($teams['team_id'] == $player['fk_team']) ? "selected" : "";
                        echo "<option value='{$teams['team_id']}' $selected>{$teams['team_id']}. {$teams['team_name']}</option>";
                    }
                ?>
            </select>

            <button class="btn btn-primary" type="submit">Update Player</button>
        </form>
        
    </body>
    </html>