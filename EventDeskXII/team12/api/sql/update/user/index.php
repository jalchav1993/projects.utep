<?php	
	session_start();
	$modifyEventRequest = json_decode(file_get_contents('php://input'));
	$modifyEvent = '';
	$user = $modifyEventRequest->user;
	$userSelect = $user->userType;
	$timeSlots = $user->timeSlots;
	$modified = $_SESSION['userName'];
	if($_SESSION['state']==='admin'&&$modifyEventRequest->request==='updateById'){
		if($userSelect === 'student'){
			$modifyEvent = "UPDATE STUDENT SET Sfirst_name = '$user->firstName', 
											Smiddle_initial = '$user->middleInit', 
											Slast_name = '$user->lastName',
											Spassword = '$user->userPass' ,
											Sphone = '$user->telephone',
											Sevent_preference = '$user->eventPreference',
											Sstudent_classification = '$user->studentClass'
											WHERE Semail = '$user->userName'";
		}else if($userSelect === 'guest'){
			$modifyEvent = "UPDATE COMMUNITY_USER SET  
											Cfirst_name = '$user->firstName', 
											Cmiddle_initial = '$user->middleInit', 
											Clast_name = '$user->lastName',
											Cpassword = '$user->userPass',
											Cphone = '$user->telephone' 
											WHERE Cemail = '$user->userName'";
		}else if($userSelect === 'admin'){
			$modifyEvent = "UPDATE FACULTY SET  
											Ffirst_name = '$user->firstName', 
											Fmiddle_initial = '$user->middleInit', 
											Flast_name = '$user->lastName',
											Fpassword = '$user->userPass' ,
											Fphone = '$user->telephone'
											WHERE Femail = '$user->userName'";
		}
		
		
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

	$sql = $modifyEvent;

	if ($conn->query($sql) === TRUE) {
		echo "update-user-request-accepted";
	} else {
	    echo "update-user-request-denied-" . $conn->error.' '.var_dump($modifyEventRequest).' '.var_dump($modifyEvent);
	}
	$conn->close();
?>