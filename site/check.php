<!DOCTYPE html>
<html>
	<head>
	 	<title>RIA Vignettes</title>
        <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
	</head>
	<body>
<?php
$regnum = filter_input(INPUT_POST, 'regnum');
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "vignettes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM vignettes_params WHERE regnum = '$regnum'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    echo "Information about vechile with registration number ".$row["Regnum"]." is <br>"."Vignettes number: " .$row["Id"]. "<br>"."Category: ".$row["Category"]."<br>". "Start time: " . $row["Startdate"]. "<br>". "End time: ".$row["Endtime"]."<br>";
} else {
    echo "There is no results for registration number $regnum";
}
$conn->close();
?>
    <a href="/index.html">Back</a>
	</body>
</html>
