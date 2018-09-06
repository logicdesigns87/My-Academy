<?php

require_once __DIR__ . '/pdoclass.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/firebase.php';
require_once __DIR__ . '/push.php';

class User{
    private $id;
    private $fullname;
    private $email;
    private $password;
    private $fid;
    private $googleid;
    private $username;
    private $mobile;
    private $tableName="user";
    private $userToken;
    private $page;
    private $limit;
    
    public function __construct() {
	    $this->dataBaseObject= Database::getInstance();
    }
    public function  setPage($id){
        $this->page=$id;
    }
    public function getPage(){
        return $this->page;
    }
    public function  setLimit($id){
        $this->limit=$id;
    }
    public function getLimit(){
        return $this->limit;
    }
    public function  setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function  setFullName($id){
        $this->fullname=$id;
    }
    public function getFullName(){
        return $this->fullname;
    }
    public function  setUserName($id){
        $this->username=$id;
    }
    public function getUserName(){
        return $this->username;
    }
    public function  setEmail($id){
        $this->email=$id;
    }
    public function getEmail(){
        return $this->email;
    }
    public function  setPassword($id){
        $this->password=$id;
    }
    public function getPassword(){
        return $this->password;
    }
    public function  setFid($id){
        $this->fid=$id;
    }
    public function getFid(){
        return $this->fid;
    }
    public function  setGoogleid($id){
        $this->googleid=$id;
    }
    public function getGoogleid(){
        return $this->googleid;
    }
    public function  setMobile($id){
        $this->mobile=$id;
    }
    public function getMobile(){
        return $this->mobile;
    }
    public function setToken($userToken){
        $this->userToken =$userToken;
    }
    public function getToken(){
        return $this->userToken;
    } 

        
    public function send_mail($email,$subject,$mess,$name){
    
        $message=$this->mail_template($name,$mess);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        if(mail($email,$subject,$message,$headers)){
            return true;
            
        }else{
            return false;
        }
    }
    
    public function mail_template($name,$mess){
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$rr= dirname($actual_link);
$message='
                <html>
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <style>
                @import url(https://fonts.googleapis.com/earlyaccess/opensanshebrew.css);
                body{
                width:100% !important;
                background:rgba(128, 128, 128, 0.27) !important;
                font-family: "Open Sans Hebrew" !important;
                }
                .container{
                width:80% !important;
                margin:10px auto !important;
                background:#fff !important;
                }
                .header{
                text-align:center !important; 
                background:#2b2b2b !important;
                padding:1px !important;
                }
                .content{
                padding:10px !important;
                
                }
                a.confirm{
                text-decoration: none;
                color: #fff !important;
                background: #008542;
                padding: 10px;
                border-radius: 3px;
                margin: 5px auto;
                }
                </style>
                </head>
                <body>
                <div class="container">
                <div class="header"><img src="'.$rr.'/images/logo.png"></div>
                <div class="content">
                <h2>Hey '. $name .'</h2>
                '.$mess.'
                </div>
                </div>
                
                </body>
                
                
                </html>';
                return $message;
}

    public function login(){
        
        $email=$this->email;
        $password=$this->password;
        $arryCol=array("id","username","email","phone","password","fid","googleid");
        $whereColArr=array("email","password");
        $wherevalueArr=array($email,$password);
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        if($result==0){
            $arryCol=array("id");
            $whereColArr=array("email");
            $wherevalueArr=array($email);
            $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
            if($result!=0){
                return -1;
            }
        }

        return $result;
    }
    
    public function sendNotify($title,$message,$regId){
    
        $firebase = new Firebase();
        $push = new Push();
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
        $title = isset($title) ? $title : '';
        $message = isset($message) ? $message : '';
        $push->setTitle($title);
        $push->setMessage($message);
        //$push->setImage($image);
        $push->setIsBackground(FALSE);
        //$push->setPayload($payload);
        //$push->setType($type);
        $json = '';
        $response = '';
        $json = $push->getPush();
        $regId = isset($regId) ? $regId : '';
        $response = $firebase->send($regId, $json);
    }
    
    public function sendNotifyIOS($mess,$token){
        if($image==null){
        $image='../images/substitution_ic.jpg';
        }
        $content = array(
        //"en" => 'Testing Message'
        "en"=>$mess
        // "type"=>$type
        );
        $fields = array(
        'app_id' => "6039c9ad-d050-48ba-993d-a84b12a04293",
        //'include_ios_tokens' => array("0d182a59f1a6bdf6139bc40ca7eb078f14905d111b838c39dad512f1d071d605"),
        'include_ios_tokens' => array($token),
        'data' => array("foo" => "bar"),
        'large_icon' =>$image,
        'contents' => $content
        );
        //echo $image;
        $fields = json_encode($fields);
        
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic NjE1NzE0MDUtMjhiZi00OWI1LTkwNTgtY2I0NWEzNzdkNDA2'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function getUserById(){ 
        $arryCol=array("id","username","email","phone","password","fid","googleid","token","tokenios");
        $whereColArr=array("id");
        $wherevalueArr=array($this->id);
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        if($result==0){
            $arryCol=array("id");
            $whereColArr=array("id");
            $wherevalueArr=array($this->id);
            $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
            if($result!=0){
                return -1;
            }
        }

        return $result;
    }
    
    public function signup() {

        if($this->login()==0){

            $arryCol=array("email","password");
            $arrData=array($this->email,$this->password);
            if($this->username != null){
                array_push($arryCol,"username");
                array_push($arrData,$this->username);
            }
            if($this->mobile != null){
                array_push($arryCol,"phone");
                array_push($arrData,$this->mobile);
            }
          

            $result= $this->dataBaseObject->generalInsert($this->tableName,$arryCol,$arrData);
            if($result!=0 && $result!=-1){
               return $this->login();
               // return 1;  //inserted successfully
            }
		
            else if($result==-1){
                $email=$this->email;
                $arryCol=array("id");
                $whereColArr=array("email");
                $wherevalueArr=array($email);
                $resultar = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
                if($resultar!=0){
                    return -1; //duplicated mail and username
                }
                else{
                    return 0;//general error
                }
            }
            else{
                return $result;//general error
            }   
    }
        else {
                $email=$this->email;
                $arryCol=array("id");
                $whereColArr=array("email");
                $wherevalueArr=array($email);
                $resultar = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);

                if($resultar!=0){
                    return -1; //duplicated mail and username
                }
               else{
                    return 0;//general error
                }
        }
}
    
    public function editProfile() {
        $arryCol=array("email","password");
        $arrData=array($this->email,$this->password);
        if($this->username != null){
            array_push($arryCol,"username");
            array_push($arrData,$this->username);
        }
        if($this->mobile != null){
            array_push($arryCol,"phone");
            array_push($arrData,$this->mobile);
        }
        $whereCol='id';
        $whereData=$this->id;
        $result= $this->dataBaseObject->generalUpdate($this->tableName,$arryCol,$arrData,$whereCol,$whereData);
        if($result!=0 && $result!=-1){
           return $this->getUserById();
        }
	
        else if($result==-1){
            $email=$this->email;
            $arryCol=array("id");
            $whereColArr=array("email");
            $wherevalueArr=array($email);
            $resultar = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);

            $username=$this->username;
            $arryCol=array("id");
            $whereColArr=array("username");
            $wherevalueArr=array($username);
            $resultar2 = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
            if($resultar!=0 && $resultar2!=0){
                return -1; //duplicated mail and username
            }
            else if($resultar!=0){
                return -2; //duplicated mail
            }else if($resultar2!=0){
                return -3;  //duplicated username
            }else{
                return 0;//general error
            }
        }
        else{
            return $result;//general error
        }   
      
}
    
    public function forgetPassword() {

        $email=$this->email;

        $arryCol=array("password", "email","username");
        $whereColArr=array("email");
        $wherevalueArr=array($email);
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        if($result!=0){
            $to=$result[0][1];
            $subject="Your Recovered Password";
            $mess="<p> Your Password is : <b>".$result[0][0]."</b></p>";

            if($this->send_mail($to,$subject,$mess,$result[0][2])){
                return 1;
            }else{
                return -1;
            }
        }
        else{
            return 0;
        }

}

    public function loginwithFB() {
        $id=$this->fid;
        $arryCol=array("id","username","email","phone","password","fid","googleid");
        $whereColArr=array("fid");
        $wherevalueArr=array($id);
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        
        
        if($result && ($this->username!=NULL || $this->email!=NULL)){
            $arryCol2=array();
            if($this->username!=NULL){
            array_push($arryCol2,'username');

            } if($this->email!=NULL){
            array_push($arryCol2,'email');

            }

            $arrData2=array();
            if($this->username!=NULL){
                array_push($arrData2,$this->username);
            } if($this->email!=NULL){
                array_push($arrData2,$this->email);
            } 
            $whereCol2="fid";
            $whereID2=$this->fid;
            $this->dataBaseObject->generalUpdate($this->tableName,$arryCol2,$arrData2,$whereCol2,$whereID2);	
        }	
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        return $result;		
    }
    
    public function signupwithFB() {
        if($this->loginwithFB()==0){
            $arryCol=array("fid","username","email");
            $arrData=array($this->fid,$this->username,$this->email);
            $result= $this->dataBaseObject->generalInsert($this->tableName,$arryCol,$arrData);

            if($result!=0 && $result!=-1){
                $whereColArr=array("fid");
                $wherevalueArr=array($this->fid);
                $arryCol=array("id","username","email","phone","password","fid","googleid");
                return $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
                
            }
            else{
                return $result;
            }
        }
        else {
            return $this->loginwithFB();
        }//already has account	
    }

    public function NotificationToken() {
        $id=$this->id;
        $token = $this->userToken;
        $arryCol=array("token");
        $arrData2=array($token);
        $result = $this->dataBaseObject->generalUpdate("users",$arryCol,$arrData2,"id",$id);
        return $result;
        		
    }

    public function loginwithGoogle() {
        $id=$this->googleid;
        $arryCol=array("id","username","email","phone","password","fid","googleid");
        $whereColArr=array("googleid");
        $wherevalueArr=array($id);
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        if($result && ($this->username!=NULL || $this->email!=NULL)){
            $arryCol2=array();
            if($this->username!=NULL){
            array_push($arryCol2,'username');

            } if($this->email!=NULL){
            array_push($arryCol2,'email');

            }

            $arrData2=array();
            if($this->username!=NULL){
            array_push($arrData2,$this->username);
            } if($this->email!=NULL){
            array_push($arrData2,$this->email);
            } 
            $whereCol2="googleid";
            $whereID2=$this->googleid;
            $this->dataBaseObject->generalUpdate($this->tableName,$arryCol2,$arrData2,$whereCol2,$whereID2);	
        }	
        $result = $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
        return $result;		
    }

    public function signupwithGoogle() {
        if($this->loginwithGoogle()==0){
            $arryCol=array("googleid","username","email");
            $arrData=array($this->googleid,$this->username,$this->email);
            $result= $this->dataBaseObject->generalInsert($this->tableName,$arryCol,$arrData);

            if($result!=0 && $result!=-1){
                $whereColArr=array("googleid");
                $wherevalueArr=array($this->googleid);
                $arryCol=array("id","username","email","phone","password","fid","googleid");
                return $this->dataBaseObject->generalSelect($this->tableName,$arryCol,$whereColArr,$wherevalueArr);
                
            }
            else{
                return $result;
            }
        }
        else {
            return $this->loginwithGoogle();
        }//already has account
        
}
	public function getCourses(){
	    return $this->dataBaseObject->getCourses($this->id);
	}   
	public function getVideos($course){
	    return $this->dataBaseObject->getVideos($this->id,$course);
	}
    public function addFavourite($cat){
            $whereColArr=array("user","course");
            $wherevalueArr=array($this->id,$cat);
            $arryCol=array("id");
            $res=$this->dataBaseObject->generalSelect("fav_course",$arryCol,$whereColArr,$wherevalueArr);
            if($res==0){
                $arryCol=array("user","course");
                $arrData=array($this->id,$cat);
                return $result= $this->dataBaseObject->generalInsert("fav_course",$arryCol,$arrData);
            }
            else{
                return -1;
            }
    }
    
    public function deleteFavourite(){
        return $result= $this->dataBaseObject->generalDelete("fav_course","id",$this->id);
    }
    public function getFavourite(){
        return $result= $this->dataBaseObject->getFavourite($this->id,$this->page,$this->limit);
    }
	
	public function search($key){
        return $result= $this->dataBaseObject->search($key,$this->page,$this->limit);
	}
	public function notification(){
        return $result= $this->dataBaseObject->notification($this->id,$this->page,$this->limit);
	}
};

class Course{
    private $id;
    private $name;
    private $page;
    private $limit;
    public function __construct() {
		$this->dataBaseObject= Database::getInstance();
	}
    public function  setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function  setName($id){
        $this->name=$id;
    }
    public function getName(){
        return $this->name;
    }
    
    public function  setPage($id){
        $this->page=$id;
    }
    public function getPage(){
        return $this->page;
    }
    public function  setLimit($id){
        $this->limit=$id;
    }
    public function getLimit(){
        return $this->limit;
    }
    public function getCategories(){
        $arryCol=array("id","name","image");
        return $result = $this->dataBaseObject->generalSelectWithoutCondition("categories",$arryCol,$this->page,$this->limit);
    }
    public function getSlider(){
        return $result = $this->dataBaseObject->getSlider($this->limit);
    }
    public function getMostSeenVideos(){
        return $resultar = $this->dataBaseObject->getMostSeenVideos($this->limit);
    }
    public function getMostRecentCourses(){
        return $resultar = $this->dataBaseObject->getMostRecentCourses($this->limit);
        
    }
    public function getMostRecentCoursesBycats($id){
        return $resultar = $this->dataBaseObject->getMostRecentCoursesBycats($id,$this->limit);
        
    }
    public function getCoursesByCategories(){
        $whereColArr=array("category_id");
        $wherevalueArr=array($this->id);
        $arryCol=array("id","name","descri","price","live","video_link");
        return $this->dataBaseObject->generalSelect("courses",$arryCol,$whereColArr,$wherevalueArr,$this->page,$this->limit);        
    }
    public function getVideosByCourse(){
        $whereColArr=array("course_id");
        $wherevalueArr=array($this->id);
        $arryCol=array("id","name","descri","video_link");
        return $this->dataBaseObject->generalSelect("videos",$arryCol,$whereColArr,$wherevalueArr,$this->page,$this->limit);        
    }

    public function getVideoById(){
        return $this->dataBaseObject->getVideoById($this->id);        
    }
    public function seeVideo(){
        $whereColArr=array("id");
        $wherevalueArr=array($this->id);
        $arryCol=array("seen");
        $seenq=$this->dataBaseObject->generalSelect("videos",$arryCol,$whereColArr,$wherevalueArr);
        $arryCol=array("seen");
        $arrData2=array($seenq[0][0]+1);
        $result = $this->dataBaseObject->generalUpdate("videos",$arryCol,$arrData2,"id",$this->id);       
    }
    
    public function finishVideo($user){
        $arryCol=array("user_id","video_id");
        $arrData=array($user,$this->id);
        return $result= $this->dataBaseObject->generalInsert("video_user",$arryCol,$arrData); 
    }

    public function addCourseToUser($user){
        $whereColArr=array("user","course");
        $wherevalueArr=array($user,$this->id);
        $arryCol=array("id");
        $seenq=$this->dataBaseObject->generalSelect("user_course",$arryCol,$whereColArr,$wherevalueArr);
        if($seenq[0][0]>0){
            return -1;
        }
        $arryCol=array("user","course");
        $arrData=array($user,$this->id);
        return $result= $this->dataBaseObject->generalInsert("user_course",$arryCol,$arrData); 
    }
    
    
};

class Discussion{
    private $user;
    private $question;
    private $reply;
    private $video;

    public function __construct() {
		$this->dataBaseObject= Database::getInstance();
	}
    public function  setUser($id){
        $this->user=$id;
    }
    public function getUser(){
        return $this->user;
    }
    public function  setQuestion($id){
        $this->question=$id;
    }
    public function getQuestion(){
        return $this->question;
    }
    public function  setReply($id){
        $this->reply=$id;
    }
    public function getReply(){
        return $this->reply;
    }
    public function  setVideo($id){
        $this->video=$id;
    }
    public function getVideo(){
        return $this->video;
    }
    
    public function sendQuestion(){
        $arryCol=array("user_id","question","video");
        $arrData=array($this->user,$this->question,$this->video);
        return $result= $this->dataBaseObject->generalInsert("discussion",$arryCol,$arrData);        
    } 
    
    public function sendReply(){
        $arryCol=array("user_id","reply","question_id");
        $arrData=array($this->user,$this->reply,$this->question);
        return $result= $this->dataBaseObject->generalInsert("discussion_reply",$arryCol,$arrData);        
    } 
    
    public function getDiscussion($page,$limit){
        return $result= $this->dataBaseObject->getDiscussion($this->video,$page,$limit);        
        
    }
     
    public function getReplyDiscussed($page,$limit){
        return $result= $this->dataBaseObject->getReply($this->question,$page,$limit);        
        
    }
    
    
};

class Transaction{
	    private $id;
        private $status;
	    private $merchandId;
        private $card_number;
    public function __construct() {
		$this->dataBaseObject= Database::getInstance();
	}
	public function  setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function  setStatus($id){
        $this->status=$id;
    }
    public function getStatus(){
        return $this->status;
    }
    public function  setMerchandId($id){
        $this->merchandId=$id;
    }
    public function getMerchandId(){
        return $this->merchandId;
    }
    public function  setCardNumber($id){
        $this->card_number=$id;
    }
    public function getCardNumber(){
        return $this->card_number;
    }

	public function response(){
        $arryCol=array("status","user_id","card_number");
        $arrData=array($this->status,$this->merchandId,$this->card_number);
        $result= $this->dataBaseObject->generalInsert("transaction",$arryCol,$arrData);
	}
};