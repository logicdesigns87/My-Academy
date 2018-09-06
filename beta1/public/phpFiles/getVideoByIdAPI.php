<?php
require_once __DIR__ . '/classes.php';
$user = new Course();

if( $_GET["key"]=="logic123"){
$user->setId($_GET['id']);
$result= $user->getVideoById();
$user->seeVideo();
    if ($result!=0) {
        $response["videos"] = array();
        for($i=0;$i<count($result);$i++){
             $user=array();
        	 $user['id']=$result[$i]['id'];
        	 $user['name']=$result[$i]['name'];
        	 $user['video']=$result[$i]['video_link'];
        	 $user['description']=$result[$i]['descri'];
        	 $user['image']=$result[$i]['image'];
        	 $user['time_inserted']=$result[$i]['time_inserted'];
        	 $user['start_date']=$result[$i]['start_date'];
        	 $user['start_time']=$result[$i]['start_time'];
        	 $user['live']=$result[$i]['live'];
        	 $user['icon']=$result[$i]['icon'];
        	 $user['color']=$result[$i]['color'];
        	 $user['created_by']=$result[$i]['created_by'];
        	 $user['duration']=$result[$i]['duration'];
        	 $user['course']=$result[$i]['course_name'];
        	 $user['rate']=$result[$i]['rate'];
        	 $user['seen']=$result[$i]['seen'];
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