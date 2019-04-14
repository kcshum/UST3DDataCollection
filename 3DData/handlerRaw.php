<?php
    $servername = "localhost";
    $username = "root";
    $password = "CSCFm4a1";

    // create connection
    $conn = new mysqli($servername, $username, $password);

    // check whether it works
    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }
    mysqli_select_db($conn, 'threeDData');


    if(isset($_GET['floor'])){
        $floor = mysqli_real_escape_string($conn, $_GET['floor']);
        $x = mysqli_real_escape_string($conn, $_GET['x']);
        $y = mysqli_real_escape_string($conn, $_GET['y']);
    }
    else{
        die("incorrect url");
    }

    //print_r($_FILES);
    $filename=$_FILES['dataRaw']['name'];
    $type=$_FILES['dataRaw']['type'];
    $tmp_name=$_FILES['dataRaw']['tmp_name'];
    $size=$_FILES['dataRaw']['size'];
    $error=$_FILES['dataRaw']['error'];

    $time = date("Y-m-d");
    $sql = "INSERT INTO RawData (floor, x, y, lastModifyDate, src) VALUES ('{$floor}', {$x}, {$y}, '{$time}', 'RawData/{$filename}')";

    if (mysqli_query($conn, $sql)) {
        echo "Uploading to Database...<br>";
        echo "RawData upload Succeed!<br>";
        echo "You can kill this page now.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    
    

    move_uploaded_file($tmp_name, "RawData/".$filename);
?>