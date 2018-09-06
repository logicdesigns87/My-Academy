<?php
require_once __DIR__ . '/classes.php';
$user = new Course();

if( $_GET["key"]=="logic123"){
$user->setId($_GET['course']);
$result= $user->addCourseToUser($_GET['user']);
    if ($result!=0 && $result!=-1) {
        $response["success"] = 1;
        $response["message"] = "course successfully added to user.";
    }
    else if($result==-1){
        $response["success"] = -1;
        $response["message"] = "Already added before.";
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Error.";
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>