<?php

session_start();

    $servername = "localhost";
    $server_username = "elle";
    $server_password = "mobile";
    $dbName = "ELLE_Mobile";

    $conn = mysqli_connect($servername, $server_username, $server_password, $dbName);

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //error handlers.
    //check for empty fields
    if(empty($username) || empty($password)){
        header("Location: ../index.php?signup=empty");
        exit();
    }
    
        else{

                $sql = "SELECT * FROM Users WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0){
                 header("Location: ../index.php?signup=usertaken");
                 exit();
                }
                else{
                    //Insert into db
                    $sql = "INSERT INTO Users (username, password) VALUES ('$username','$password');";
                    mysqli_query($conn, $sql);
                    header("Location: ../index.php?signup=success");
                    exit();   

                }
            }

    
?>
