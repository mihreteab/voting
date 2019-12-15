<?php
    require_once '../dbConfig/class.db.php'; 

    class Authenticate{
        function authenticateUser(){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();

            //grab userid and password
            $uniqueid = $_POST["uniqueid"];

            $query = "select uniqueid from registeredvoters";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query failed");
            }

            //validating the user by iterating over the data
            while($row = mysqli_fetch_assoc($result)){
                $unique_queried = $row["uniqueid"];
                if($uniqueid == $unique_queried){
                    $query3 = "insert into votedusers (uniqueid) values('{$uniqueid}')";
                    $result3 = mysqli_query($connection, $query3);
                    
                    $query2 = "delete from registeredvoters where uniqueid = '{$uniqueid}'";
                    $result2 = mysqli_query($connection, $query2);
                    
                    echo $query3 . "</br>" . $query2;

                    header("Location: ../pages/voting-list2.php");
                }
                else{
                    // echo $uniqueid;
                    $message = "Invalid Id.\\nTry again.";
                    echo "<script type='text/javascript'>alert('$message');";
                    echo 'window.location = "../index.html";';
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