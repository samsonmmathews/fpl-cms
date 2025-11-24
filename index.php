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

    <link rel="stylesheet" href="stylesheet/styles.css">
</head>

<body class="container mt-4">

    

    <?php include('nav.php'); ?>

    <div>
        <nav class="p-2 bg-transparent border-bottom border-light">
            <div class="d-flex justify-content-between flex-wrap">
                <!-- Buttons in the navbar -->
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Matches</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Table</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Statistic</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Fantasy</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">News</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Injuries</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Players</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Clubs</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">Video</button>
                <button type="button" class="btn btn-outline-light flex-fill me-2 mb-2">More</button>




            </div>
        </nav>
    </div>;


    <!-- <h1 class="text-center mb-4">Fantasy Premier League Database</h1> -->

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
        // echo '<div class="table-responsive">';
        // echo "<table class='table table-striped table-bordered table-sm align-middle text-center'>";
        // echo '<thead class="table-dark">
        //         <tr>
        //             <th>Full Name</th>
        //             <th>Position</th>
        //             <th>Price</th>
        //             <th>Points</th>
        //             <th>Total Points</th>
        //             <th>Team Name</th>
        //             <th>Manager Name</th>
        //             <th>Home Stadium</th>
        //         </tr>
        //     </thead>';

        // echo '<tbody>';

        // while ($row = mysqli_fetch_assoc($result)) {
        //     echo "<tr>";
        //     echo "<td>" . $row['full_name'] . "</td>";
        //     echo "<td>" . $row['position'] . "</td>";
        //     echo "<td>£" . number_format($row['price'], 1) . "m</td>";
        //     echo "<td>" . $row['points'] . "</td>";
        //     echo "<td>" . $row['total_points'] . "</td>";
        //     echo "<td>" . $row['team_name'] . "</td>";
        //     echo "<td>" . $row['manager_name'] . "</td>";
        //     echo "<td>" . $row['stadium'] . "</td>";
        //     echo "</tr>";
        // }
        // echo "</tbody>";
        // echo "</table>";
        // echo "</div>";
    } else {
        echo "<div class='alert alert-warning text-center'>No players found.</div>";
    }

    //Kadelle's Code

  echo '<div class="cardContainer">';

  echo '<img id="headerImg" src="img/websiteHeader.png"/></img>';


if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo '
        <div class="outerCard">
            <div class="card">
                <div class="position">
                    <div>
                        <h3>£' . number_format($row['price'], 1) . 'm</h3>
                    </div>
                    <div>
                        <h2><u>' . $row['position'] . '</u></h2>      
                    </div>
                </div>
                <div class=playerName>
                    <h3>' . $row['full_name'] . '</h3>
                </div>
                <div class=pointContainer>
                    <div class="infoCol">
                        <p><u> Total Points </u></p>
                        <h3>' . $row['total_points'] . '</h3>
                    </div>
                    <div class="infoCol">
                        <p><u> Points </u></p>
                        <h3>' . $row['points'] . '</h3>
                    </div>
                </div>
                <div class="teamInfo">
                    <div class="teamName">
                        <p><u><b> Team </b></u></p>
                    <h3>' . $row['team_name'] . '</h3>
                    </div>
                    <div class="clubInfo">
                        <div class="clubInfoCol">
                            <p><u><b> Manager Name </b></u></p>
                            <h4 class="hiddenText">' . $row['manager_name'] . ' </h4>
                        </div>
                        <div class="clubInfoCol">
                            <p><u><b> Stadium </b></u></p>
                            <h4 class="hiddenText">' . $row['stadium'] . ' </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
}
else
{
    echo "<div class='alert alert-warning text-center'>No players found.</div>";
}

echo "</div>";

    mysqli_close($connect);
    ?>

    <div class="footerBtnCont">
        <div>
            <ul class="footerButtons">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Matches</a></li>
                <li><a href="#">Table</a></li>
                <li><a href="#">Statistic</a></li>
                <li><a href="#">Fantasy</a></li>
            </ul>
        </div>

        <div id="imgBg">
            <a href="index.php"><img id="premierLogo" src="img/Premier_League_Logo.png"></a>
        </div>

        <div>
            <ul class="footerButtons">
                <li><a href="#">News</a></li>
                <li><a href="#">Injuries</a></li>
                <li><a href="#">Players</a></li>
                <li><a href="#">Clubs</a></li>
                <li><a href="#">Videos</a></li>


            </ul>
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; Group 3 | HTTP-5225</p>
    </footer>

    <style>
        /* body {
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
        } */
    </style>

</body>

</html>