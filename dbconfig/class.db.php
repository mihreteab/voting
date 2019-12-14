<?php
    class ConfigDB{
        public $connection;
        function openConnection(){
            $connection = mysqli_connect("localhost", "root", "root", "electionboard");
            if(mysqli_connect_errno()){
                die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
            }
            return $connection;
        }

        function closeConnection($connection){
            mysqli_close($connection);
        }
    }
?>