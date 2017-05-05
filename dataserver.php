<?php   

// GRANT ALL PRIVILEGES ON netvis.* TO 'netvis'@'localhost' identified by 'netvis';

$servername = "localhost";
$username = "netvis";
$password = "netvis";
$dbname = "netvis";

class Node
{
	var $label;
	var $id;
	var $title;
	var $color;
	var $size;
	var $attributes;
}

class Attributes
{
	var $Weight;
}

$nodes = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM host";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

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
	array_push($nodes, $node);

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - hostname: " . $row["hostname"]."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

$nodes_json = json_encode($nodes);

echo $nodes_json;

?>
