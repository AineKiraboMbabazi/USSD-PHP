<?php 
include 'menu.php';
?>

<?php

// Reads the variables sent via POST
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = ltrim($_POST["phoneNumber"], "+");
$text = $_POST["text"];
$items =array();


//check phone number
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function is_phone_stored($phoneNumber){
    $data = array("phone"=>$phoneNumber);
    $status = CallAPI("ussd.myfarmnow.com/api/verifyphone", $data);
    if($status == 1){
        return true;
    }elseif($status == 0){
        return false;
    }
}
//check tag validity
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function is_valid_tagid($tagid){
    $data = array("tag_id"=>$tagid);
    $status = CallAPI("ussd.myfarmnow.com/api/verifytagid", $data);
    if($status == 1){
        return true;
    }elseif($status == 0){
        return false;
    }else{
        return " invalid tag number";
    }
}

//Validate successfully submission
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function edit_animal($operation,$url,$data){
    $tagid = $data['tag_id'];
    //if( is_valid_tagid($tagid) ){
        CallAPI($url, $data);
        $response = " $operation information has been successfully Registered";
        return $response;
        
    //}else{
      //  $response =" Animal $tagid doesnot exist";
        //return $response;
    
    //}
}

//function to get the menu for registered users
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_menu($text,$menu,$phone,$animals, $diseases, $vaccines,$sex){
        $refined_data =explode("*",$text);
        $text_custom=  $refined_data[count($refined_data)-1];
        if(count($refined_data)>1){
            for($i=count($refined_data)-1; $i>0;$i--){
                    if(($i==0 && $refined_data[0]!=8 && $refined_data[0]!=9 )){
                        break;
                    }
                    if($refined_data[$i] != 6){
                        $refined_data[$i]="w";
                    }
                 
            }
            //$refined_data[count($refined_data)-1]="w";
        
        }
        $text_used= implode("",$refined_data);
        //$text= implode("*",$refined_data);
        
        foreach($menu as $key=>$value){
            
            if(strval($key) === $text_used){
                //dd(array($key,$text));
                if(is_array($value)){
                    if(in_array("save_animal", $value)){
                        
                        $result = save_animal($text,$phone, $animals,$sex);  
                        return $value[0];
                     }
                     if(in_array("save_treatment", $value)){
                         
                        $result = save_treatment($text,$phone,$diseases,$menu,$animals,$vaccines,$text_used);  
                        return $result;
                     }
                     if(in_array("save_vaccination", $value)){
                        $result = save_vaccination($text, $phone, $vaccines,$diseases);  
                        return $result;
                     }
                      if(in_array("sell_animal", $value)){
                        $result = sell_animal($text,$phone);  
                        return $result;
                     }
                     if(in_array("slaughter_animal", $value)){
                        $result = slaughter_animal($text,$phone);  
                        return $result;
                     }
                     if(in_array("vaccination_history", $value)){
                        $result = vaccination_details($text_custom);  
                        return $result;
                     }
                     if(in_array("treatment_history", $value)){
                        $result = vaccination_details($text_custom);  
                        return $result;
                     }
                     if(in_array("save_death", $value)){
                        $result = save_death($text,$phone);  
                        return $result;
                     }
                     if(in_array("report_missing", $value)){
                        $result = report_missing($text,$phone);  
                        return $result;
                     }
                     if(in_array("report_found", $value)){
                        $result = report_found($text,$phone);  
                        return $result;
                     }
                     
                     
                   return $value[0].$text_used;
                }else{
                    return $value.$text_used;
                }
                
            }
            
        }
      
}

//function to get menu for unregistered users
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_default_menu($text,$menu, $phoneNumber){
        $refined_data =explode("*",$text);
        $text_custom=  $refined_data[count($refined_data)-1];
        if(count($refined_data)>0 && $text!=""){
            for($i=count($refined_data)-1; $i>=0;$i--){
                if(preg_match("/[a-z]/i", $refined_data[$i])){
                    $refined_data[$i]="w";
                }
                
            }
            //$refined_data[count($refined_data)-1]="w";
        }
        $text_used= implode("",$refined_data);
        //$text= implode("*",$refined_data);
        
        foreach($menu as $key=>$value){
            if(strval($key) === $text_used){
                //dd(array($key,$text));
                if(is_array($value)){
                     if(in_array("save_farmer", $value)){
                        $result = save_farmer($text,$phoneNumber);  
                        return $value[0];
                     }
                     
                     
                   return $value[0];
                }else{
                    return $value;
                }
                
            }
            
        }
      
}

//function to clean a text with wrong input to valid string for menu
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function clean_data_set($a1,$position,$trial_count){
    $a2 =array();
    for($i=0;$i<count($a1);$i++){
        if(!($i>=$position && $i<=$position+$trial_count)){
               array_push($a2,$a1[$i]);
        }
        
    }
    return $a2;
}

//function to increment the trials on wrong input
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function increment_trials($phone,$position){
        $data = array('phone' =>$phone, 'position'=>$position);
        $result = CallAPI("ussd.myfarmnow.com/api/trialcount",$data);
        return $result;
}

//function to redirect to write string in the menu
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function redirect($stg,$position,$trial,$menu){
    
    $result  = "";
    for($i = 0;$i<count($stg);$i++){
        if($i != 0 && ($i>=($position)  && $i<=($position+$trial))){
            continue;
        }
        else{
            $result.=$stg[$i];
           
         }
    }
    // $stg =json_encode($stg);
    //  return "END $stg.$position.$trial.$result";
  return $menu[$result];
}

//function to change the json to an array
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function to_json_array($stg){
    $result = str_replace("[","",$stg);
    $result = str_replace("]","",$result);
    $details_array = json_decode($result, true);
    return $details_array;
}

//function to change string into array
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ussd_string_to_array($ussd_string){
    return explode("*",$ussd_string);
}

//function reset details
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reset_details($phone){
    $data = array('phone' =>$phone);
    $reset= CallAPI("ussd.myfarmnow.com/api/resettrialposition",$data);
    return 1;
}


//calls to show which menu is required at the different stages
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(is_phone_stored($phoneNumber)){
    $response = get_menu($text,$menu,$phoneNumber,$animals,$diseases,$vaccines,$sex);
    
}else{
    $response =get_default_menu($text,$register_menu, $phoneNumber);
    
}
header('Content-type: text/plain');
echo $response



?>

 