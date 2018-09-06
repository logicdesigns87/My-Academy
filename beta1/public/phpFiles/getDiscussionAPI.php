<?php
require_once __DIR__ . '/classes.php';
$dis = new Discussion();

if( $_GET["key"]=="logic123"){
$dis->setVideo($_GET['video']);


$result= $dis->getDiscussion($_GET['page'],$_GET['limit']);
    if ($result!=0) {
        $response["questions"]=array();
        for($i=0;$i<count($result);$i++){
            $user=array();
            $user['discussion_id']=$result[$i]['id'];
            $user['name_of_discusser']=$result[$i]['username'];
            $user['video']=$result[$i]['name'];
            $user['user_id']=$result[$i]['user_id'];
            $user['question']=$result[$i]['question'];
            $dis->setQuestion($user['discussion_id']);
            $replies_res=$dis->getReplyDiscussed($_GET['page'],$_GET['limit']);
            $response["replies"]=array();
            for($j=0;$j<count($replies_res);$j++){
                $reply=array();
                $reply['reply']=$replies_res[$j]['id'];
                $reply['relpied_user_id']=$replies_res[$j]['user_id'];
                $reply['reply']=$replies_res[$j]['reply'];
                $reply['question_id']=$replies_res[$j]['question_id'];
                $reply['question']=$replies_res[$j]['question'];
                $reply['replier_username']=$replies_res[$j]['username'];
                array_push($response["replies"],$reply);
            }
            array_push($response["questions"],$user);
        }
        $response["success"] = 1;
        $response["message"] = "Discussion imported.";
    }

    else{
        $response["success"] = 0;
        $response["message"] = "No discussion.";
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>