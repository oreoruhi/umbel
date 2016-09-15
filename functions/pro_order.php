<?php
include('connect.php');
session_start();

$name = $_POST['clientFname'] . " " . $_POST['clientLname'];
$address = $_POST['strAdd'] . ", " . $_POST['city'] . ", " . $_POST['province'];
$paymentMethod = $_POST['paymentMethod'];
$total = $_SESSION['grandTotal'];


 // get latitude, longitude and formatted address
    $data_arr = geocode($address);
 
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];

    // function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status'] == 'OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }else{
        return false;
    }
}


$sql="SELECT branch.*, 6371 * 2 * 
      ASIN(SQRT( POWER(SIN(($latitude - abs(branch.b_lat))*pi()/180/2),2)
      +COS($latitude*pi()/180 )*COS(abs(branch.b_lat)*pi()/180)
      *POWER(SIN(($longitude-branch.b_long)*pi()/180/2),2))) 
      as distance, user.* FROM branch 
      LEFT JOIN user
      ON (branch.b_ID = user.b_id)
      WHERE 
      branch.b_long between ($longitude-10/abs(cos(radians($latitude))*69)) 
      and ($longitude+10/abs(cos(radians($latitude))*69)) 
      and branch.b_lat between ($latitude-(10/69)) 
      and ($latitude+(10/69))
      and user.u_position = 'Delivery Man'
      and user.u_status != 'Delivering' 
      having distance < 10 ORDER BY distance limit 1;"; 

$resultQuery = mysqli_query($con, $sql);

if(mysqli_num_rows($resultQuery) > 0){
  $row = mysqli_fetch_assoc($resultQuery);
  $bid = $row['b_ID'];
  if(!empty($_POST['paypal'])){
    $paypal = $_POST['paypal'];
} else{
    $paypal = "";
}
  $coid = 'CO' . rand(10000, 50000);
  $sqlIn = "INSERT INTO client_order (co_ID, co_name, co_payment, co_method, co_paypal, co_date, co_expire, co_address, co_status, b_id) 
            VALUES ('$coid', '$name', '$total', '$paymentMethod', '$paypal', NOW(), NOW() + INTERVAL 30 MINUTE, '$address', 'Delivering', '$bid')";
  mysqli_query($con, $sqlIn);

  $updateStatus = "UPDATE user SET u_status = 'Delivering' WHERE u_position = 'Delivery Man' AND b_id= '$bid'";
  mysqli_query($con, $updateStatus);

  $whereIn = (implode("','", $_SESSION['cart']));
  $sqlQuery = "SELECT product.*, branch.*, stock.* 
              FROM stock
              LEFT JOIN product
              ON (product.p_ID = stock.p_id)
              LEFT JOIN branch
              ON (branch.b_ID = stock.b_id)
              WHERE branch.b_ID = '$bid'
              AND product.p_ID IN ('". $whereIn ."')";
  $result = mysqli_query($con, $sqlQuery);
  $i = 0;
  while($rowQuery = mysqli_fetch_array($result)){
      $value = $_SESSION['cart_qty'][$i];     
      $cid = "C" . rand(10000, 50000);
      $cname = $rowQuery['p_name'];
      $c_itemID = $rowQuery['p_ID'];
      $sqlCart = "INSERT INTO cart (c_ID, c_itemID, c_name, c_quantity, c_status, co_id)
                  VALUES ('$cid', '$c_itemID', '$cname', '$value', 'In Cart', '$coid')";
      mysqli_query($con, $sqlCart);

      $i++;
  }
  $whereCheck = (implode("','", $_SESSION['cart']));
  $sqlCheck = "SELECT * FROM bouquet WHERE bo_ID IN ('". $whereCheck ."')";
  $resultCheck = mysqli_query($con, $sqlCheck);
  while($rowCheck=mysqli_fetch_array($resultCheck)){
      $value = $_SESSION['cart_qty'][$i];     
      $cid2 = "C" . rand(10000, 50000);
      $cname2 = $rowCheck['bo_name'];
      $c_itemID2 = $rowCheck['bo_ID'];
      $sqlCart = "INSERT INTO cart (c_ID, c_itemID, c_name, c_quantity, c_status, co_id)
                  VALUES ('$cid2', '$c_itemID2', '$cname2', '$value', 'In Cart', '$coid')";
      mysqli_query($con, $sqlCart);
      $i++;
  }

    if($paypal != ""){
      $_SESSION['coid'] = $coid;
      header("location:../paypal.php?id=" . $coid);
    } else {
      header("location:../order_review.php?id=" . $coid);
    }
}
else {
	
  header("location:../checkout.php?nonear=true");
}


?>