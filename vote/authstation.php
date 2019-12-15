<?php
    require_once '../count/class.counter.php';
    require_once '../dbconfig/class.db.php';

    $connect = new ConfigDB();
    $connection = $connect->openConnection();

    $stationid = $_POST['stationid'];

    $q2 = "delete from trick2";
    $r2 = mysqli_query($connection, $q2);
    if(!$r2){
        echo "error while deleting trick2";
    }

    $q = "insert into trick2 values ('{$stationid}')";
    $r = mysqli_query($connection, $q);

    if(!$r){
        echo "error while inserting into trick2 table";
    }
    else{
        $authstation = new Counter();
        $authstation->authenticateStation($stationid);
    }
    
    $connect->closeConnection($connection);
?>