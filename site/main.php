<!DOCTYPE html>
<html>
	<head>
	 	<title>ГУП - Информационна система</title>
        <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta http-equiv="content-language" content="en-us, bg" />
	</head>
	<body>
        <div class="block block-buy-check"> 
<?php
 $regnum = filter_input(INPUT_POST, 'regnum');
 $regnum = strtoupper($regnum);
 $category = filter_input(INPUT_POST, 'category');
$nationality = filter_input(INPUT_POST, 'nationality');
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
            echo '<div style="font-size:12px;color:#000000;font-weight:bold;">This registration number already have a vignette.</div>';
            //sleep(5);
            header( "Refresh:3; url=https://onlook.app/api/", true, 303);
            die();
        }
        //$delete_old = "DELETE FROM vignettes_params WHERE Endtime < NOW()";
        //$conn->query($delete_old);
        $sql_status = "UPDATE vignettes_params SET Status = 0 WHERE Endtime < NOW()";
        $result_status = $conn->query($sql_status);
        $sql = "INSERT INTO vignettes_params (Regnum, Category, Nationality, Startdate, Endtime)
        values ('$regnum','$category','$nationality',NOW(),$length)";
        if(strlen($regnum) >= 7){
            if ($conn->query($sql)){
                echo '<div style="font-size:12px;color:#000000;font-weight:bold;">Vignette successfully bought</div>';
                header( "Refresh:3; url=https://onlook.app/api/index.html", true, 303);
            }
        }
        else{
            echo "Registration number is too short";
            header( "Refresh:3; url=https://onlook.app/api/", true, 303);
            die();
        }
        $conn->close();
    }

} else{
    echo "Registration number should not be empty";
    die();
}
?>
<a href="./index.html">Back</a>
        </div>
	</body>
</html>
