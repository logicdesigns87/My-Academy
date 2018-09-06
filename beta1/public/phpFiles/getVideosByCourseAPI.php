<?php
require_once __DIR__ . '/classes.php';
$user = new Course();

if( $_GET["key"]=="logic123"){
$user->setLimit($_GET["limit"]);
$user->setPage($_GET["page"]);
$user->setId($_GET['id']);
$result= $user->getVideosByCourse();
    if ($result!=0) {
        $response["videos"] = array();
        for($i=0;$i<count($result);$i++){
             $user=array();
        	 $user['id']=$result[$i]['id'];
        	 $user['name']=$result[$i]['name'];
        	 $user['video']=$result[$i]['video_link'];
        	 $user['description']=$result[$i]['descri'];
        	 array_push($response["videos"],$user);
        }
        $response["success"] = 1;
        $response["message"] = "videos successfully imported.";
    }
    else{
        $response["success"] = 0;
        $response["message"] = "No videos.";
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>