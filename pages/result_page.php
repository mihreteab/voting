<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="3;url=http://localhost:8081/voting/pages/result_page.php" /> -->
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
            <h2>Result page</h2>
        </div>
        <div class="container main_container  text-center margin_top_one_em">

            <form action="#" method="POST">
                <div class="row">
                    <div class="col-sm-6 bold_right_border">
                        <h2>House Of People Representative </h2>
                        <form action="" method="post">
                            <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->votecounts("federal");
                                ?>  
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 ">
                        <h2>House Of Regional Representatives </h2>
                        <form action="" method="post">
                            <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->votecounts("regional");
                                ?> 
                            </div>
                        </form>
                    </div>
                </div>
            </form>
            
            <div class="modal modal-danger fade" id="modal-danger">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">You Have Elected The Following</h4>
                            
                        </div>
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
                                                        <p class="paty_name">Party Name</p>
                                                        <p class="candidate">Candidate Name </p>
        
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    
                                </div>

                                <div class="col-sm-6">
                                    <h2>House Of <br> Regional Representatives </h2>
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
                                                        <p class="paty_name">Party Name</p>
                                                        <p class="candidate">Candidate Name </p>
        
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
                                    href="?delete=true&inc=<?php echo $row['itemname'];?>&phone=<?php echo $row['model']?>"><button
                                        type="button" class="btn btn-success">Submit</button></a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="margin_buttom_three_em"></div>


        </div>
    </div>
</body>

</html>