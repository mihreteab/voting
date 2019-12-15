<?php
    require_once '../dbConfig/class.db.php';
    // $woredaid = $_POST['woredaid'];

    class Counter{
        public $id;
        function setWoredaId($id){
            $this->id = $id;
        }
        function getWoredaId(){
            return $this->id;
        }
        function authenticateWoreda($woredaid){
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

        function votecounts($type){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();

            $woredaid = "";
            $q = "select * from trick2";
            $r = mysqli_query($connection, $q);
            while($row = mysqli_fetch_array($r)){
                $woredaid = $row['value'];
            }
            
            $region = substr($woredaid, 0, 3);
            $zone = substr($woredaid, 3, 3);
            $woreda = substr($woredaid, 6, 3);
            $uniqueno = substr($woredaid, -6);
            switch($type){
                case "federal":
                    $query = "select * from federalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and uniqueno = '{$uniqueno}'";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo $query; 
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $manual = $row['manualvotes'];
                            $total = $votenumber + $manual;
                            $label = $row['id'];
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$partyname}' name='hpr' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                        <p class='paty_name'>{$partyname}</p>
                                                        <p class='candidate'>{$candidatename}</p>
                                                        <p class=''>Automated votes = {$votenumber}</p>
                                                        <p class=''>Manual votes = {$manual}</p>
                                                        <p class=''>Total votes = {$total}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class='elected'></span>
                                        </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                case "regional":
                    $query = "select * from regionalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and uniqueno = '{$uniqueno}'";
                    
                    // $query = "select * from regionalcandidates";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo "error";
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $manual = $row['manualvotes'];
                            $total = $votenumber + $manual;
                            $label = $row['id'];
                            $label = $label + 50;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$partyname}' name='hrr' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                    <p class='paty_name'>{$partyname}</p>
                                                    <p class='candidate'>{$candidatename}</p>
                                                    <p class=''>Automated votes = {$votenumber}</p>
                                                    <p class=''>Manual votes = {$manual}</p>
                                                    <p class=''>Total votes = {$total}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class='elected'></span>
                                        </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                }
        }

        function displaymanualcounts($type){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();

            $stationid = "";
            $q = "select * from trick2";
            $r = mysqli_query($connection, $q);
            while($row = mysqli_fetch_array($r)){
                $stationid = $row['value'];
            }
            
            $region = substr($stationid, 0, 3);
            $zone = substr($stationid, 3, 3);
            $woreda = substr($stationid, 6, 3);
            $station = substr($stationid, 9, 3);
            $uniqueno = substr($stationid, -6);
            switch($type){
                case "federal":
                    $query = "select * from federalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo $query; 
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $manual = $row['manualvotes'];
                            $label = $row['id'];
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$partyname}' name='hpr' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                        <p class='paty_name'>{$partyname}</p>
                                                        <p class='candidate'>{$candidatename}</p>
                                                        <h5 class='paty_name'>{$manual}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class='elected'></span>
                                        </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                case "regional":
                    $query = "select * from regionalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    
                    // $query = "select * from regionalcandidates";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo "error";
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $label = $row['id'];
                            $label = $label + 50;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$partyname}' name='hrr' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                        <p class='paty_name'>{$partyname}</p>
                                                        <p class='candidate'>{$candidatename}</p>
                                                        <h5 class='paty_name'>{$votenumber}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class='elected'></span>
                                        </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                }
        }

        function manualvotecounts($type){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();
            
            $stationid = "";
            $q = "select * from trick2";
            $r = mysqli_query($connection, $q);
            while($row = mysqli_fetch_array($r)){
                $stationid = $row['value'];
            }
            
            $region = substr($stationid, 0, 3);
            $zone = substr($stationid, 3, 3);
            $woreda = substr($stationid, 6, 3);
            $station = substr($stationid, 9, 3);
            $uniqueno = substr($stationid, -6);
            switch($type){
                case "federal":
                    $query = "select * from federalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    $result = mysqli_query($connection, $query);
                    // echo $query;
                    if(!$result){
                        echo $query; 
                    }                    
                    else{
                        // echo $query;
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $label = $row['id'];
                            $name = $stationid . $partyname;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                    <li class='list-group-item candidate_value'>
                                        <div>
                                            <div class='row half_height'>
                                                <div class='col-sm-4 '>
                                                    <img class='half_height img-responsive'
                                                        src='../public/images/{$logopath}.png'
                                                        alt='National-Election-Board-Ethiopia logo' width='250px'>

                                                </div>
                                                <div class='col-sm-8'>
                                                    <p class='paty_name'>{$partyname}</p>
                                                    <p class='candidate'>{$candidatename}</p>
                                                        <div class='row'>
                                                            <div class='col-sm-4'>
                                                                <p>Result</p>
                                                            </div>
                                                            
                                                            <div class='form-group col-sm-8'>
                                                              <input type='number' class='form-control' id='id' name={$name}>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        <span class='selected'></span>
                                    </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                case "regional":
                    $query = "select * from regionalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo $query; 
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $label = $row['id'];
                            $name = $stationid . $partyname;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for={$label}>
                                    <li class='list-group-item candidate_value'>
                                        <div>
                                            <div class='row half_height'>
                                                <div class='col-sm-4 '>
                                                    <img class='half_height img-responsive'
                                                        src='../public/images/{$logopath}.png'
                                                        alt='National-Election-Board-Ethiopia logo' width='250px'>

                                                </div>
                                                <div class='col-sm-8'>
                                                    <p class='paty_name'>{$partyname}</p>
                                                    <p class='candidate'>{$candidatename}</p>
                                                        <div class='row'>
                                                            <div class='col-sm-4'>
                                                                <p>Result</p>
                                                            </div>
                                                            
                                                            <div class='form-group col-sm-8'>
                                                            <input type='number' class='form-control' id='id' name={$name}>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        <span class='selected'></span>
                                    </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                }
        }

        function submitManullyCounted(){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();

            $stationid = "";
            $q = "select * from trick2";
            $r = mysqli_query($connection, $q);
            while($row = mysqli_fetch_array($r)){
                $stationid = $row['value'];
            }
            
            $region = substr($stationid, 0, 3);
            $zone = substr($stationid, 3, 3);
            $woreda = substr($stationid, 6, 3);
            $station = substr($stationid, 9, 3);
            $uniqueno = substr($stationid, -6);
            switch($type){
                case "federal":
                    $query = "select * from manualvotesfederal where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo $query; 
                    }
                    else{
                        // echo $query;
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $label = $row['id'];
                            $name = $stationid . $partyname;
                            // echo $logopath;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                    <li class='list-group-item candidate_value'>
                                        <div>
                                            <div class='row half_height'>
                                                <div class='col-sm-4 '>
                                                    <img class='half_height img-responsive'
                                                        src='../public/images/{$logopath}.png'
                                                        alt='National-Election-Board-Ethiopia logo' width='250px'>

                                                </div>
                                                <div class='col-sm-8'>
                                                    <p class='paty_name'>{$partyname}</p>
                                                    <p class='candidate'>{$candidatename}</p>
                                                        <div class='row'>
                                                            <div class='col-sm-4'>
                                                                <p>Result</p>
                                                            </div>
                                                            
                                                            <div class='form-group col-sm-8'>
                                                              <input type='number' class='form-control' id='id' name={$name}>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        <span class='selected'></span>
                                    </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                case "regional":
                    $query = "select * from manualvotesregional where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo $query; 
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $label = $row['id'];
                            $name = $stationid . $partyname;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for={$label}>
                                    <li class='list-group-item candidate_value'>
                                        <div>
                                            <div class='row half_height'>
                                                <div class='col-sm-4 '>
                                                    <img class='half_height img-responsive'
                                                        src='../public/images/{$logopath}.png'
                                                        alt='National-Election-Board-Ethiopia logo' width='250px'>

                                                </div>
                                                <div class='col-sm-8'>
                                                    <p class='paty_name'>{$partyname}</p>
                                                    <p class='candidate'>{$candidatename}</p>
                                                        <div class='row'>
                                                            <div class='col-sm-4'>
                                                                <p>Result</p>
                                                            </div>
                                                            
                                                            <div class='form-group col-sm-8'>
                                                            <input type='number' class='form-control' id='id' name={$name}>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        <span class='selected'></span>
                                    </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                }
        }

        function tazabis($type){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();

            $stationid = "";
            $q = "select * from trick2";
            $r = mysqli_query($connection, $q);
            while($row = mysqli_fetch_array($r)){
                $stationid = $row['value'];
            }
            
            $region = substr($stationid, 0, 3);
            $zone = substr($stationid, 3, 3);
            $woreda = substr($stationid, 6, 3);
            $station = substr($stationid, 9, 3);
            $uniqueno = substr($stationid, -6);
            switch($type){
                case "federal":
                    $query = "select * from tazabis";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo $query; 
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $fullname = $row['fullname'];
                            
                            echo "
                                    <ul class='list-group'>
                                                                          
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                            <div class='form-group'>
                                            <label class='control-label col-sm-2' for='name'
                                              >{$fullname}:</label
                                            >
                                            <div class='col-sm-10'>
                                              <input
                                                type='password'
                                                class='form-control'
                                                id='password'
                                                placeholder='nter password'
                                              />
                                            </div>
                                          </div>
                                            </div>
                                            <span class='elected'></span>
                                        </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                case "regional":
                    $query = "select * from regionalcandidates where region = '{$region}' and zone = '{$zone}' and woreda = '{$woreda}' and station = '{$station}' and uniqueno = '{$uniqueno}'";
                    
                    // $query = "select * from regionalcandidates";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo "error";
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $votenumber = $row['votenumber'];
                            $label = $row['id'];
                            $label = $label + 50;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$partyname}' name='hrr' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                        <p class='paty_name'>{$partyname}</p>
                                                        <p class='candidate'>{$candidatename}</p>
                                                        <h5 class='paty_name'>{$votenumber}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class='elected'></span>
                                        </li>
                                    </ul>
                                ";
                        }
                    }
                    break;
                }
        }
    }
?>