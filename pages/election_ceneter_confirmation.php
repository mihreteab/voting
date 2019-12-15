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
            <h2>Result Entry Confirmation</h2>
        </div>
        <div class="container main_container  text-center margin_top_one_em">

            <form action="#" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>House Of People Representatives </h2>
                        <form action="" method="post">
                            <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->displaymanualcounts("federal");
                                ?> 
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h2>House Of Regional Representatives </h2>
                        <form action="" method="post">
                            <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->displaymanualcounts("regional");
                                ?> 
                            </div>
                        </form>
                    </div>
                </div>
            </form>

            <div class="jumbotron">
                <h2 class="margin_buttom_two_em">Confirm Vote Result</h2>
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-6">
                        <form action="../count/success.php" method="post" class="form-horizontal">
                          <div class="party-content">
                                <?php                             
                                    require_once '../count/class.counter.php';
                                    $lib = new Counter();       
                                    // $query = "select * from allbooks";
                                    // $result = mysqli_query($connection, $query);                                    
                                    echo $lib->tazabis("federal");
                                ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                
            </div>
            
            <div class="margin_buttom_three_em"></div>
        </div>
    </div>
</body>

</html>