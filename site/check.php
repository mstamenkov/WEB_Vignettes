<!DOCTYPE html>
<html>
	<head>
	 	<title>ГУП - Информационна система</title>
        <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
        <meta charset="utf-8">
        <link href="https://www.bgtoll.bg/content/assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css" id="bootstrap-css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style.css" type="text/css">
        <meta http-equiv="content-language" content="en-us, bg" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
        <div class="block block-buy-check"> 
<?php
$regnum = filter_input(INPUT_POST, 'regnum');
$regnum = strtoupper($regnum);
$servername = "localhost";
$username = "root";
$password = "kiselomlqko";
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
        echo "Vignette number: " .$row["Id"]. "<br>"."Category: ".$row["Category"]."<br>". "Nationality: " . $row["Nationality"]. "<br>". "Start time: " . $row["Startdate"]. "<br>". "End time: ".$row["Endtime"]."<br>";
        if($row["Status"] == 1)echo "Status : active <br>";
        else echo "Status : inactive <br>";
        echo "<br>";
    }
} else {
    echo "There is no results for registration number $regnum";
    die();
}
$conn->close();
?>
    <a href="./index.html" style="color:black">Back</a>
        </div>
        
	</body>
</html>
