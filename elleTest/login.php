<?php

session_start();

if (isset($_POST['submit'])) {
	
	$dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "unfucf478";
    $dbName = "Mobile";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	//Error handlers
	//Check if inputs are empty
	if (empty($username) || empty($password)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM Users WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPwdCheck = password_verify($password, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=error");
					exit();
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['username'] = $row['username'];
					$_SESSION['email'] = $row['email'];
					header("Location: ../ElleHome.php?login=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.html?login=error");
	exit();
}