<?php
class Request{
	public $req = '';
	public function __construct($req){
		$this->req = $req;
	}
}
$request = '';
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
print(json_encode($allUsers));
?>