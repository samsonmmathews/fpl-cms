<!-- Li,pengcheng: Login -->
<?php
session_start();
// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FPL Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="container mt-4">
    <!-- Li,pengcheng: Logout button: Allows the user to end the session and return to the login screen -->
    <div class="text-end mb-3">
        <a class="btn btn-outline-danger btn-sm" href="logout.php">Logout</a>
    </div>

    <h1 class="text-center mb-4">Fantasy Premier League Database</h1>

    <?php
    include 'connect.php';

    $query = "SELECT p.full_name, p.position, p.price, p.points, p.total_points, t.team_name, t.manager_name, t.stadium 
            FROM players p 
            INNER JOIN teams t ON p.fk_team = t.team_id
            ORDER BY p.total_points DESC";

    $result = mysqli_query($connect, $query);

    if(!$result) {
        die('<p style="color:red;">Error: ' . mysqli_error($connect) . '</p');
    }

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="table-responsive">';
        echo "<table class='table table-striped table-bordered table-sm align-middle text-center'>";
        echo '<thead class="table-dark">
                <tr>
                    <th>Full Name</th>
                    <th>Position</th>
                    <th>Price</th>
                    <th>Points</th>
                    <th>Total Points</th>
                    <th>Team Name</th>
                    <th>Manager Name</th>
                    <th>Home Stadium</th>
                </tr>
            </thead>';

        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['position'] . "</td>";
            echo "<td>£" . number_format($row['price'], 1) . "m</td>";
            echo "<td>" . $row['points'] . "</td>";
            echo "<td>" . $row['total_points'] . "</td>";
            echo "<td>" . $row['team_name'] . "</td>";
            echo "<td>" . $row['manager_name'] . "</td>";
            echo "<td>" . $row['stadium'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning text-center'>No players found.</div>";
    }

    mysqli_close($connect);
    ?>

    <footer class="text-center">
        <p>© 2025 Fantasy Premier League Database | Matchweek 7 stats</p>
    </footer>

    <style>
        body {
            background-color: #f8f8f8;
        }
        h1 {
            margin-top: 30px;
            color: #252626ff;
        }
        table {
            background-color: white;
        }
        footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: #252626ff;
            color: #fff;
        }
    </style>

</body>

</html>