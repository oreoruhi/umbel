<?php
include('../functions/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="The Team Pabebe" content="">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-1.11.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/sb-admin-2.js"></script>
</head>
<body>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><center>Order ID</center></th>
                                            <th><center>Client Name</center></th>
                                            <th><center>Amount Paid</center></th>
                                            <th><center>Payment Method</center></th>
                                            <th><center>Date and time<center></th>
                                            <th><center>Address<center></th>
                                            <th><center>Handling Branch<center></th>
                                            <th><center>Status<center></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $query = "SELECT client_order.*,  branch.* 
                                        FROM client_order
                                        LEFT JOIN branch
                                        ON (client_order.b_id = branch.b_ID)";
                                        $resultQuery=mysqli_query($con, $query);

                                        if(mysqli_num_rows($resultQuery) >0){
                                            while($rowQuery=mysqli_fetch_assoc($resultQuery)){
                                                ?>

                                        <tr class="odd gradeX">
                                            <td><center><?php echo $rowQuery['co_ID'];?></center></td>
                                            <td><center><?php echo $rowQuery['co_name'];?></center></td>
                                            <td><center><?php echo $rowQuery['co_payment'];?></center></td>
                                            <td><center><?php echo $rowQuery['co_method'];?></center></td>
                                            <td><center><?php $rowQuery['co_date'];
                                            $time = strtotime($rowQuery['co_date']);
                                            $myFormatForView = date("M d, Y g:i A", $time);
                                            echo $myFormatForView;?>
                                            </center></td>
                                            <td><center><?php echo $rowQuery['co_address'];?></center></td>
                                            <td><center><?php echo $rowQuery['b_name'];?></center></td>
                                            <td><center><?php echo $rowQuery['co_status'];?></center></td>
                                        </tr>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                       
</body>
</html>