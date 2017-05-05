<?php   

include("config.php");
include("domain/domain.php");

$data = new graphvis;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// grab all hosts
$sql = "SELECT * FROM host";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

		$node = new Node;
		// build the node
		$node->label = $row["hostname"];
		$node->id = $row["id"];
		$node->title = $row["ip"];
		$node->color = "rgb(229,164,67)";
		$node->size = 5.0;
		
		$attributes = new Attributes;
		$attributes->Weight=1.0;
		$node->attributes = $attributes;

		// add the node
		array_push($data->nodes, $node);
    }
} else {
    echo "0 results";
}
$conn->close();

$json = json_encode($data);

echo $json;

?>
