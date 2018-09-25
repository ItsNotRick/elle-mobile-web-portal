<?php

session_start();

if (isset($_POST['submit'])) {

 include 'connect.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Error handlers
	//Check if inputs are empty
	if (empty($username) || empty($password)) {
		header("Location: /index.php?login=empty/");
		exit();
	} else {
		$sql = "SELECT * FROM Users WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: /index.php?login=noUser");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				if ($password == $row['password']) {
					//Log in the user here
					$_SESSION['username'] = $row['username'];
					header("Location: ../ElleHome.php?login=success");
					exit();
				} else{
					header("Location: ../index.php?login=error");
					exit();
				}
			}
		}
	}
} else {
	header("Location: /index.php?login=notSet/");
	exit();
}
?>
