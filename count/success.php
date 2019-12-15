<?php
    require_once 'class.counter.php';
    require_once '../dbconfig/class.db.php';

    $connect = new ConfigDB();
    $connection = $connect->openConnection();

    header("Location: ../pages/election_center_finaly.html");

    $connect->closeConnection($connection);
?>