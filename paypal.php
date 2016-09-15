<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['id']);
unset($_SESSION['type']);


include('functions/connect.php');
include('./vendor/braintree/lib/autoload.php');
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('h72xpyxqtkxhhyhf');
Braintree_Configuration::publicKey('gg6fhtz2cmz9vrym');
Braintree_Configuration::privateKey('4c94b202f9cf0714c3a0f0527aa0b9d9');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umbel - Your Cart</title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />



    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="css/style.violet.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
    <!-- owl carousel css -->

    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#paymentMethod').on('change', function() {
                if ( this.value == 'Paypal')
                {
                    $("#paypal").removeAttr('disabled');
                }
                else
                {
                    $("#paypal").attr('disabled', true);
                }
            });
        });
    </script>
</head>

<body>
<div id="all">

    <header>


        <!-- *** TOP ***
_________________________________________________________ -->

        <div id="top">
            <div class="container">

                <div class="row">
                    <div class="col-xs-5 contact">
                        <p class="hidden-sm hidden-xs">Contact us on -number undecided- or -email undecided-.</p>
                        <p class="hidden-md hidden-lg"><a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a>  <a href="#" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                        </p>
                    </div>
                    <div class="col-xs-7">
                        <div class="social">
                            <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>

                        </div>

                        <div class="login">
                            <a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-sign-in"></i> Sign In</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- *** TOP END *** -->

        <!-- *** NAVBAR ***
_________________________________________________________ -->

        <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

            <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                <div class="container">
                    <div class="navbar-header">

                        <a class="navbar-brand home" href="index.php">
                            <img src="img/logo.png" alt="Umbel logo" class="hidden-xs hidden-sm">
                            <img src="img/logo-small.png" alt="Umbel logo" class="visible-xs visible-sm"><span class="sr-only">Umbel Flower Shop</span>
                        </a>
                        <div class="navbar-buttons">
                            <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                <span class="sr-only">Toggle navigation</span>
                                <i class="fa fa-align-justify"></i>
                            </button>
                        </div>
                    </div>
                    <!--/.navbar-header -->

                    <div class="navbar-collapse collapse" id="navigation">

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li class="dropdown use-yamm yamm-fw">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Producs & Services<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img src="img/floral1.png" class="img-responsive hidden-xs" alt="">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <h5>Products</h5>
                                                        <ul>
                                                            <li><a href="singles.php">Single Bundles</a>
                                                            </li>
                                                            <li><a href="bouquets.php">Arranged Bouquets</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="branches.php">Branches</a>
                            </li>
                            <li>
                                <a href="faq.php">FAQ</a>
                            </li>
                            <li class="dropdown active">
                                <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                        </ul>

                    </div>
                    <!--/.nav-collapse -->

                    <!--/.nav-collapse -->

                </div>

            </div>
        </div>
        <!-- /#navbar -->

</div>

<!-- *** NAVBAR END *** -->

</header>

<!-- *** LOGIN MODAL ***
_________________________________________________________ -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="Login">Umbel Login</h4>
            </div>
            <div class="modal-body">
                <form action="functions/pro_login.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="email_modal" placeholder="username" name="user">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_modal" placeholder="password" name="pass">
                    </div>

                            <p class="text-center">
                                <button class="btn btn-template-main" type="submit" name="login"><i class="fa fa-sign-in"></i> Log in</button> &nbsp
                                <button class="btn btn-template-main" type="submit" name="forgot"><i class="fa fa-lock"></i> Forgot password?</a></button>
                            </p>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- *** LOGIN MODAL END ***
__________________________________________________-->
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 style="font-family: 'Pacifico', Helvetica, sans-serif;"><u>Delivery details</u></h1>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container" style="font-family:'Comfortaa', Helvetica, sans-serif;">

        <div class="row">

            <div class="col-md-9 clearfix" id="checkout" >

                <div class="box">

                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Shipping Details</a>
                            </li>
                            <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                            </li>
                        </ul>

                        <div class="content">
                            <div class="row">
                                <form id="checkout" method="post" action="braintree_checkout.php">
                                    <div id="payment-form"></div>
                                    <center><input type="submit" class="btn btn-template-main" value="Pay PHP <?php echo $_SESSION['grandTotal'] ?>.00"></center>
                                </form>
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="cart.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                            </div>

                        </div>
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-9 -->


            <div class="col-md-3">
                <div class="box" id="order-summary" style="font-family:'Comfortaa', Helvetica, sans-serif;">
                    <div class="box-header">
                        <h3>Order summary</h3>
                    </div>
                    <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Order subtotal</td>
                                <th>PHP <?php
                                    $total=$_SESSION['subtotal'];
                                    $delFee=$_SESSION['delFee'];
                                    $grandTotal=$_SESSION['grandTotal'];
                                    echo $total;?>.00</th>
                            </tr>
                            <tr>
                                <td>Delivery fee</td>
                                <th>PHP <?php echo $delFee;?>.00</th>
                            </tr>
                            <tr>
                            <tr class="total">
                                <td>Total</td>
                                <th>PHP <?php
                                    echo $grandTotal;
                                    ?>.00</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->

<!-- *** FOOTER ***
_________________________________________________________ -->

<footer id="footer">
    <div class="container">
        <!-- /.col-md-3 -->

        <div class="col-md-3 col-sm-6">

            <h4>Contact</h4>
            <?php
            $sql="SELECT * FROM branch WHERE b_id= '0000'";
            $result=(mysqli_query($con, $sql));
            $row=mysqli_fetch_assoc($result);
            ?>
            <p><strong><?php echo $row['b_name'];?></strong>
                <br><?php echo $row['b_stradd'] . ","; ?>
                <br><?php echo $row['b_city'] . ","; ?>
                <br><?php echo $row['b_province'] . ","; ?>
                <br><?php echo $row['b_zip'];?>
                <br>
                <strong>Philippines</strong>
            </p>
            <br>
            <a href="faq.php#cont" class="btn btn-small btn-template-main">Go to contact page</a>

            <hr class="hidden-md hidden-lg hidden-sm">

        </div>
        <!-- /.col-md-3 -->
        <div class="col-md-4 col-sm-6">

            <h4>We'll keep you posted!</h4>
            <br />
            <div class="blog-entries">
                <div class="blog-entries">
                    <div class="item same-height-row clearfix">
                        <div class="name same-height-always">
                            <h5><a href="#"><i class="fa fa-facebook"></i> Like our Facebook page!</a></h5>
                        </div>
                    </div>
                </div>
                <div class="blog-entries">
                    <div class="item same-height-row clearfix">
                        <div class="name same-height-always">
                            <h5><a href="#"><i class="fa fa-google-plus"></i> Connect with us on Google+!</a></h5>
                        </div>
                    </div>
                </div>
                <div class="blog-entries">
                    <div class="item same-height-row clearfix">
                        <div class="name same-height-always">
                            <h5><a href="#"><i class="fa fa-twitter"></i> Follow us on Twitter!</a></h5>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="hidden-md hidden-lg">

        </div>
        <div class="col-md-5  col-sm-6">

            <h4>Umbel Flower Shop</h4>

            <div class="blog-entries">

                <div class="item same-height-row clearfix">
                    <div class="name same-height-always">
                        <p>Anything flower-related? From bundles to flower arrangements, we have it covered! Take a look at our roster of floral products and flower-related services. We'll be sure that you'd enjoy the experience.</p>
                    </div>
                </div>
            </div>

            <hr class="hidden-md hidden-lg">

        </div>
    </div>
    <!-- /.container -->
</footer>
<!-- /#footer -->

<!-- *** FOOTER END *** -->

<!-- *** COPYRIGHT ***
_________________________________________________________ -->

<div id="copyright">
    <div class="container">
        <div class="col-md-12">
            <p class="pull-left">&copy; 2016. The Team Pabebe.</p>
        </div>
    </div>
</div>
<!-- /#copyright -->

<!-- *** COPYRIGHT END *** -->



</div>
<!-- /#all -->
<!-- #### JAVASCRIPT FILES ### -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"></script>
</script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="js/jquery.cookie.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/jquery.parallax-1.1.3.js"></script>
<script src="js/front.js"></script>



<!-- owl carousel -->
<script src="js/owl.carousel.min.js"></script>

<script src="https://js.braintreegateway.com/js/braintree-2.21.0.min.js"></script>

<script>
    var clientToken = "<?php echo Braintree_ClientToken::generate() ?>";
    braintree.setup( clientToken,
        // Replace this with a client token from your server
        "dropin", {
            container: "payment-form"
        });
</script>

</body>

</html>
