﻿<?php
session_start();
include 'connect.php';

?>
 <!DOCTYPE html>
<html>
<head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)}
    to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
    from {transform: scale(0)}
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
</head>
<body>
<center>
<h2>Modify Language pack</h2>
<p><a href= "LangPack.html"> Return to Language Menu </a> </p> </center>

<label for="uname"><b>Search</b></label>
      <input type="text"  name="uname" required>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Create Term</button>

<form action="editTerm.php" method="post">
<table>
  <tr>
    <th>Term Name</th>
    <th>Translation</th>
    <th>Tag</th>
    <th>Definition</th>
    <th>Image</th>
    <th>Edit?</th>
    <th>Delete?</th>

  </tr>
  <?php
   if(isset($_SESSION['langPack'])){
	$langPack = mysqli_real_escape_string($conn, $_SESSION['langPack']);
	$query = "SELECT * FROM Terms WHERE languagePack = '$langPack' ";
	$result = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($result);
	if ($rows){
		while ($row = mysqli_fetch_array($result)){
			echo '<tr><td>';
			echo '' .$row['term'] . '';
			echo '</td><td>';
			echo '' .$row['englishTerm'] . '';
			echo '</td><td>';
			echo '' .$row['partOfSpeech'] . '';
			echo '</td><td>';
			echo '  ' .$row['definition'] . '';
			echo '</td><td>';
            echo '</td><td>';
			echo '<button type="submit" name="edit" value="' .$row['term'] . '" style="width:auto; background-color:orange">Edit</button>';
                        echo '</td><td>';
                        echo '<button type="submit" name="delete" value="' .$row['term'] . '" style="width:auto; background-color:red">Delete</button>';
			echo '</td></tr>';

		}
	}




   }
  ?>
</table>
</form>
<div id="id01" class="modal">

  <form class="modal-content animate" action="createTerm.php" method="POST" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

    </div>

    <div class="container">
      <h1>Create a Term</h1>
      <label for="term"><b>Term Name</b></label>
      <input type="text"  name="term">

      <label for="engTerm"><b>Translation</b></label>
      <input type="text" name="engTerm">

      <label for="tag"><b>Term Tag</b></label>
      <input type="text" name="tag">

      <label for="definition"><b>Definition</b></label>
      <input type="text"  name="definition">

      <label for="image"><b>Image</b></label> <br><br>
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="upload" name="upload ">

      <label for="uname"><b>Term Audio</b></label> <br><br>

      <label for="uname"><b>Translation Audio</b></label> <br><br>

      <button type="submit" name="submit" value="submit">Add Term</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>