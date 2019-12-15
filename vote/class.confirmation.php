<?php
    require_once '../dbConfig/class.db.php';
    // $woredaid = $_POST['woredaid'];

    class Counter{
        
        function displayTazabis($woredaid){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();
            
            $region = substr($woredaid, 0, 3);
            $zone = substr($woredaid, 3, 3);
            $woreda = substr($woredaid, 6, 3);
            $uniqueno = substr($woredaid, -6);

            $query = "select * from federalcandidates";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query failed");
            }
            //validating the user by iterating over the data
            while($row = mysqli_fetch_assoc($result)){
                $region_queried = $row["region"];
                $zone_queried = $row["zone"];
                $woreda_queried = $row["woreda"];
                $uniqueno_queried = $row["uniqueno"];
                if($region == $region_queried && $zone == $zone_queried && $woreda == $woreda_queried && $uniqueno == $uniqueno_queried){
                    header("Location: ../pages/result_page.php");
                }
                else{
                    // echo $uniqueid;
                    $message = "Invalid Id.\\nTry again.";
                    echo "<script type='text/javascript'>alert('$message');";
                    echo 'window.location = "../pages/woreda_login_page.html";';
                    echo '</script>';
                    // echo "<h2 style='color: red; text-align: center; '>Login Failed!</h2>";
                    // header("Location: ../researcher/login.php");
                }
            }
            //close database connection
            $connect->closeConnection($connection);

            session_start();
            $_SESSION["current_user"] = $uniqueid;
        }

        function authenticateStation($stationid){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();
            
            $region = substr($stationid, 0, 3);
            $zone = substr($stationid, 3, 3);
            $woreda = substr($stationid, 6, 3);
            $station = substr($stationid, 9, 3);
            $uniqueno = substr($stationid, -6);

            $query = "select * from manualvotesfederal";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query failed");
            }
            //validating the user by iterating over the data
            while($row = mysqli_fetch_assoc($result)){
                $region_queried = $row["region"];
                $zone_queried = $row["zone"];
                $woreda_queried = $row["woreda"];
                $station_queried = $row["station"];
                $uniqueno_queried = $row["uniqueno"];
                if($region == $region_queried && $zone == $zone_queried && $woreda == $woreda_queried && $station == $station_queried && $uniqueno == $uniqueno_queried){
                    header("Location: ../pages/election_center_result_input.php");
                }
                else{
                    // echo $uniqueid;
                    $message = "Invalid Id.\\nTry again.";
                    echo "<script type='text/javascript'>alert('$message');";
                    echo 'window.location = "../pages/election-center-login.html";';
                    echo '</script>';
                    // echo "<h2 style='color: red; text-align: center; '>Login Failed!</h2>";
                    // header("Location: ../researcher/login.php");
                }
            }
            //close database connection
            $connect->closeConnection($connection);

            session_start();
            $_SESSION["current_user"] = $uniqueid;
        }

    }
?>