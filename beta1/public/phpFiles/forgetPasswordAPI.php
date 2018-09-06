<?php
require_once __DIR__ . '/classes.php';
$user = new User();

if( $_GET["key"]=="logic123"){
$user->setEmail($_GET["email"]);
$result= $user->forgetPassword();

    if ($result!=0 && $result!=-1) {
        $response["success"] = 1;
        $response["message"] = "password sent succesfully.";
        // echoing JSON response
        echo json_encode($response);
        
		
    } 
    else if($result==-1) {
        // failed to insert row
        $response["success"] = -1;
        $response["message"] = "error in sending mail.";
 
        // echoing JSON response
        echo json_encode($response);
    }
    
    else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Wrong mail.";
 
        // echoing JSON response
        echo json_encode($response);
    }
	
	
}
else{
	//echo "valid key";
}

//$datbase= Database::getInstance();
//print_r($datbase->getPlayGroundAvialble("2017-03-23" ,"04:00:00","06:00:00",3,1));

// if( $_GET["Logic123"]){//check key
// 	
// }//end check key for access
// else{
// 	
// }





?>