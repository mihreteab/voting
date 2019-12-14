<?php
    require_once '../count/class.counter.php';
    require_once '../dbconfig/class.db.php';

    $connect = new ConfigDB();
    $connection = $connect->openConnection();

    $woredaid = $_POST['woredaid'];

    $q2 = "delete from trick1";
    $r2 = mysqli_query($connection, $q2);
    if(!$r2){
        echo "error while deleting trick1";
    }

    $q = "insert into trick1 values ('{$woredaid}')";
    $r = mysqli_query($connection, $q);

    if(!$r){
        echo "error while inserting into trick1 table";
    }
    else{
        $authworeda = new Counter();
        $authworeda->setWoredaId($woredaid);
        $authworeda->authenticateWoreda($woredaid);
    }
    
    $connect->closeConnection($connection);
?>