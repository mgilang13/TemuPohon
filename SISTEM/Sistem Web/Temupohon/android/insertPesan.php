<?php

if($_SERVER["REQUEST_METHOD"]== "POST") {

$host="localhost"; // Host name

$username="u320921785_gil"; // Mysql username

$password="s7622126"; // Mysql password

$db_name="u320921785_tp"; // Database name

// Connect to server and select database.

$conn = mysqli_connect("$host", "$username", "$password", "$db_name")or die("Couldn't connect to MySQL Server, please check your configuration files.");

//mysql_select_db("$db_name")or die("Connection to MySQL Server has been successfull, but we couldn't load the database. Please check your configuration files.");



	global $conn;



	$id_pesan = generateRandomString();

	$isi_pesan = $_POST["isi_pesan"];

	$email = $_POST['email'];

	$nama = $_POST['nama'];



	$q = "INSERT INTO masukanpengunjung(id_pesan, isi_pesan, email_pengunjung, nama_pengunjung) values ('$id_pesan', '$isi_pesan', '$email', '$nama');";



	mysqli_query($conn,$q) or die(mysql_error($conn));

	mysqli_close($conn);



}



function createMessage() {

	global $conn;



	$id_pesan = generateRandomString();

	$isi_pesan = $_POST["isi_pesan"];

	$email = $_POST['email'];

	$nama = $_POST['nama'];



	$q = "INSERT INTO masukanpengunjung(id_pesan, isi_pesan, email_pengunjung, nama_pengunjung) values ('$id_pesan', '$isi_pesan', '$email', '$nama');";



	mysqli_query($conn,$q) or die(mysql_error($conn));

	mysqli_close($conn);



}



function generateRandomString($length = 10) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $charactersLength = strlen($characters);

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];

    }

    return $randomString;

}



?>