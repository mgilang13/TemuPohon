<?php

//error_reporting(0);

    //open connection to mysql db
$hostname='localhost'; // Host name

$username="u320921785_gil"; // Mysql username

$password="s7622126"; // Mysql password

$db_name="u320921785_tp"; // Database name

    $connection = mysqli_connect("$hostname","$username","$password","$db_name") or die("Error " . mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "select * from datapohon";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $output = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $output[] = $row;
    }
    echo json_encode($output);

    //close the db connection
    mysqli_close($connection);
?>