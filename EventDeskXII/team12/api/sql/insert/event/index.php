<?php 
	session_start();
	$addEventRequest = json_decode(file_get_contents('php://input'));
	$createEvent = '';
	$linkToFaculty = '';
	if($_SESSION['state']==='admin'){
		$random_id = rand(100000,200000);
		$approved = $_SESSION['userName'];
		$created = $_SESSION['userName'];
		$modified = $_SESSION['userName'];
		$start = $addEventRequest->eventTimeSlot->start;
		$end = $addEventRequest->eventTimeSlot->end;
		$createEvent = "INSERT INTO EVENT VALUES('$random_id',
					'$addEventRequest->eventName',
					'$addEventRequest->eventDescription',
					'$addEventRequest->eventDate',
					'$addEventRequest->eventLocation',
					'$addEventRequest->eventVolunteerCount')";
		$linkToFaculty = "INSERT INTO MANAGE VALUES('$random_id',
					'$approved',
					'$created',
					'$modified')";
		$timeslot = "INSERT INTO TIME_SLOTS VALUES('$random_id', '$start', '$end')";
	} else if($_SESSION['state']==='guest'){
		$random_id = rand(100000,200000);
		$approved = $_SESSION['userName'];
		$created = $_SESSION['userName'];
		$modified = $_SESSION['userName'];
		$start = $addEventRequest->eventTimeSlot->start;
		$end = $addEventRequest->eventTimeSlot->end;
		$createEvent = "INSERT INTO EVENT VALUES('$random_id',
					'$addEventRequest->eventName',
					'$addEventRequest->eventDescription',
					'$addEventRequest->eventDate',
					'$addEventRequest->eventLocation',
					'$addEventRequest->eventVolunteerCount')";
		$linkToFaculty = "INSERT INTO REQUEST VALUES('$random_id', '$created')";
		$timeslot = "INSERT INTO TIME_SLOTS VALUES('$random_id', '$start', '$end')";
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
	$sql = "$createEvent";

	if ($conn->query($sql) === TRUE) {
	} else {
	    echo "insert-server-error-$createEvent";
	}
	$sql = "$linkToFaculty";

	if ($conn->query($sql) === TRUE) {
			//echo "insert-success";
	} else {
	  echo "insert-server-error-$linkToFaculty";
	}
	$sql = "$timeslot";
	if ($conn->query($sql) === TRUE) {
			echo "insert-success";
	} else {
	  echo "insert-server-error-$timeslot";
	}
?>