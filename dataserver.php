<?php   

// GRANT ALL PRIVILEGES ON netvis.* TO 'netvis'@'localhost' identified by 'netvis';

$servername = "localhost";
$username = "netvis";
$password = "netvis";
$dbname = "netvis";

class graphvis 
{
	var $nodes = array();
	var $edges = array();

}

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

$data = new graphvis;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

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

        echo "id: " . $row["id"]. " - hostname: " . $row["hostname"]."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

$json = json_encode($data);

echo $json;

?>
