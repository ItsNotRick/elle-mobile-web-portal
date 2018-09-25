 <?php
session_start();
$dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "unfucf478";
    $dbName = "Mobile";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (isset($_POST['submit'])) {
    $result = $conn->query('SELECT * FROM `LogData`');
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysqli_num_fields($result);
    $headers = array();
    for ($i = 0; $i < $num_fields; $i++) {
        $headers[] = mysqli_fetch_field_direct($result , $i)->name;
    }
    $fp = fopen('php://output', 'w');
    if ($fp && $result) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
        fputcsv($fp, $headers);
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            fputcsv($fp, array_values($row));
       }
        die;
    }
}
