<?php
session_start();
$dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "unfucf478";
    $dbName = "Mobile";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
error_reporting(E_ALL);
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST['upload'])){
	

header("Location: /editPack.php?term=successful");
   exit();
}
else if(isset($_POST['submit'])){
   

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
    // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        $test = $_FILES["fileToUpload"]["tmp_name"];
	echo $test;
    }
}

   //$langPack = mysqli_real_escape_string($conn, $_SESSION['langPack']);
   //$term = mysqli_real_escape_string($conn, $_POST['term']);
   //$engTerm = mysqli_real_escape_string($conn, $_POST['engTerm']);
   //$tag = mysqli_real_escape_string($conn, $_POST['tag']);
   //$definition = mysqli_real_escape_string($conn, $_POST['definition']);
   //$sql = "INSERT INTO Terms (term, englishTerm, partOfSpeech, definition, languagePack) VALUES ('$term', '$engTerm', '$tag', '$definition', '$langPack')";
   //mysqli_query($conn, $sql);
   //header("Location: /editPack.php?term=successful");
   //exit();
}
else{
echo "This is not happening!";
}

?>
