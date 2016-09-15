<?php
include('../functions/connect.php');
session_start();

if(isset($_SESSION['user']) && $_SESSION['type'] == 'Administrator')
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

    <title>Administrative Panel</title>
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
<script>
function reload(form)
{
var val=form.province.options[form.province.options.selectedIndex].value;
self.location='new_branch.php?province=' + val ;
}
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
                <div class="navbar-brand" href="#">Umbel Administrative Panel</div>
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
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Summary</a>
                        </li>
                        <li>
                            <a href="products.php"><i class="fa fa-list fa-fw"></i> Flowers</a>
                        </li>
                        <li>
                            <a href="bouquets.php"><i class="fa fa-list fa-fw"></i> Bouquet Types</a>
                        </li>
                        <li>
                            <a class="active" href="branches.php"><i class="fa fa-building fa-fw"></i> Branches</a>
                        </li>
                        <li>
                            <a href="employees.php"><i class="fa fa-group fa-fw"></i> Employees</a>
                        </li>
                        <li>
                            <a href="order_report.php"><i class="fa fa-reorder fa-fw"></i> Order Report</a>
                        </li>
                        <li>
                            <a href="branch_order.php"><i class="fa fa-reorder fa-fw"></i> Branch Order</a>
                        </li>
                        <li>
                            <a href="feedback.php"><i class="fa fa-thumbs-up fa-fw"></i> Customer Feedback</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <br>
                <?php
                if(isset($_GET['empty'])){
                ?>
                <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                You must not leave the fields with asterisks empty.
                </div>
                <?php
                 }
                ?>
                <div class="col-lg-12">
                    <h1 class="page-header">Adding a new branch</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                            <form method = "POST" action = "../functions/pro_addBranch.php" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                    <label>Province *</label>
                                                    <select name="province" class="form-control" onchange="reload(this.form)">
													<?php
													$sql = "SELECT * FROM provinces";
													$result=mysqli_query($con, $sql);
													$province=$_GET['province'];
													foreach($result as $row){
													if($row['id']==$province){
													?>
													<option selected value='<?php echo $row['name'];?>'><?php echo $row['name'];?></option>
													<?php
													} else {
													?>
													<option value = "<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
													<?php
													}
													}
													?>
													</select>
                                                    </div>
													<div class="form-group">
													<label>City/Town *</label>
													<select name="city" class="form-control">
													<?php
													$city=$_GET['province'];
													$sql2 = "SELECT * FROM cities WHERE province_id='$city'";
													$result2=mysqli_query($con, $sql2);	
													if(mysqli_num_rows($result2)){
														while($row2=mysqli_fetch_array($result2)){										
													?>
                                                    <option value="<?php echo $row2['name'];?>"><?php echo $row2['name']; ?></option>
													<?php
													}
													}
													?>
													</select>
                                                    </div>
													<div class="form-group">
                                                    <label>Street Address *</label>
                                                    <input class="form-control" name='strAdd' value=''>
                                                    </div>
													<div class="form-group">
													<label>ZIP Code</label>
                                                    <input class="form-control" name='zip' value=''>
                                                    </div>
													<div class="form-group">
                                                    <label>Branch Name *</label>
                                                    <input class="form-control" name='brnName' value=''>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="number" name="brnContact" onkeypress="return isNumberKey(event)" class= "form-control"/> 
                                                    </div>
													<div class="form-group">
                                                    <label>Branch Image:</label>
                                                    <input name="image" type="file" multiple accept='image/*'>
                                                    </div>

													<br />
                                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
													
                                                </form>						
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                   
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
      </div>
        <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
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
            </div>


</body>
</html>
<?php
}
else{
	header ("location:../index.php?restricted=true");
}
