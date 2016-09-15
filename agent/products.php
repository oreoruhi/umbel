<?php
include('../functions/connect.php');
session_start();

if(isset($_SESSION['user']) && $_SESSION['type'] == 'Agent')
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="The Team Pabebe" content="">

    <title>Service Panel</title>
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

    <script type="text/javascript">
    function showhide() {
       var e = document.getElementById('foo');
       if(e.style.display == 'none')
          e.style.display = 'block';
       else
          e.style.display = 'none';}
    </script>  
    <script type="text/javascript">
    function showhidePass() {
       var e = document.getElementById('foo1');
       if(e.style.display == 'none')
          e.style.display = 'block';
       else
          e.style.display = 'none';}
    </script>   
	<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable({
		"bSort": false
		});
    });
    </script>
        <script>
    $(document).ready(function() {
        $('#dataTables-example1').dataTable({
        "bSort": false
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example2').dataTable({
        "bSort": false
        });
    });
    </script>
	<script>
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}    
	</script>
	<script type="text/javascript">
    function CheckPasswordStrength() {
		var password = document.getElementById('pword').value;
		var repeat_password = document.getElementById('rpword').value;
        var password_strength = document.getElementById("password_strength");
 
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }
		
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
 
        var passed = 0;
        var color = "";
        var strength = "";
		
		for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
 
            if (passed == 4 && password.length > 5) {
                strength = "That's all good!";
                color = "#66cc66";
				password_strength.innerHTML = strength;
				password_strength.style.color = color;
				if(password == repeat_password){
				$('#saveBtn').removeAttr('disabled');
				}
			} else{	
				strength = "There's something wrong with your password...";
                color = "#ff6666";
				password_strength.innerHTML = strength;
				password_strength.style.color = color;
				$('#saveBtn').attr('disabled', true);
			}
		}
</script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#paymentMethod').on('change', function() {
              if ( this.value == 'COD')
              {
                $("#address").fadeIn();
              }
              else
              {
                $("#address").fadeOut();
              }
            });
        });
    </script>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand" href="#">Umbel Service Panel</div>
            </div>
            <!-- /.navbar-header -->
		<ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#myModal" data-toggle="modal"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../functions/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Order Reports</a>
                        </li>
                        <li>
                            <a class="active" href="products.php"><i class="fa fa-list fa-fw"></i> Walk-In and Phone Orders</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                <br />
        <?php
            if(isset($_GET['added'])){
        ?>
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            A product has been successfully added to the cart!
            </div>
        <?php
        }   
            if(isset($_GET['removed'])){
        ?>
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            A product has been successfully removed from the cart!
            </div>
        <?php
        }
            if(isset($_GET['stockShort'])){
        ?>
            <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Your new product's current stock amount is not enough to distribute your desired amount of stock among the branches.
            </div>
        <?php
        }
            if(isset($_GET['fail'])){
        ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Something went wrong while processing your request.
            </div>
        <?php
        }
        if(isset($_GET['checkout'])){
        ?>
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            The client's order has been successfully checked out!
            </div>
        <?php
        }
        if(isset($_GET['clientSession'])){
        ?>
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            The client's session has ben successfully cancelled!
            </div>
        <?php
        }
        if(isset($_GET['setClient'])){
        ?>
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            A client session has been started!
            </div>
        <?php
        }
?>  
                    <h1 class="page-header">Walk In and Phone Orders</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-12-lg">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Non-Online Orders
                            <?php
                            if(!isset($_GET['client_id'])){
                            ?>
                            <span class="navbar-right"><a href="#myModal1" data-toggle="modal"><button type="button" class="btn btn-primary btn-xs">New order</button></a></span>
                            <?php
                            } else {
                            ?>
                            <span class="navbar-right"><a href="../functions/removeClientSess.php?coid=<?php echo $_GET['client_id'];?>"><button type="button" class="btn btn-danger btn-xs">Cancel Order</button></a></span>
                            <?php
                            }
                            ?>                        
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                            if(!isset($_GET['client_id'])){
                            ?>
                            <span class="navbar-right"><a href="#"><button type="button" class="btn btn-success btn-xs" disabled>Checkout order</button></a></span>   
                            <?php
                            } else {
                            ?>
                            <span class="navbar-right"><a href="../functions/checkoutClient.php?coid=<?php echo $_GET['client_id'];?>"><button type="button" class="btn btn-success btn-xs">Checkout order</button></a></span>   
                            <?php
                            }
                            ?>
                            
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Products</a>
                                </li>
                                <li><a href="#bouquet" data-toggle="tab">Bouquets</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">Cart</a>
                                </li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>List of available products</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><center>Flower ID</center></th>
                                            <th><center>Flower Name</center></th>
                                            <th><center>Price</center></th>
                                            <th><center>Stock</center></th>
                                            <th><center>Modifications<center></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $id=$_SESSION['id'];
                                        $get="SELECT user.*, branch.* FROM branch LEFT JOIN user ON (user.b_id = branch.b_ID) WHERE user.u_id = '$id'";
                                        $resultGet=mysqli_query($con, $get);
                                        $rowGet=mysqli_fetch_assoc($resultGet);

                                        $condition=$rowGet['b_ID'];
                                        $sql="SELECT product.*, stock.* FROM product LEFT JOIN stock ON (product.p_ID = stock.p_id) WHERE product.p_status!='Archived' AND stock.b_id='$condition' AND stock.s_stock != '0'";
                                        $result=mysqli_query($con, $sql);
                                                    
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($row=mysqli_fetch_array($result)){
                                        ?>          
                                        <tr class="odd gradeX">
                                            <td><center><?php echo $row['p_ID']; ?></center></td>
                                            <td><center><?php echo $row['p_name']; ?></center></td>
                                            <td><center><?php echo "PHP " . $row['p_price'] . ".00"; ?></center></td>
                                            <?php
                                            if($row['s_stock'] > 300){
                                            ?>
                                            <td><center><?php echo $row['s_stock']; ?></center></td>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <td style="color:red;"><center><?php echo $row['s_stock']; ?></center>
                                            <center><span class="text-muted">Stock level: critical</span></center></td>
                                            <?php
                                            }
                                    
                                            if(!isset($_GET['client_id'])){
                                            ?>
                                            
                                            <td><center><form action="../functions/addToCart.php?id=<?php echo $row['p_ID'];?>&coid=<?php echo $_GET['client_id'];?>" method="POST">
                                                <input type="number" class="form-control" style="width: 70px;" name="quant" disabled /> &nbsp
                                                <button type="submit" class="btn btn-success btn-sm" disabled><span class="fa fa-cart"></span> Add to cart</button>
                                                </form>
                                            </center></td>
                                            <?php
                                            }else{
                                            ?>

                                            <td><center><form action="../functions/addToCart.php?id=<?php echo $row['p_ID'];?>&coid=<?php echo $_GET['client_id'];?>" method="POST">
                                                <input type="number" class="form-control" style="width: 70px;" name="quant" min="1" max="20" /> &nbsp
                                                <button type="submit" class="btn btn-success btn-sm"><span class="fa fa-cart"></span> Add to cart</button>
                                                </form>
                                            </center></td>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        </tr>
                                    <?php
                                    }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4>Cart</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                                    <thead>
                                                        <tr>
                                                            <th>Product ID</th>
                                                            <th>Product Name</th>
                                                            <th>Quantity</th>
                                                            <th>Modification</th>
                                                            <th>Modification</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                    <?php
                                    if(isset($_GET['client_id'])){
                                    
                                    $clientID = $_GET['client_id'];
                                    $queryCart = "SELECT client_order.*, cart.* 
                                    FROM cart
                                    LEFT JOIN client_order
                                    ON (client_order.co_ID = cart.co_id)
                                    WHERE client_order.co_ID = '$clientID'
                                    AND client_order.co_status = 'Ordered'";
                                    $resultCart=mysqli_query($con, $queryCart);
                                    if(mysqli_num_rows($resultCart) > 0){
                                        while($rowCart = mysqli_fetch_array($resultCart)){
                                            ?>
                                                        <tr>
                                                            <td><?php echo $rowCart['c_itemID'];?></td>
                                                            <td><?php echo $rowCart['c_name'];?></td>
                                                            <td><?php echo $rowCart['c_quantity'];?></td>
                                                            <td><center>
                                                                <form action="../functions/updateCart.php?id=<?php echo $rowCart['c_itemID'];?>&coid=<?php echo $_GET['client_id'];?>" method="POST">
                                                                    <input type="number" class="form-control" style="width: 70px;" name="quant" min="1" max="20"/> &nbsp
                                                                    <button type="submit" class="btn btn-success btn-sm"><span class="fa fa-cart"></span> Edit cart quantity</button>
                                                                </form>
                                                            </center></td>
                                                            <td><center><a href = "../functions/removeCartAgent.php?id=<?php echo $rowCart['c_itemID'];?>&coid=<?php echo $_GET['client_id'];?>"><button type="button" class="btn btn-danger btn-sm"><b>x</b> Remove from cart</button></a></center></td>
                                                        </tr>
                                            <?php
                                        }
                                    } 
                                } 
                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>

                                    
                                </div>
                                <div class="tab-pane fade" id="bouquet">
                                    <h4>List of available bouquets</h4>  
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th><center>Bouquet ID</center></th>
                                            <th><center>Bouquet Name</center></th>
                                            <th><center>Bouquet</center></th>
                                            <th><center>Modifications<center></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql1="SELECT * FROM bouquet WHERE bo_status !='Archived' ";
                                        $result1=mysqli_query($con, $sql1);
                                                    
                                                    if(mysqli_num_rows($result1) > 0){
                                                        while($row1=mysqli_fetch_array($result1)){
                                        ?>          
                                        <tr class="odd gradeX">
                                            <td><center><?php echo $row1['bo_ID']; ?></center></td>
                                            <td><center><?php echo $row1['bo_name']; ?></center></td>
                                            <td><center><?php echo "PHP " . $row1['bo_price'] . ".00"; ?></center></td>
                                            <?php
                                    
                                            if(!isset($_GET['client_id'])){
                                            ?>
                                            
                                            <td><center><form action="../functions/addToCartB.php?id=<?php echo $row1['bo_ID'];?>&coid=<?php echo $_GET['client_id'];?>" method="POST">
                                                <input type="number" class="form-control" style="width: 70px;" name="quant" disabled /> &nbsp
                                                <button type="submit" class="btn btn-success btn-sm" disabled><span class="fa fa-cart"></span> Add to cart</button>
                                                </form>
                                            </center></td>
                                            <?php
                                            }else{
                                            ?>

                                            <td><center><form action="../functions/addToCartB.php?id=<?php echo $row1['bo_ID'];?>&coid=<?php echo $_GET['client_id'];?>" method="POST">
                                                <input type="number" class="form-control" style="width: 70px;" name="quant" min="1" max ="5"/> &nbsp
                                                <button type="submit" class="btn btn-success btn-sm"><span class="fa fa-cart"></span> Add to cart</button>
                                                </form>
                                            </center></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>  
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
      </div>
        <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
                            <!-- /.modal -->

            <div class="row">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width: 700px;">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Admin's Information</h4>
                                        </div>
                                    <div class="modal-body">
                                        <?php
                                            $user_id=$_SESSION['id'];
                                            $sqlVar="SELECT user.*, branch.* FROM branch LEFT JOIN user ON (branch.b_ID = user.b_id) WHERE u_id='$user_id'";
                                            $resultVar=mysqli_query($con, $sqlVar);
                                            $row6=mysqli_fetch_assoc($resultVar);
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Branch</th>
                                                        <th>Account Privilege Type</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $row6['u_fname'] . " " . $row6['u_mname'] . " " . $row6['u_lname'];?></td>
                                                        <td><?php echo $row6['b_name']; ?></td>
                                                        <td><?php echo $row6['u_position']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <button type="button" onclick="showhide()" class="btn btn-primary btn-md btn-block"><i class="fa fa-edit fa-fw"></i> Update Information</button>
                                            <div id="foo" style = "display:none;">
                                                <div class="panel-body">
                                                 <form method = "POST" action = "../functions/changeInfo.php?id=<?php echo $user_id;?>&user=<?php echo $row6['u_uname'];?>">
                                                    <div class="form-group">
                                                    <label>First Name</label>
                                                    <input class="form-control" name='fname' value='<?php echo $row6['u_fname']; ?>'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input class="form-control" name='mname' value='<?php echo $row6['u_mname']; ?>'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name='lname' value='<?php echo $row6['u_lname']; ?>'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" name='uname' value='<?php echo $row6['u_uname'];?>'>
                                                    </div>
                                                    <br>
                                                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                                                </form>
                                              </div>
                                          </div>
                                          <br>
                                          <a href="#" onclick="showhidePass()"><button type="button" class="btn btn-primary btn-md btn-block"><i class="fa fa-edit fa-fw"></i> Change Password</button></a>
                                            <div id="foo1" style = "display:none;">
                                                <div class="panel-body">
                                                 <form method = "POST" action = "../functions/changePass.php?id=<?php echo $user_id;?>">
                                                    <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control" name='oldPass'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Password</label><br />
                                                    <span class="text-muted small">Your password must be alphanumeric, with a minimum of 1 uppercase letter, 1 number, 1 special character, and is at least 6 characters long.</span>
                                                    <input type="password" class="form-control" name='pword' id="pword" onkeyup="CheckPasswordStrength();" value=''>
                                                    <span id="password_strength" class="password_strength"></span>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Re-enter Password</label>
                                                    <input type="password" class="form-control" name = 'rpword' id="rpword" onkeyup="CheckPasswordStrength();">
                                                    </div>
                                                
                                                    <br />
                                                    <button type="submit" class="btn btn-primary pull-right" id="saveBtn" disabled>Save Changes</button>
                                                </form>
                                                </div>
                                            </div></br>
                                    </div>
                                </div>
                                    <!-- /.modal-content -->
                            </div>
                                <!-- /.modal-dialog -->
                        </div>
                            <!-- /.modal -->    
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width: 700px;">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Client Information</h4>
                                        </div>
                                    <div class="modal-body">

                                                <div class="panel-body">
                                                <form method = "POST" action = "../functions/setClient.php">
                                                    <div class="form-group">
                                                    <label>First Name</label>
                                                    <input class="form-control" name='clientFname'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name='clientLname'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Order Method</label>
                                                <select class="form-control" name="paymentMethod" id="paymentMethod">
                                                    <option value="" disabled selected hidden>Select a payment method...</option> 
                                                    <?php
                                                    $sqlMethod="SELECT * FROM client_order WHERE co_status='Delivering' AND b_id='$condition'";
                                                    $resultMethod=mysqli_query($con, $sqlMethod);
                                                    if(mysqli_num_rows($resultMethod) > 0){
                                                    ?>
                                                    <option value="Walk In">Walk In Order</option>
                                                    <?php    
                                                    } else {
                                                    ?>  
                                                    <option value="Walk In">Walk In Order</option>
                                                    <option value="COD">Phone Order</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                    </div>
                                                    <div class="form-group" id="address" hidden>
                                                    <label>Address</label>
                                                    <input class="form-control" name='address'>
                                                    </div>
                                                    <br>
                                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                                </form>
                                              </div>
                                    </div>
                                </div>
                                    <!-- /.modal-content -->
                            </div>
                                <!-- /.modal-dialog -->
                        </div>
                            <!-- /.modal -->  
            </div>
			
</body>
</html>
<?php
}
else{
	header ("location:../index.php?restricted=true");
}
