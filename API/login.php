<?php
session_start();
// Starts a new session or resumes an existing session. This is necessary for managing user sessions.


require_once './conn.php';
// Includes the database connection file.

// Include create_db.php to ensure database and table existence
require_once './create_db.php';


if (isset($_POST['login'])) {
	// Checks if the login form was submitted.

	if ($_POST['username'] != "" || $_POST['password'] != "") {
		// Checks if both the username and password fields are not empty.

		$username = $_POST['username'];
		$password = $_POST['password'];
		// Retrieves the username and password from the form submission.

		$sql = "SELECT * FROM `member` WHERE `username`=? AND `password`=? ";
		// SQL query to select the user from the 'member' table where the username and password match the submitted values.

		$query = $conn->prepare($sql);
		// Prepares the SQL query to prevent SQL injection.

		$query->execute(array($username, $password));
		// Executes the query with the provided username and password.

		$row = $query->rowCount();
		// Counts the number of rows returned by the query. Should be 1 if a match is found.

		$fetch = $query->fetch();
		if ($row > 0) {
			// Checks if a matching user was found.

			$_SESSION['user'] = $fetch['mem_id'];
			// Sets the user session with the member ID.

			header("location: ../frontend/home.php");
			// Redirects to the home page if login is successful.

		} else {
			// If no matching user is found, display an error message and redirect back to the login page.

			echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = '../index.php'</script>
				";
		}
	} else {
		// If either the username or password field is empty, display an error message and redirect back to the login page.

		echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
	}
}
