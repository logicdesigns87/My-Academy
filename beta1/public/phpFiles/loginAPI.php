<?php
require_once __DIR__ . '/classes.php';
$user = new User();

if( $_GET["key"]=="logic123"){
$user->setEmail($_GET["email"]);
$user->setPassword($_GET["password"]);
$result= $user->login();

    if ($result!=0 && $result!=-1) {
        $response["user"] = array();
         $user=array();
    	 $user['id']=$result[0]['id'];
    	 $user['username']=$result[0]['username'];
    	 $user['password']=$result[0]['password'];
    	 $user['email']=$result[0]['email'];
    	 $user['mobile']=$result[0]['phone'];
    	 $user['fid']=$result[0]['fid'];
    	 $user['googleId']=$result[0]['googleid'];
    	 array_push($response["user"],$user);
        
        $response["success"] = 1;
        $response["message"] = "user successfully created.";
        // echoing JSON response
        echo json_encode($response);
        
		
    } 
    else if($result==-1) {
        // failed to insert row
        $response["success"] = -1;
        $response["message"] = "Wrong password.";
 
        // echoing JSON response
        echo json_encode($response);
    }
    
    else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "The account is not existed.";
 
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