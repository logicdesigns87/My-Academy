<?php
require_once __DIR__ . '/classes.php';
$user1 = new User();

if( $_GET["key"]=="logic123"){
$user1->setLimit($_GET["limit"]);
$user1->setPage($_GET["page"]);
$user1->setId($_GET['id']);
$result= $user1->notification();
    if ($result!=0) {
        $response["notifications"] = array();
        for($i=0;$i<count($result);$i++){
             $user=array();
        	 $user['id']=$result[$i]['id'];
        	 $user['name']=$result[$i]['name'];
        	 $user['video']=$result[$i]['video_link'];
        	 $user['description']=$result[$i]['descri'];
        	 $user['live']=$result[$i]['live'];
        	 $user['start_date']=$result[$i]['start_date'];
        	 $user['start_time']=$result[$i]['start_time'];
        	 $user['notification_message']=$result[$i]['notify'];
        	 $user['duration']=$result[$i]['duration'];
        	 $user['course_name']=$result[$i]['course_name'];
        	 $user['color']=$result[$i]['color'];
        	 $user['icon']=$result[$i]['icon'];
        	 array_push($response["notifications"],$user);
        }
        $response["success"] = 1;
        $response["message"] = "courses successfully imported.";
    }
    else{
        $response["success"] = 0;
        $response["message"] = "No courses.";
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>