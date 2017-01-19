 <?php
$deleteRequest = json_decode(file_get_contents('php://input'));
$table = '';
$userName = '';
$selector='';
if($deleteRequest->request==='deleteById'){
	if($deleteRequest->tableSelect ==='student'){
		$table ="STUDENT"; 
		$userName =$deleteRequest->Semail; 
		$selector = 'Semail';
	}else if ($deleteRequest->tableSelect ==='admin'){
		$table ="FACULTY"; 
		$userName =$deleteRequest->Semail; 
		$selector = 'Femail';
	}else if ($deleteRequest->tableSelect ==='guest'){
		$table ="COMMUNITY_USER"; 
		$userName =$deleteRequest->Semail;
		$selector = 'Cemail';
	}
}
$servername = 'earth.cs.utep.edu';
$username = "cs4342team12fa16";
$password = "yottadata_12";
$dbname = "cs4342team12fa16";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM $table WHERE $selector = '$userName'";

if ($conn->query($sql) === TRUE) {
    echo "delete-user-success";
} else {
    echo "delete-user-error-" . $conn->error;
}

$conn->close();
?> 