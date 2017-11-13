<?php
include "include.php";
		$address = "1770 63rd street, Brooklyn, NY";
    // $address = ",./;''[]";
		$uname = 'a';
		$profile = 'b';
		$googleAddress = str_replace(" ","+",$address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$googleAddress&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        $lat = $response_a->results[0]->geometry->location->lat;
        $long = $response_a->results[0]->geometry->location->lng;
        echo $lat,$long;
        $sql = "select status from member where userid = 4";
        if ($stmt = $mysqli->prepare($sql)){
            // $stmt->bind_param('i', 4);
            $stmt->execute();
            $stmt->bind_result($status);
        }
        $stmt->fetch();
        echo $status;


        			$_SESSION["pName"]=$uname;
					$_SESSION["pAddress"]=$address;
					$_SESSION["pProfile"]=$profile;
					$_SESSION["pLat"]=$lat;
					$_SESSION["pLong"]=$long;
					$_SESSION["show"]=0;
                    $_SESSION["pNorth"]=41.01;
                    $_SESSION["pSouth"]=40.005;
                    $_SESSION["pEast"]=-73.00;
                    $_SESSION["pWest"]=-74.01;
                    $_SESSION["drawRectangle"]=1;
                    $_SESSION["query"]= 'select userid, uname, address, x(locationpoint) as lat, y(locationpoint) as lng, profile from users';
					include "map.php";

// $_SESSION["pProfile"] = '';
// $_SESSION["pName"]='a';
// $_SESSION["pAddress"]='b';
// $_SESSION["pLat"] =43;
// $_SESSION["pLong"]=-12;
// $_SESSION["show"]=0;
// $_SESSION["pNorth"]=41.01;
// $_SESSION["pSouth"]=41.005;
// $_SESSION["pEast"]=-74.00;
// $_SESSION["pWest"]=-74.01;
// $_SESSION["drawRectangle"]=1;
// $_SESSION["query"]= 'select userid, uname, address, x(locationpoint) as lat, y(locationpoint) as lng, profile from users where userid = 6';
// include "map.php";
?>
