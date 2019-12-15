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
            <h2>Result page</h2>
        </div>
        <div class="container main_container  text-center margin_top_one_em">

            <form action="../count/manual.php" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>House Of People Representatives </h2>
                        <div>
                            <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->manualvotecounts("federal");
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2>House Of Regional Representatives </h2>
                        <div>
                            <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->manualvotecounts("regional");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="modal_id" class="btn btn-success btn-block btn-lg margin_top_two_em"
                ><i class="fa fa-trash"></i>Submit</button>
            </form>
            

            <div class="margin_buttom_three_em"></div>


        </div>
    </div>
</body>

</html>