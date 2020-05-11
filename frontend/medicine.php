<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$servername = "db";
$username = "root";
$password = "root";
$dbname = "meds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT name, quantity FROM med_info WHERE id=?");
$id = $_GET["id"];
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

print("<html>");
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		printf("<div>%s: %s</div>", $row["name"], $row["quantity"]);
	}
} else {
	print("<div>No Medicine was found with this input!</div>");
}
print("</html>");
$conn->close();

?>
