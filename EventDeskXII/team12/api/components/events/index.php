<?php
session_start();
class Event{
  public $eventId;
	public $eventName;
	public $eventDescription;
	public $eventDate;
	public $eventLocation;
	public $eventVolunteerCount;
	public $modified_by;
	public $created_by;
	public $updated_by;
	public function __construct($eventId,$eventName,
	$eventDescription,$eventDate,$eventLocation,
	$eventVolunteerCount,$approved_by, $created_by, 
	$updated_by){
	 	$this->eventId=$eventId;
	 	$this->eventName=$eventName;
		$this->eventDescription= $eventDescription;
	  $this->eventDate=$eventDate;
		$this->eventLocation=$eventLocation;
		$this->eventVolunteerCount=$eventVolunteerCount;
	  $this->approved_by=$approved_by;
		$this->created_by=$created_by;
		$this->updated_by=$updated_by;
	}
}
$request = $_GET['request'];
if($_SESSION['state']=== 'admin'){
	$allEvents = array();
	if($request === 'myevents'||$request === 'events'){
		$getEventsByIdQuery ="SELECT *
													FROM EVENT
													INNER JOIN MANAGE
													ON EVENT.Eid=MANAGE.Eid";
	}else if($request === 'requests'){
		$getEventsByIdQuery ="SELECT *
													FROM EVENT
													INNER JOIN REQUEST
													ON EVENT.Eid=REQUEST.Eid";
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
	$sql = "$getEventsByIdQuery";
	$result = $conn->query($sql);
	$index = 0;
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
				$allEvents[$index]= new Event($row['Eid'],$row['Ename'],$row['Edescription'],
																			$row['Ddate'],$row['Elocation'],$row['Enumber_of_volunteers'], $row['Approved_by'],
																			$row['Created_by'],$row['Updated_by']);
				$index++;
	    }
	} else {
	    echo "select-empty-results";
	}

	$conn->close();
	print(json_encode($allEvents));
}else if($_SESSION['state']=== 'guest'||$_SESSION['state']=== 'init'||($_SESSION['state']=== 'user'&&$request==='events')){
	$allEvents = array();
	$getEventsByIdQuery ="SELECT *
												FROM EVENT";
	$servername = 'earth.cs.utep.edu';
	$username = "cs4342team12fa16";
	$password = "yottadata_12";
	$dbname = "cs4342team12fa16";
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "$getEventsByIdQuery";
	$result = $conn->query($sql);
	$index = 0;
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
				$allEvents[$index]= new Event($row['Eid'],$row['Ename'],$row['Edescription'],
																			$row['Ddate'],$row['Elocation'],$row['Enumber_of_volunteers']);
				$index++;
	    }
	} else {
	    echo "select-empty-results";
	}

	$conn->close();
	print(json_encode($allEvents));
}else if($_SESSION['state']=== 'user'&&$request==='myevents'){
	$allEvents = array();
	$userName = $_SESSION['userName'];
	$getEventsByIdQuery ="SELECT *
												FROM EVENT
												INNER JOIN VOLUNTEER_FOR
												ON EVENT.Eid=VOLUNTEER_FOR.Eid";
	$servername = 'earth.cs.utep.edu';
	$username = "cs4342team12fa16";
	$password = "yottadata_12";
	$dbname = "cs4342team12fa16";
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "$getEventsByIdQuery";
	$result = $conn->query($sql);
	$index = 0;
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
				if($row['Semail']===$_SESSION['userName']){
					$allEvents[$index]= new Event($row['Eid'],$row['Ename'],$row['Edescription'],
																			$row['Ddate'],$row['Elocation'],$row['Enumber_of_volunteers']);
																			$index++;
																		}
	    }
	} else {
	    echo "select-empty-results".$_SESSION['userName'];
	}

	$conn->close();
	print(json_encode($allEvents));
}
?>