<?php
include('connect.php');

$id = $_GET['id'];

$sql = "SELECT * FROM branch WHERE b_ID = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$address = $row['b_stradd'] . ", " . $row['b_city'] . ", " . $row['b_province'] . ", Philippines";

    // get latitude, longitude and formatted address
    $data_arr = geocode($address);
 
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];

$query = "UPDATE branch SET b_lat = '$latitude', b_long = '$longitude' WHERE b_ID = '$id'";

if(mysqli_query($con, $query)){
	header("location: ../admin/branches.php?updated=true");
} else {
    header("location: ../admin/edutBranch.php?id=" . $id . "&fail=true");
}

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
?>