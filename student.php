<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
</head>
<body>
	<h1>Student Registration Form</h1>
	<form method="post" action="process.php">
		<label>Name:</label>
		<input type="text" name="name"><br><br>
		<label>Email:</label>
		<input type="email" name="email"><br><br>
		<label>Phone Number:</label>
		<input type="text" name="phone"><br><br>
		<label>Gender:</label>
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="female">Female<br><br>
		<label>Course:</label>
		<select name="course">
			<option value="computer_science">Computer Science</option>
			<option value="business_administration">Business Administration</option>
			<option value="engineering">Engineering</option>
			<option value="humanities">Humanities</option>
		</select><br><br>
		<input type="submit" value="Register">
	</form>
</body>
</html>
<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Collect form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];
	$course = $_POST['course'];

	// Validate form data
	$errors = [];
	if (empty($name)) {
		$errors[] = 'Name is required';
	}
	if (empty($email)) {
		$errors[] = 'Email is required';
	}
	if (empty($phone)) {
		$errors[] = 'Phone number is required';
	}
	if (empty($gender)) {
		$errors[] = 'Gender is required';
	}
	if (empty($course)) {
		$errors[] = 'Course is required';
	}

	// If there are no errors, save the data to the database
	if (empty($errors)) {
		// Connect to the database
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'students';
		$conn = mysqli_connect($host, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
			die('Connection failed: ' . mysqli_connect_error());
		}

		// Save data to the database
		$sql = "INSERT INTO student (name, email, phone, gender, course) VALUES ('$name', '$email', '$phone', '$gender', '$course')";
		if (mysqli_query($conn, $sql)) {
			echo 'Registration successful!';
		} else {
			echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
		}

		// Close connection
		mysqli_close($conn);
	} else {
		// If there are errors, display them to the user
		echo '<ul>';
		foreach ($errors as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</ul>';
	}
}
?>

