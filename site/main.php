<?php
 $regnum = filter_input(INPUT_POST, 'regnum');
 $category = filter_input(INPUT_POST, 'category');
$length = filter_input(INPUT_POST, 'length');
 if (!empty($regnum)){

$host = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "vignettes";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
$check = "SELECT * FROM vignettes_params WHERE regnum = '$regnum' AND Endtime > NOW()";
$result_check = $conn->query($check);
if ($result_check->num_rows > 0){
	
    echo "This number already have a vignettes.";
    //sleep(5);
	header( "Refresh:5; url=http://localhost/index.html", true, 303);
die();
}
$delete_old = "DELETE FROM vignettes_params WHERE Endtime < NOW()";
$conn->query($delete_old);

$sql = "INSERT INTO vignettes_params (Regnum, Category,Startdate,Endtime)
values ('$regnum','$category',NOW(),$length)";
if ($conn->query($sql)){
echo "New record is inserted sucessfully";

}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}

} else{
echo "Registration should not be empty";
die();
}
?>
