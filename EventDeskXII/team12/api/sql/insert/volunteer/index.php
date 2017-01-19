<?php 
	session_start();
	$addUserRequest = json_decode(file_get_contents('php://input'));
	$query = '';
	if($_SESSION['state'] === 'user'){
		$userName = $_SESSION['userName'];
		$query = "INSERT INTO VOLUNTEER_FOR VALUES('$addUserRequest->Eid','$userName') ";
	}
	$servername = 'earth.cs.utep.edu';
	$username = "cs4342team12fa16";
	$password = "yottadata_12";
	$dbname = "cs4342team12fa16";
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "$query";

	if ($conn->query($sql) === TRUE) {
	    echo "insert-success";
	} else {
	    echo "insert-server-error-".$_SESSION['userName'];
	}
	$conn->close();
?>