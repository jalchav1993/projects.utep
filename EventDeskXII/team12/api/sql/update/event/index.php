<?php	session_start();
	$modifyEventRequest = json_decode(file_get_contents('php://input'));
	$modifyEvent = '';
	$linkToFaculty = '';
	if($_SESSION['state']==='admin'&&$modifyEventRequest->request==='updateById'){
		$modified = $_SESSION['userName'];
		$event = $modifyEventRequest->event;
		$modifyEvent = "UPDATE EVENT SET Ename ='$event->eventName', 
										Edescription = '$event->eventDescription', 
										Ddate = '$event->eventDate', 
										Elocation = '$event->eventLocation',
										Enumber_of_volunteers = '$event->eventVolunteerCount' 
										WHERE Eid = '$event->eventId'";
		$linkToFaculty = "UPDATE MANAGE SET Updated_by = '$modified'";
	} else if($_SESSION['state']==='guest'){
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
	} else {
	    echo "update-event-request-denied-" . $conn->error;
	}
	$conn->close();
?>