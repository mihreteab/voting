<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>National Election</title>

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">

    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.js"></script>


</head>

<body>
    <div class="content">
        <div class="container text-center">
            <img src="../public/images/National-Election-Board-Ethiopia.jpg" alt="National-Election-Board-Ethiopia logo"
                width="250px">
            <h1 class="">
                National Election Board Ethiopia
            </h1>
        </div>
        <div class="container main_container  text-center margin_top_one_em">

            <form action="" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>House Of People Representative </h2>
                        <form action="" method="post" id="form1">
                            <div class="party-content">
                                <?php
                                    require_once '../vote/class.voter.php';
                                    $lib = new Voter();
                                    echo $lib->listCandidate("federal");
                                ?>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h2>House Of Regional Representative</h2>
                        <form action="" method="post">
                            <div class="party-content">
                                <?php                             
                                    require_once '../vote/class.voter.php';
                                    $lib = new Voter();       
                                    echo $lib->listCandidate("regional");
                                ?>                        
                            </div>
                        </form>
                    </div>
                </div>
            </form>
            
            <!-- <button id="radiosubmit" type="submit" class="btn btn-success btn-block btn-lg margin_top_two_em"><i class="fa fa-trash"></i>Submit</button></td> -->
            <button id="radiosubmit" type="button" class="btn btn-success btn-block btn-lg margin_top_two_em" data-toggle="modal"
                data-tarGET="#modal-danger"><i class="fa fa-trash"></i>Submit</button></td>
                <script>
                    $(document).ready(function(){
                        $("button[id='radiosubmit']").click(function(){
                            var radioValue = $("input[name='hpr']:checked").val();
                            var radioValue_hf = $("input[name='hf']:checked").val();
                            console.log(radioValue_hf);
                            console.log(radioValue);
                            var name_of_party_hpr = $("p."+radioValue).text();
                            var name_of_party_hf = $("p."+radioValue_hf).text();
                            var hpr_candidate_name = $("h5."+radioValue).text();
                            var hf_candidate_name = $("h5."+radioValue_hf).text();
                        if(radioValue){
                            $("#choosed_hpr_party").html(name_of_party_hpr);
                            $("#choosed_hpr_candidate").html(hpr_candidate_name);
                            $("#choosed_hf_party").html(name_of_party_hf);
                            $("#choosed_hf_candidate").html(hf_candidate_name);

                            $("#choosed_hpr_party_input").val(name_of_party_hpr);
                            $("#choosed_hpr_candidate_input").val(hpr_candidate_name);

                            $("#choosed_hf_party_regional").html(name_of_party_hf);
                            $("#choosed_hf_candidate_regional").html(hf_candidate_name);
                        }
                        });
                    });
                </script>
            <div class="modal modal-danger fade" id="modal-danger">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">You Have Elected The Following</h4>                            
                        </div>
                        <form action="../vote/vote.php" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2>House Of People Representatives </h2>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div>
                                                    <div class="row half_height">
                                                        <div class="col-sm-4 ">
                                                            <img class="half_height img-responsive"
                                                                src="../public/images/National-Election-Board-Ethiopia.jpg"
                                                                alt="National-Election-Board-Ethiopia logo" width="250px">        
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="paty_name" id="choosed_hpr_party">Party Name</p>
                                                            <p class="candidate" id="choosed_hpr_candidate">Candidate Name</p>
                                                            <input type="text" style="display: none;" value="" name="party" id="choosed_hpr_party_input"> 
                                                            <input type="text" style="display: none;" value="" name="candidate" id="choosed_hpr_candidate_input"> 
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        
                                    </div>

                                    <div class="col-sm-6">
                                        <h2>House Of <br> Regional Representatives</h2>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div>
                                                    <div class="row half_height">
                                                        <div class="col-sm-4 ">
                                                            <img class="half_height img-responsive"
                                                                src="../public/images/National-Election-Board-Ethiopia.jpg"
                                                                alt="National-Election-Board-Ethiopia logo" width="250px">        
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="paty_name" id="choosed_hf_party"></p>
                                                            <p class="candidate" id="choosed_hf_candidate"></p>
                                                            <input type="text" style="display: none;" value="" name="party_regional" id="choosed_hpr_party_input_regional"> 
                                                            <input type="text" style="display: none;" value="" name="candidate_regional" id="choosed_hpr_candidate_input_regional"> 
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        
                                    </div>

                                </div>
                            </div>
                        
                        <div class="modal-footer">
                            <a><button type="button" class="btn btn-danger pull-left"
                                    data-dismiss="modal">Cancel</button>
                                <a
                                    href="?delete=true&inc="><button
                                        type="submit" class="btn btn-success">Submit</button></a>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="margin_buttom_three_em"></div>


        </div>
    </div>
    <script>
        $('#radiosubmit').click(function(){
            var x = $('#form1 input[type=radio]:checked').attr('id');
            // console.log(x);
        });​
    </script>
</body>

</html>