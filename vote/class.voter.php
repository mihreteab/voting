<?php
    require_once '../dbConfig/class.db.php'; 

    class Voter{
        function listCandidate($type){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();
            switch($type){
                case "federal":
                    // $query = "select * from federalcandidates where region = '{$region}', zone = '{$zone}', woreda = '{$woreda}'";
                    $query = "select * from federalcandidates";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo "error";   
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $label = $row['id'];
                            $label = "hpr" . $label;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$label}' name='hpr' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                        <p class='paty_name $label'>{$partyname}</p>
                                                        <h5 class='candidate $label'>{$candidatename}</h5>
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
                    // $query = "select * from federalcandidates where region = '{$region}', zone = '{$zone}', woreda = '{$woreda}'";
                    
                    $query = "select * from regionalcandidates";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        echo "error";
                    }
                    else{
                        while($row = mysqli_fetch_array($result)){
                            $partyname = $row['partyname'];
                            $candidatename = $row['candidatename'];
                            $logopath = $row['logopath'];
                            $label = $row['id'];
                            $label = $label + 50;
                            $label = "hf" . $label;
                            // echo $label;
                            echo "
                                    <ul class='list-group'>
                                        <label for='{$label}'>
                                        <input type='radio' value='{$label}' name='hf' id='{$label}' class='party_candidate_list'>                                    
                                        <li class='list-group-item candidate_value'>
                                            <div class='row half_height'>
                                                <div class='row half_height'>
                                                    <div class='col-sm-4 '>
                                                        <img class='half_height img-responsive' src='../public/images/{$logopath}.png' alt='National-Election-Board-Ethiopia logo' width='250px'>
                                                    </div>
                                                    <div class='col-sm-8'>
                                                        <p class='paty_name $label'>{$partyname}</p>
                                                        <h5 class='candidate $label'>{$candidatename}</h5>
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

            $connect->closeConnection($connection);
        }

        function submitVote(){
            $connect = new ConfigDB();
            $connection = $connect->openConnection();

            $party = $_POST['party'];
            $candidate = $_POST['candidate'];
            $party_regional = $_POST['party_regional'];
            $candidate_regional = $_POST['candidate_regional'];

            //fetch votenumbers;
            $query2 = "select * from federalcandidates where partyname = '{$party}' and candidatename = '{$candidate}'";
            $result2 = mysqli_query($connection, $query2);
            while($row = mysqli_fetch_array($result2)){
                $vote_queried_federal = $row['votenumber'];
            }

            $vote_federal = $vote_queried_federal + 1;

            echo $vote_federal;

            $query_f = "insert into federalcandidates (votenumber) values('{$vote_federal}' where partyname = '{$party}' and candidatename = '{$candidate}'";
            $result_f = mysqli_query($connection, $query_f);
            if(!$result_f){
                echo "error";
            }

            $query3 = "select * from regionalcandidates where partyname = '{$party_regional}' and candidatename = '{$candidate_regional}'";
            $result3 = mysqli_query($connection, $query3);
            while($row = mysqli_fetch_array($result3)){
                $vote_queried_regional = $row['votenumber'];
            }

            
            $vote_regional = $vote_queried_regional + 1;
            

            

            $query_r = "insert into regionalcandidates (votenumber) values('{$vote_regional}' where partyname = '{$party_regional}' and candidatename = '{$candidate_regional}'";
            $result_r = mysqli_query($connection, $query_r);
            if(!$result_r){
                echo "error";
            }
            else{
                header("Location: ../pages/citizen_finalized.html");
            }

            $connect->closeConnection($connection);
        }

    }
?>