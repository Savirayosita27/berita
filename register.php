<?php

	require "connection.php";

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$response = array();
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$username = $_POST['username'];

		$cek = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_fetch_array(mysqli_query($con, $cek));

		if (isset($result)) {
		 	$response['value']=2;
			$response['message']="Email telah digunakan";
			echo json_encode($response);
		 } else {
		 	$insert = "INSERT INTO users VALUE(NULL, '$email', '$password', '1', '$username', '1', NOW())";
			if (mysqli_query($con, $insert)) {
				$response['value']=1;
				$response['message']="Berhasil didaftarkan";
				echo json_encode($response);
			} else {
				$response['value']=0;
				$response['message']="Gagal didaftarkan";
				echo json_encode($response);
			}
		 }
		  
		
	}

?>