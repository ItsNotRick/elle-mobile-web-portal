<?php
session_start(); 
include 'connect.php';

            
	    if (isset($_POST['delete'])) {
		$id = $_POST['delete'];
                $sql = "DELETE FROM Terms WHERE id = '$id'";
                mysqli_query($conn, $sql);
            }
            
            header("Location: ../editPack.php");
            exit();
         
		
