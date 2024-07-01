<?php
session_start();

// Include create_db.php to ensure database and table existence
require_once './create_db.php';

require_once './conn.php';

if (isset($_POST['register'])) {
	if ($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['password'] != "") {
		try {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			// md5 encrypted
			// $password = md5($_POST['password']);
			$password = $_POST['password'];
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `member` VALUES ('', '$firstname', '$lastname', '$username', '$password')";
			$conn->exec($sql);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		$_SESSION['message'] = array("text" => "User successfully created.", "alert" => "info");
		$conn = null;
		header('location:../index.html');
	} else {
		echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'registration.html'</script>
			";
	}
}
