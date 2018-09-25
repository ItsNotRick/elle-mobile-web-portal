<?php

if(isset($_POST['submit'])){
    session_start();

    $servername = "localhost";
    $server_username = "elle";
    $server_password = "mobile";
    $dbName = "ELLE_Mobile";

    $conn = mysqli_connect($servername, $server_username, $server_password, $dbName);

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
                header("Location: /editPack.html");
		exit();
                }
    }
}
else{
    header("Location: /LangPack.html");
    exit();
}
?>
