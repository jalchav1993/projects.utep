<?php
class report{
	public $Eid = '';
	public $Hours = '';
	public function __construct($Eid, $Hours){
		$this->Eid = $Eid;
		$this->Hours = $Hours;
	}
}
$request = "SELECT * FROM TOTAL_EVENT_TIME";
$servername = 'earth.cs.utep.edu';
$username = "cs4342team12fa16";
$password = "yottadata_12";
$dbname = "cs4342team12fa16";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "$request";
$result = $conn->query($sql);
$index = 0;
$response = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
			$response[$index] = new report($row['Eid'], $row['Hours']);
			$index++;
			
    }
} else {
    echo "select-empty-results";
}
$conn->close();
print(json_encode($response));
?>