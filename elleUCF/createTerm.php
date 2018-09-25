<?php
session_start();
if(isset($_POST['submit'])){

    $servername = "localhost";
    $server_username = "elle";
    $server_password = "mobile";
    $dbName = "ELLE_Mobile";

    $conn = mysqli_connect($servername, $server_username, $server_password, $dbName);

   $langPack = mysqli_real_escape_string($conn, $_SESSION['langPack']);
   $term = mysqli_real_escape_string($conn, $_POST['term']);
   $engTerm = mysqli_real_escape_string($conn, $_POST['engTerm']);
   $tag = mysqli_real_escape_string($conn, $_POST['tag']);
   $definition = mysqli_real_escape_string($conn, $_POST['definition']);
   $sql = "INSERT INTO Terms (term, englishTerm, partOfSpeech, definition, languagePack) VALUES ('$term', '$engTerm', '$tag', '$definition', '$langPack')";
   mysqli_query($conn, $sql);
   header("Location: /editPack.html?term=successful");
   exit();
}
else{
echo "This is not happening!";
}

?>
