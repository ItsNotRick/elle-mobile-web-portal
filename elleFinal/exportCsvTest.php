   <?php
session_start();
include 'connect.php';

if (isset($_POST['submit']) && isset($_POST['check_list'])) {
	/*$query = "SELECT * FROM UserAnalytics";
	$result = mysqli_query($conn, $query);
	if (!$result) die('Couldn\'t fetch records');
	$rows = mysqli_num_rows($result);

    $row = mysqli_fetch_array($result);
    //MYSQLI_NUM
    for($i = 0; $i < 32; $i++)
        {
            echo $row[$i];
            echo " ";
        }
    */
    $check = mysqli_real_escape_string($conn, $_POST['check_list'][0]);
    //echo $check;
    $result = $conn->query("SELECT * FROM UserAnalytics WHERE userID = $check");
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysqli_num_fields($result);
    for ($i = 0; $i < $num_fields; $i++) {
        $headers[] = mysqli_fetch_field_direct($result , $i)->name;
    }
    $row = $result->fetch_array(MYSQLI_NUM);

    for($i = 0; $i < 32 && $row; $i++)
        {
            echo $row[$i];
            echo " ";
        }
    $token = strtok($row[3], ": ");

    while ($token !== false)
    {
    echo "$token<br>";
    $token = strtok(": ");
    }

    //array_push($headers, "selection", "correct", "incorrect", "userID", "date");

}
