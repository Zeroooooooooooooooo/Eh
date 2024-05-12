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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fname']) && !empty($_POST['fname'])) {
// Insert staff
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["fname"];
  $lastName = $_POST["lname"];
  $username = $_POST["uname"];
  $email = $_POST["mail"];
  $password = $_POST["pass"];
  $date = $_POST["jdate"];
  $phone = $_POST["phone"];
  $role = $_POST["sel1"];

  $sql = "INSERT INTO personnel (firstname, lastname, username, email, password, joining_date, phone_number, role)
  VALUES ('$firstName', '$lastName', '$username', '$email', '$password', '$date', '$phone', '$role')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

header("Location: staff.php");
  exit();

}

// Fetch and display data
$sql = "SELECT id, firstname, lastname, email, role FROM personnel";
$result = $conn->query($sql);

// Check the request method and Handle GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
  // Check if staffId is set and is not empty
  if (isset($_GET['staffId']) && !empty($_GET['staffId'])) {
    $staffId = $_GET['staffId'];
    
    // Fetch the staff data from the database
    $sql = "SELECT * FROM personnel WHERE id = $staffId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // Output data of the first (and only) row
      echo json_encode($result->fetch_assoc());
    } else {
      echo "No results";
    }
  }
} if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['staffId'])) {
  $staffId = $_POST['staffId'];
  $deleteSql = "DELETE FROM personnel WHERE id = $staffId";
  if ($conn->query($deleteSql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error: " . $conn->error;
  }
}

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
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
					<h4 class="card-title">Staff Table</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped mb-0" id="staffTable">
							<thead>
								<tr>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Email</th>
									<th>Role</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
              				if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								  echo "<tr data-staff-id='".$row["id"]."'><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["role"]."</td>";
								  echo "<td><button class='btn btn-primary' onclick='viewStaff(this)'><i class='bx bx-low-vision' ></i></button> <button class='btn btn-danger' onclick='deleteStaff(this)'><i class='bx bxs-trash'></i></button></td></tr>";
								}
							  }																		  
              			?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div style="margin-top: 10px;" id="liveAlert"></div>

		<div class="page-wrapper">
			<div class="cont container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Add Personnel</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form method="POST">
							<div class="row formtype">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input class="form-control" id="fname" name="fname" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input class="form-control" id="lname" name="lname" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>User Name</label>
										<input class="form-control" id="uname" name="uname" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email ID</label>
										<input class="form-control" id="mail" name="mail" type="email">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input class="form-control" id="pass" name="pass" type="password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Confirm Password</label>
										<input class="form-control" id="cpass" name="pass" type="password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Joining Date</label>
										<div class="cal-icon">
											<input class="form-control" id="jdate" name="jdate" type="date">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone Number</label>
										<input class="form-control" id="phone" name="phone" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Role</label>
										<select class="form-control" id="sel1" name="sel1">
											<option>Select</option>
											<option>Admin</option>
											<option>Manager</option>
											<option>Staff</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<button type="button" class="btn btn-primary buttonedit ml-2" style="margin-top: 10px;"
					onclick="addStaff()">Add Personnel</button>
			</div>
		</div>
	</div>

	<script>
		var staffId = 1; // Initialize staff ID
		var staffList = []; // Initialize staff list

		function addStaff() {
			// Get the values from the form
			var firstName = document.getElementById("fname").value;
			var lastName = document.getElementById("lname").value;
			var username = document.getElementById("uname").value;
			var email = document.getElementById("mail").value;
			var password = document.getElementById("pass").value;
			var confirmPassword = document.getElementById("cpass").value;
			var date = document.getElementById("jdate").value;
			var phone = document.getElementById("phone").value;
			var role = document.getElementById("sel1").value;

			// Check that all fields are filled
			if (
				!firstName ||
				!lastName ||
				!username ||
				!email ||
				!password ||
				!confirmPassword ||
				!date ||
				!phone ||
				!role
			) {
				document.getElementById("liveAlert").innerHTML =
					'<div class="alert alert-danger" role="alert">Please fill all fields!</div>';
				return;
			}

			// Check that password and confirm password match
			if (password !== confirmPassword) {
				document.getElementById("liveAlert").innerHTML =
					'<div class="alert alert-danger" role="alert">Password and Confirm Password do not match.</div>';
				return;
			}


			// Check if username, email or phone number already exists
			for (var i = 0; i < staffList.length; i++) {
				if (
					staffList[i].username === username ||
					staffList[i].email === email ||
					staffList[i].phone === phone
				) {
					document.getElementById("liveAlert").innerHTML =
						'<div class="alert alert-danger" role="alert">Username, Email or Phone Number already existed.</div>';
					return;
				}
			}

			// Get the table by its id
			var table = document.getElementById("staffTable");

			// Create a new row
			var row = table.insertRow(-1);

			// Generate automatic staff ID and store it in the row's data attribute
			row.dataset.staffId = "STF-" + staffId++;

			// Add the new staff to the staff list
			staffList.push({ username: username, email: email, phone: phone });

			document.getElementById("liveAlert").innerHTML =
				'<div class="alert alert-success" role="alert">Personnel added successfully.</div>';

			document.querySelector('form').submit();
		}

		function viewStaff(btn) {
			// Get the row that the button is in
			var row = btn.parentNode.parentNode;

			// Get the staff ID from the row's data attribute
			var staffId = row.dataset.staffId;

			// Send an AJAX request to viewStaff.php
			fetch("viewStaff.php?staffId=" + staffId)
				.then((response) => response.json())
				.then((data) => {
					// Display the values
					alert(
						"Staff ID: " +
						data.staffid +
						"\nFirst Name: " +
						data.firstname +
						"\nLast Name: " +
						data.lastname +
						"\nUsername: " +
						data.username +
						"\nEmail: " +
						data.email +
						"\nRole: " +
						data.role +
						"\nPhone Number: " +
						data.phone_number +
						"\nJoining Data: " +
						data.joining_date
					);
				})
				.catch((error) => {
					console.error("Error:", error);
				});
		}

		function deleteStaff(btn) {
			// Get the row that the button is in
			var row = btn.parentNode.parentNode;

			// Confirm before deleting
			if (confirm("Are you sure you want to delete this staff?")) {
				// Get the staff ID from the row's data attribute
				var staffId = row.dataset.staffId;

				// Send an AJAX request to deleteStaff.php
				fetch("staff.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded",
					},
					body: new URLSearchParams({
						staffId: staffId,
					}),
				})
					.then((response) => response.text())
					.then((data) => {
						// Remove the row from the table
						row.parentNode.removeChild(row);

						// Show success message
						document.getElementById("liveAlert").innerHTML =
							'<div class="alert alert-success" role="alert">Personnel deleted successfully.</div>';
					})
					.catch((error) => {
						console.error("Error:", error);
					});
			}
		}
	</script>

</body>

</html>