<?php
	session_start();
	$request = json_decode(file_get_contents('php://input'));
	$admin_id = 'admin';
	$admin_pwd = 'admin1';
	$user_id = 'user';
	$user_pwd = 'user1';
	$response = '';
	$facultyCheck = "SELECT Femail FROM FACULTY
						WHERE Femail='$request->id' AND Fpassword = '$request->pwd'";
	$guestCheck = "SELECT Cemail FROM COMMUNITY_USER
						WHERE Cemail='$request->id' AND Cpassword = '$request->pwd'";
	$studentCheck =	"SELECT Semail FROM STUDENT
							WHERE Semail='$request->id' AND Spassword = '$request->pwd'";
	$servername = 'earth.cs.utep.edu';
	$username = "cs4342team12fa16";
	$password = "yottadata_12";
	$dbname = "cs4342team12fa16";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$flag = '';
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "$facultyCheck";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
				$_SESSION['userName'] = $row['Femail'];
				$_SESSION['state'] = 'admin';
				$flag = 'Femail';
	    }
	}
	$sql = "$guestCheck";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
				$_SESSION['userName'] = $row['Cemail'];
				$_SESSION['state'] = 'guest';
				$flag = 'Cemail';
	    }
	}
	$sql = "$studentCheck";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
				$_SESSION['userName'] = $row['Semail'];
				$_SESSION['state'] = 'user';
				$flag = 'Semail';
	    }
	}
	$conn->close();
	if($_SESSION['state'] === 'admin'||$_SESSION['state'] === 'user'||$_SESSION['state'] === 'guest'){
		$response = 'login-success';
	} else{
		$response = 'login-denied';
	}
	print($response);
	
?>