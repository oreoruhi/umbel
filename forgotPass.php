
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="The Team Pabebe" content="">

    <title>Problem Logging In?</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
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
                                            <br />
        <?php
        if(isset($_GET['wrongAns'])){
        ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Something went wrong with your security question and answer.
            </div>
        <?php
        }
                if(isset($_GET['noUser'])){
        ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            The username you have entered does not exist.
            </div>
        <?php
        }

?>


	                <div class="col-lg-6" style="
				    width: 600px;
				    margin: 50px 0 0 -280px;
				    left: 50%;">

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <center>Problem logging in?</center>
                        </div>
                        <div class="panel-body">
                           <center><p class="text-muted">Provide the needed information below.</p></center><br>
                            					<form method = "POST" action = "changePass.php">
                                                    <div class="form-group">
                                                    <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name='username'>
                                                    </div>
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
                                                    <input type="text" class="form-control" name='secAns'>
                                                    </div>
													<br />
                                                    <button type="submit" class="btn btn-primary pull-right" id="saveBtn">Submit</button>
                                                </form>
                        </div>
                    </div>
                </div>
</body>
</html>

