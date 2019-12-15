<?php
    require_once 'class.counter.php';
    require_once '../dbconfig/class.db.php';

    $connect = new ConfigDB();
    $connection = $connect->openConnection();

    $query1 = "select * from federalcandidates";
    $result1 = mysqli_query($connection, $query1);
    $numRows1 = mysqli_num_rows($result1);

    $postnames = "";
    $values = array();

    for($i = 0; $i < $numRows1; $i++){
        $rows = mysqli_fetch_array($result1);
        $stationid = $rows['region'].$rows['zone'].$rows['woreda'].$rows['station'].$rows['uniqueno'];
        $postnames = $stationid . $rows['partyname'];

        array_push($values, $postnames);
    }

    $tobesubmitted = array();
    $partyname = array();

    for($i = 0; $i < $numRows1; $i++){
        $tobesubmitted[$i] = $_POST[$values[$i]];
        $now = $tobesubmitted[$i];

        $partyname = substr($values[$i], 18);
        $query2 = "update federalcandidates set manualvotes = {$now} where partyname = '{$partyname}'";
        $result2 = mysqli_query($connection, $query2);
        if(!$result2){
            echo "error";
        }
        else{
            header("Location: ../pages/election_ceneter_confirmation.php");
        }

    }

    for($i = 0; $i < $numRows1; $i++){
        
    }
    
    

    // $r1 = mysqli_query($connection, "delete from trick3");

    // $r2 = mysqli_query($connection, "insert into trick3 values('{$numRows1}')");

    // $vote = new Counter();
    // $vote->submitManuallyCounted();


    $connect->closeConnection($connection);
?>