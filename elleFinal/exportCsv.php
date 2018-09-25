   <?php
session_start();
include 'connect.php';

if (isset($_POST['submit']) && isset($_POST['check_list'])) {
    foreach($_POST['check_list'] as $test){
    $sql = "SELECT * FROM UserAnalytics WHERE userID = $test";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysqli_num_fields($result);
    $headers = array();
    //for ($i = 0; $i < $num_fields; $i++) {
        //$headers[] = mysqli_fetch_field_direct($result , $i)->name;
    array_push($headers, "Correct", "Incorrect", "userID", "username", "Total Cor.", "Total Inc.");
    $fp = fopen('php://output', 'w');
    if ($fp && $result) {
        $row = $result->fetch_array(MYSQLI_NUM);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="log.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
        fputcsv($fp, $headers);
        $newArray = array("","", $row[0], $row[1], $row[5], $row[6]);
        fputcsv($fp, $newArray);
        //$newArray2 = array();

    $exploded = explode(": ", $row[3]);
    $imploded = implode("", $exploded);
    $exploded2 = explode(": ", $row[4]);
    $imploded2 = implode("", $exploded2);
    //$token = strtok($row[4], ": ");
    $token = preg_split('/(?=[A-Z])/',$imploded);
    $token2 = preg_split('/(?=[A-Z])/',$imploded2);
    $length = sizeof($token);
    $length2 = sizeof($token2);
    $i = 0;
    while ($i < $length || $i < $length2)
    {
        $newArray2 = array();
        if($i < $length && $i < $length2)
        {
            array_push($newArray2, $token[$i],$token2[$i]);
        }
        elseif($i < $length)
        {
            array_push($newArray2, $token[$i]);
        }
        elseif($i < $length2)
        {
            array_push($newArray2, "", $token2[$i]);
        }
        $i++;
        fputcsv($fp, $newArray2);
    }
    }
       // while ($row = $result->fetch_array(MYSQLI_NUM)) {
       //     for($i = 0; $i < 3; $i++){
       //         fputcsv($fp, $
       //     }
       //}
    die;


    }
}
