<?php
$conn = new mysqli("localhost","root","","tes-davinti");

if($conn->connect_error){
	die("Error koneksi:".$conn->connect_error);
}


$username = $_POST['username'];
$password = $_POST['password'];

$md5pass = md5($password);

$sql = "SELECT * FROM user WHERE username = '$username' and password = '$md5pass'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo json_encode(array("status" => "sukses", "pesan" => "Login Success<br>You're logged in as ".$username." (Password: ". $md5pass.")"));
	return;
} else {
	echo json_encode(array("status" => "salah", "pesan" => "Login Failed!<br>Your username is ".$username." and Password: ". $md5pass.")"));
	return;
}

$conn->close();

?>