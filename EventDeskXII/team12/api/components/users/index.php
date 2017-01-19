<?php
class User{
  public $userType;
  public $userName;
  public $firstName;
	public $middleInit;
  public $lastName;
	public $userPass;
	public $telephone;
	public $eventPreference;
	public $userClass;
	public function __construct($userType,$userName,$firstName,$middleInit,$lastName,$userPass,$telephone,$eventPreference,$userClass){
	 	$this->userType= $userType;
	 	$this->userName=$userName;
	 	$this->firstName=$firstName;
		$this->middleInit=$middleInit;
	  $this->lastName=$lastName;
		$this->userPass=$userPass;
		$this->telephone=$telephone;
		$this->eventPreference=$eventPreference;
		$this->userClass=$userClass;
	}
}
$allUsers = array();
$student = 'STUDENT';
$admin = 'FACULTY';
$guest = 'COMMUNITY_USER';
$studentUsers = "SELECT * FROM $student";
$adminUsers = "SELECT * FROM $admin";
$guestUsers = "SELECT * FROM $guest";
$servername = 'earth.cs.utep.edu';
$username = "cs4342team12fa16";
$password = "yottadata_12";
$dbname = "cs4342team12fa16";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "$adminUsers";
$result = $conn->query($sql);
$index = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			$allUsers[$index]= new User('admin',$row['Femail'],$row['Ffirst_name'],
			$row['Fmiddle_initial'],$row['Flast_name'],$row['Fpassword'],
			$row['Fphone'],null, null);
			$index++;
    }
} else {
    echo "select-empty-results";
}
$sql = "$guestUsers";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			$allUsers[$index]= new User('guest',$row['Cemail'],$row['Cfirst_name'],
			$row['Cmiddle_initial'],$row['Clast_name'],$row['Cpassword'],
			$row['Cphone'], null, null);
			$index++;
    }
} else {
    echo "select-empty-results";
}
$sql = "$studentUsers";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			$allUsers[$index]= new User('student',$row['Semail'],$row['Sfirst_name'],
			$row['Smiddle_initial'],$row['Slast_name'],$row['Spassword'],
			$row['Sphone'],$row['Seevent_preference'],$row['Sstudent_classification']);
			$index++;
    }
} else {
    echo "select-empty-results";
}
$conn->close();
print(json_encode($allUsers));
?>