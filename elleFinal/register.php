<?php


    
    include 'connect.php';
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $refAdmin = mysqli_real_escape_string($conn, $_POST['refAdmin']);
    
    //error handlers.
    //check for empty fields
    if(empty($username) || empty($email) || empty($password)){
        header("Location: ../index.php?signup=empty");
        exit();
    }
    else{
        //check if input characters are valid
        if(!preg_match("/^[a-zA-Z \s]+$/", $username)){ 
        header("Location: ../index.php?signup=invalid");
        exit();
        }
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../index.php?signup=bademail");
            exit();     
            }
            else{
                $sql = "SELECT * FROM Users WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
            
                if($resultCheck > 0){
                 header("Location: ../index.php?signup=usertaken");
                 exit();    
                }
                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    //Insert into db
                    $sql = "INSERT INTO Users (username, email, password) VALUES ('$username','$email','$password');";
                    mysqli_query($conn, $sql);
                    header("Location: ../index.php?signup=success");
                    exit();   
                    
                }
            }
        }
    }
