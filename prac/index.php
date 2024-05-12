<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to get the count of users
$result = $conn->query("SELECT COUNT(*) AS count FROM users");
$row = $result->fetch_assoc();
$user_count = $row['count'];

$result = $conn->query("SELECT COUNT(*) AS count FROM personnel");
$row = $result->fetch_assoc();
$personnel_count = $row['count'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="other.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <title>MinuteMeetUp | Dashboard</title>

</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid">
        <div class="row">
            <header class="banner">
                <h1 style="font-family: cursive;">Minute Burger</h1>
            </header>
            <div class="sidebar">
                <div class="logo-details">
                    <img src="img/Minutelogo.png"
                        style="height: 120px; width: 120px; margin-left: 50px; margin-top: -120px;">
                </div>
                <h1 style="text-align: center; color: rgba(53, 56, 57); font-family: cursive; margin-top: -40px;">
                    Minute Burger</h1>
                <h6 class="menu-title" style="color: rgba(53, 56, 57); margin-left: 25px;">Menu</h6>
                <ul class="nav-links">
                    <li><a href="index.php"><i class="fas fa-home"></i><span class="links_name">Dashboard</span></a>
                    </li>
                    <li><a href="user.php"><i class="fas fa-user"></i><span class="links_name">User</span></a></li>
                    <li><a href="staff.php"><i class="fas fa-user-tie"></i><span class="links_name">Staff</span></a>
                    </li>
                </ul>
                <div class="side-content mt-5">
                    <div class="profile">
                        <img src="img/admin.png" style="width: 50px; height: 50px;">
                        <h3>Nilo Garciano Jr.</h3>
                        <p style="color: rgba(53, 56, 57); font-size: xx-small; margin-left:75px;">Administrator</p>
                        <div class="button-container">
                            <a href="../login.html">
                                <button class="btn btn-danger logout-btn">Logout</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">
                                    <?php echo $user_count; ?>
                                </h3>
                                <h6 class="text-muted">Total User</h6>
                            </div>
                            <div>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                            <h3 class="card_widget_header">
                                    <?php echo $personnel_count; ?>
                                </h3>
                                <h6 class="text-muted">Total Staff</h6>
                            </div>
                            <div>
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">4.6</h3>
                                <h6 class="text-muted">Average Rating</h6>
                            </div>
                            <div>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h4 class="card-title float-left mt-2">Rated Recently</h4>
                        <button type="button" class="btn btn-primary float-right veiwbutton">Veiw All</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>