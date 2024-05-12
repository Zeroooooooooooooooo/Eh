<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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

$sql = "SELECT firstname, lastname, email FROM users";
$result = $conn->query($sql);

// Close the connection after fetching data
$conn->close();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinuteMeetUp | Dashboard</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="other.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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
                <h1 style="text-align: center; color: rgba(53, 56, 57); font-family: cursive; margin-top: -40px;">Minute
                    Burger</h1>
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
                        <img src="img/admin.png" style="width: 30px; height: 30px;">
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

    <!-- Main content -->
    <div class="content">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                      echo "<tr><td>" . $row["firstname"]. "</td><td>" . $row["lastname"]. "</td><td>" . $row["email"]. "</td></tr>";
                                    }
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>