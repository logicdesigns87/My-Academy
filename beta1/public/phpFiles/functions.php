<?php
$western_arabic = array('0','1','2','3','4','5','6','7','8','9');
$eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
$ampm = array("am", "pm");
$ampmreplace = array("صباحاً" ,"مساءً");

function offer($old_price,$discount){
    return $old_price-$discount;

}

function isimage($logo){
   // echo $logo;
    if(substr($logo, -3)=='png' || substr($logo, -3)=='PNG' || substr($logo, -3)=='JPG' || substr($logo, -3)=='PEJ'  || substr($logo, -3)=='GIF' || substr($logo, -3)=='jpg' || substr($logo, -3)=='pej' || substr($logo, -3)=='gif'){
        
        return true;
    }
    else{
        return false;
    }
}


function date_in_arabic($date){
global $western_arabic,$eastern_arabic,$ampm,$ampmreplace;
$date=strtotime($date);
$date=date("j-n-Y",$date);
$date= str_replace($western_arabic, $eastern_arabic, $date);
return $date;
}


function number_in_arabic($number){
global $western_arabic,$eastern_arabic,$ampm,$ampmreplace;
$number= str_replace($western_arabic, $eastern_arabic, $number);
return $number;
    
}


function time_in_arabic($time){
global $western_arabic,$eastern_arabic,$ampm,$ampmreplace;
$time= date('g a ', strtotime($time));
$time= str_replace($western_arabic, $eastern_arabic, $time);
$time = str_replace($ampm,$ampmreplace,$time);

return $time;
    
}


function date_in_english($date){
$date=strtotime($date);
$date=date("j-n-Y",$date);
return $date;
}


function number_in_english($number){
return $number;
    
}


function time_in_english($time){
$time= date('g a ', strtotime($time));

return $time;
    
}

function array_sort($array, $on,$page=null,$limit=null, $order=SORT_DESC){

    $new_array = array();
    $sortable_array = array();
    $i=0;
    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$i] = $array[$k];
            $i++;
        }
       
        if($page!=null && $limit!=null){
            if($limit>=count($new_array)){
                $i=count($new_array);
                }   
            else{
                 $i=$limit;
            }
             $new_array = array_chunk($new_array, $i);
            /* echo "<pre>";
             print_r($new_array);*/
             $new_array=$new_array[$page-1];
             if($new_array==null){
                 return 0;
             }
        }
    }

   return $new_array;
   return null;
}

function isemail($a){

    if(substr_count($a,"@") != 1){
        return false;
    }else{
        $b4 = stristr($a,"@",true);
        $b4pos = strripos($b4," ")+1;
        $b4 = trim(substr($b4,$b4pos));
        $after = stristr($a,"@");           
        if(substr_count($after, " ") == 0){
            $after=rtrim($after," .,");
        }else{
            $after=trim(stristr($after," ",true));
        }
        $email = $b4.$after;
       // echo $email;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }   

}