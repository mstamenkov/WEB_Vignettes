<!DOCTYPE html>
<html>
	<head>
	 	<title>RIA Vignettes</title>
        <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta http-equiv="content-language" content="en-us, bg" />
	</head>
	<body>
        <div class="block"> 
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
$status = "";
$sql = "SELECT * FROM vignettes_params WHERE regnum = '$regnum'";
$sql_status = "UPDATE vignettes_params SET Status = 0 WHERE Endtime < NOW()";
$result = $conn->query($sql);
$result_status = $conn->query($sql_status);

if ($result->num_rows > 0) {
    echo "Information about vehicle with registration number $regnum is <br>";
    while($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        echo "Vignette number: " .$row["Id"]. "<br>"."Category: ".$row["Category"]."<br>". "Start time: " . $row["Startdate"]. "<br>". "End time: ".$row["Endtime"]."<br>";
        if($row["Status"] == 1)echo "Status : active <br>";
        else echo "Status : inactive <br>";
        echo "<br>";
    }
} else {
    echo "There is no results for registration number $regnum";
}
$conn->close();
?>
    <a href="/index.html">Back</a>
        </div>
	</body>
</html>
