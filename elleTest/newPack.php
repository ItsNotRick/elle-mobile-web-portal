<?php

if(isset($_POST['submit'])){
    session_start();

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "unfucf478";
    $dbName = "Mobile";

   $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $langPack = mysqli_real_escape_string($conn, $_POST['langPack']);

    //error handlers.
    //check for empty fields
    if(empty($langPack)){
        header("Location: /LangPack.html?newPack=empty");
        exit();
    }
    else{
        //check if input characters are valid
        if(!preg_match("/^[a-zA-Z \s]+$/", $langPack)){
        header("Location: /LangPack.html?newPack=invalid");
        exit();
        }
            else{
		$_SESSION['langPack'] = $_POST['langPack'];
                header("Location: /editPack.php");
		exit();
                }
    }
}
else{
    header("Location: /LangPack.html");
    exit();
}
?>
