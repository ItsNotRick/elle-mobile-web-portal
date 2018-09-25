<?php
session_start(); 
$dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "unfucf478";
    $dbName = "Mobile";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

            
	    if (isset($_POST['delete'])) {
		$id = $_POST['delete'];
                $sql = "DELETE FROM Terms WHERE id = '$id'";
                mysqli_query($conn, $sql);
            }
            
            header("Location: ../editPack.php");
            exit();
         
		
