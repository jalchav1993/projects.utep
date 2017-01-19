 <?php
$deleteRequest = json_decode(file_get_contents('php://input'));
$eid = $deleteRequest->eid;
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
$sql = "DELETE FROM TIME_SLOTS WHERE Eid='$eid'"; 
if ($conn->query($sql) === TRUE) {
} else {
    echo "delete-event-error-" . $conn->error;
}
$sql = "DELETE FROM MANAGE WHERE Eid = '$eid'"; 
if ($conn->query($sql) === TRUE) {
} else {
    echo "delete-event-error-" . $conn->error;
}
// sql to delete a record
$sql = "DELETE FROM EVENT WHERE Eid = '$eid'";

if ($conn->query($sql) === TRUE) {
    echo "delete-event-success";
} else {
    echo "delete-event-error-" . $conn->error;
}

$conn->close();
?> 