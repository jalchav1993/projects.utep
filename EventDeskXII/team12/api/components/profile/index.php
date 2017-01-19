<?php
session_start();
$state = $_SESSION['state'];
$userName = $_SESSION['userName'];
$query = "SELECT Ename,Semail FROM EVENT,VOLUNTEER_FOR WHERE EVENT.Eid=VOLUNTEER_FOR.Eid";
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
$result = $conn->query($sql);
echo "<md-card><md-card-content>";
if($state === 'admin'||$state === 'user'||$state === 'guest'){
	echo nl2br("Username: $userName\n");
}
if ($result->num_rows > 0) {
    // output data of each row
		echo "<table border = '1'>"; 
		echo "<th>Events Registered</th>"; 
		while($row = $result->fetch_assoc())
		{
			if($row['Semail']===$_SESSION['userName']){
			  echo "<tr><td>"; 
			  echo $row['Ename'];
				echo "</td></tr>"; 
			}
		}
		echo "</table>";
		echo "</md-card-content></md-card>";
}
?>
