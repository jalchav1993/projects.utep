<?php 
	session_start();
	$addUserRequest = json_decode(file_get_contents('php://input'));
	$query = '';
	if($addUserRequest->userType === 'user'){
		$table = 'STUDENT';
		$query = "INSERT INTO STUDENT VALUES('$addUserRequest->userName',
					'$addUserRequest->firstName',
					'$addUserRequest->middleInit',
					'$addUserRequest->lastName',
					'$addUserRequest->userPass',
					'$addUserRequest->telephone',
					'$addUserRequest->eventPreference',
					'$addUserRequest->userClass')";
	} else if($addUserRequest->userType === 'admin'){
		$query = "INSERT INTO FACULTY VALUES('$addUserRequest->userName',
					'$addUserRequest->firstName',
					'$addUserRequest->middleInit',
					'$addUserRequest->lastName',
					'$addUserRequest->userPass',
					'$addUserRequest->telephone')";
	}	else if($addUserRequest->userType === 'guest'){
		$query = "INSERT INTO COMMUNITY_USER VALUES('$addUserRequest->userName',
					'$addUserRequest->firstName',
					'$addUserRequest->middleInit',
					'$addUserRequest->lastName',
					'$addUserRequest->userPass',
					'$addUserRequest->telephone')";
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
	    echo "insert-server-error";
	}
	$conn->close();
?>