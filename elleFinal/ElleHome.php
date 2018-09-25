<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #dddddd;
}

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
.active{
background color: blue;
}

li a:hover {
    background-color: gray;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" href="ElleHome.html">Home</a></li>
  <li><a href="UserLog.php">Search user logs</a></li>
  <li><a href="LangPack.html">Language Packs</a></li>
  <li><a href="ViewAssets.html">View Assets</a></li>
  <li><a href="Admin.php">Approve Admins</a></li>
  <li><a href="Settings.html">Settings </a></li>
</ul>


<?php
        if(isset($_SESSION["username"])){
	echo '<p>Hello ' . $_SESSION["username"] . ', you are logged in.</p>
	<form action="logout.php" method="post">
        <button type="submit" name="submit">Logout</button>      
        </form>';
        }    
	else{
	echo "I have no idea why this isn't working.";


	}
?>

</body>
</html>
