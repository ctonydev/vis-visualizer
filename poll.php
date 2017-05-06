<?php
include("config.php");

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// grab all networks
$sql = "SELECT * FROM network";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	$network = $rows["network"];
    	$mask = $rows["mask"];

    	echo $network;

    }
} else {
    echo "0 results";
}
$conn->close();

?>

