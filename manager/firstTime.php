<?php
include('../functions/connect.php');
session_start();

if(isset($_SESSION['user']) && $_SESSION['type'] == 'Branch Manager')
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

    <title>First Time Logging In?</title>
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
</head>
<body>
	                <div class="col-lg-6" style="
				    width: 600px;
				    margin: 50px 0 0 -280px;
				    left: 50%;">
                    
                                        <br />
        <?php
        if(isset($_GET['fail'])){
        ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Something went wrong while processing your request.
            </div>
        <?php
        }

?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <center>First time logging in?</center>
                        </div>
                        <div class="panel-body">
                           <center><p class="text-muted">Please change the password assigned to you.</p></center><br>
                           						<?php
                           						$user_id=$_SESSION['id'];
                           						?>
                            					<form method = "POST" action = "../functions/changePass.php?id=<?php echo $user_id;?>">
                                         
                                                   <div class="form-group">
                                                    <label>Security Question</label>
                                                    <select class="form-control" name="secQuest">
                                                        <option value="" disabled selected hidden>Select a security question...</option>
                                                        <option value="What is the maiden name of your mother?">What is the maiden name of your mother?</option>
                                                        <option value="In which country did you spend your first out-of-country trip?">In which country did you spend your first out-of-country trip?</option>
                                                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                                                        <option value="What is your hometown?">What is your hometown?</option>
                                                        <option value="Where did you meet your spouse?">Where did you meet your spouse?</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Answer</label>
                                                    <input type="text" class="form-control" name='secAns' required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Assigned Password</label>
                                                    <input type="password" class="form-control" name='oldPass'>
                                                    </div>
                                                     <div class="form-group">
                                                    <label>Password</label><br />
													<span class="text-muted small">Your password must be alphanumeric, with a minimum of 1 uppercase letter, 1 number, 1 special character, and is at least 6 characters long.</span>
                                                    <input type="password" class="form-control" name='pword' id="pword" onkeyup="CheckPasswordStrength();">
													<span id="password_strength" class="password_strength"></span>
													</div>
                                                    <div class="form-group">
                                                    <label>Re-enter Password</label>
                                                    <input type="password" class="form-control" name = 'rpword' id="rpword" onkeyup="CheckPasswordStrength();">
                                                    </div>
													<br />
                                                    <button type="submit" class="btn btn-primary pull-right" id="saveBtn" disabled>Save</button>
                                                </form>
                        </div>
                    </div>
                </div>
</body>
</html>
<?php
}
else{
	header ("location:../index.php?restricted=true");
}
