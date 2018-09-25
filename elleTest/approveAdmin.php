<?php
session_start(); 
$dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "unfucf478";
    $dbName = "Mobile";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!empty($_POST['check_list'])) {
   foreach($_POST['check_list'] as $check) {
         //might be unnecessary
         $query = "SELECT * FROM Users WHERE id = '$check' ";
	 $result = mysqli_query($conn, $query);
	 $resultCheck = mysqli_num_rows($result);
	 if ($resultCheck < 1) {
		header("Location: ../Admin.php?login=error");
		exit();
	}
	else{
            $row = mysqli_fetch_assoc($result);
	    if (isset($_POST['approve'])) {
                $sql = "UPDATE Users SET approved = 'yes' WHERE id = '$check'";
                mysqli_query($conn, $sql);
            }
            else if (isset($_POST['deny'])) {
                $sql = "UPDATE Users SET approved = 'no' WHERE id = '$check'";
                mysqli_query($conn, $sql);
            }
            header("Location: ../Admin.php");
            exit();
         } 
		
    }
}
