<?php
//require menu.php;

// Reads the variables sent via POST

$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
//$phoneNumber =$_POST["phoneNumber"];
 $phoneNumber = ltrim($_POST["phoneNumber"], "+");


 

$text = $_POST["text"];
$items =array();
//array structure of animals
$animals = array("Cattle");
$diseases = array("Mastitis","Brucellosis","East Coast Fever","Helminthiasis","Rabies");
$vaccines = array("Vibriosis","Bovine","Leptospirovis","Neonatal","Heimia");
$register_menu =array(
            "" => register_menu($data),   
            "w" => array(capture_input("NIN"),"name"),
            "ww"=>array(capture_input("District"),"nin"),   
            "www" => array(capture_input("Village"),"district"),
            "wwww" => array(successuful_addition("Farmer"),"village","save_farmer"),
            );
            
$menu = array(
            "" => main_menu(),
            "1" => number_call("Register Animal"),   
            "12" => capture_input("New Number"),
            
            "11"=>select_animal_type(), 
            "12w"=>select_animal_type(),
            
            "11w"=>capture_input("Breed"), 
            "12ww"=>capture_input("Breed"),
            
            "11ww"=>capture_input("Name "), 
            "12www"=>capture_input("Name"),
            
            "11www"=>select_sex(), 
            "12wwww"=>select_sex(),
            
            "11wwww"=>capture_input("Tag Number"), 
            "12wwwww"=>capture_input("Tag Number"),
            
            "11wwwww" => array(successuful_addition("Animal"),"save_animal"),
            "12wwwwww" => array(successuful_addition("Animal"),"save_animal"),
            
            "2" => number_call("Treat Animal"),   
            "22" => capture_input("New Number"),
            
            "21"=>capture_input("Medicine Name "), 
            "22w"=>capture_input("Medicine Name "),
            
            "21w"=>get_disease_list("Cattle"),
            "22ww"=>get_disease_list("Cattle"),
            "21w6"=>capture_input("Disease Name"), 
            "22ww6"=>capture_input("Disease Name"),
            
            "21ww"=>capture_input("Tag Number"),
            "22www"=>capture_input("Tag Number"),
            "21w6w"=>capture_input("Tag Number"),
            "22ww6w"=>capture_input("Tag Number"),
        
            
            "21www"=>array("save_treatment"), 
            "22wwww"=>array("save_treatment"),
            "21w6ww"=>array("save_treatment"), 
            "22ww6ww"=>array("save_treatment"),
            
            "21wwww"=>array("save_treatment"), 
            "22wwwww"=>array("save_treatment"),
            "21w6www"=>array("save_treatment"), 
            "22ww6www"=>array("save_treatment"),
            
            
            "3" => number_call("Vaccinate Animal"),
            
            "32" => capture_input("New Number"),
            
            
            "31"=>get_vaccine_list("Cattle"), 
            "32w"=>get_vaccine_list("Cattle"),
            "316"=>capture_input("Vaccine Name"), 
            "32w6"=>capture_input("Vaccine Name"),
            
            "31w"=>capture_input("Vaccine Used"), 
            "32ww"=>capture_input("Vaccine Used"),
            "316w"=>capture_input("Vaccine Used"), 
            "32w6w"=>capture_input("Vaccine Used"),
            
            "31ww"=>capture_input("Tag Number"), 
            "32www"=>capture_input("Tag Number"),
            "316ww"=>capture_input("Tag Number"),
            "32w6ww"=>capture_input("Tag Number"),

            
            "31www"=>array("save_vaccination"), 
            "32wwww"=>array("save_vaccination"), 
            "316www"=>array("save_vaccination"),  
            "32w6www"=>array("save_vaccination"),
            
            "31wwww"=>array("save_vaccination"), 
            "32wwwww"=>array("save_vaccination"),
            "31w6wwww"=>array("save_vaccination"),  
            "32ww6wwww"=>array("save_vaccination"), 
            
            
            "4" => number_call("Sell Animal"),   
            "42" => capture_input("New Number"),
            
       
            
            "41"=>capture_input("Cost"), 
            "42w"=>capture_input("Cost"),
            
            "41w"=>capture_input("Buyer Number"), 
            "42ww"=>capture_input("Buyer Number"),
            
            "41ww"=>capture_input("Tag Number"), 
            "42www"=>capture_input("Tag Number"),
            
            "41www"=>array(successuful_addition("Transfer"),"sell_animal"), 
            "42wwww"=>array(successuful_addition("Transfer"),"sell_animal"),
            "41wwww"=>array(successuful_addition("Transfer"),"sell_animal"), 
            "42wwwww"=>array(successuful_addition("Transfer"),"sell_animal"),
            
            "5" => number_call("Record Animal Death"),   
            "52" => capture_input("New Number"),
            
            
            
            "51"=>capture_input("Cause Of Death"), 
            "52w"=>capture_input("Cause Of Death"),
            
            "51w"=>capture_input("Tag Number"), 
            "52ww"=>capture_input("Tag Number"),
            
            "51ww"=>array(successuful_addition("Death "),"save_death"), 
            "52www"=>array(successuful_addition("Death"),"save_death"),
            "51www"=>array(successuful_addition("Death "),"save_death"), 
            "52wwww"=>array(successuful_addition("Death"),"save_death"),
            
            
            "6" => number_call("Slaughter Animal"),   
            "62" => capture_input("New Number"),
            
            
            
            "61"=>capture_input("Tag Number"), 
            "62w"=>capture_input("Tag Number"),
            
            "61w"=>capture_input("Tag Number"), 
            "62ww"=>capture_input("Tag Number"),
            
            "61w"=>array(successuful_addition("Slaughter"),"slaughter_animal"), 
            "62ww"=>array(successuful_addition("Slaughter"),"slaughter_animal"),
            "61wxw"=>array(successuful_addition("Slaughter"),"slaughter_animal"), 
            "62wwxw"=>array(successuful_addition("Slaughter"),"slaughter_animal"),
            
            "7" => profile_menu(),   
            "71" => get_profile($phoneNumber),
            "72"=>animal_details($phoneNumber),
            "73"=>capture_input("Tag Number"), 
            "73w"=>array("vaccination_history"),
            
            "74"=>capture_input("Tag Number"), 
            "74w"=>array("vaccination_history"),
            
            "75" => capture_input("New Number"),
            "75w"=>array(successuful_addition("New number"),"save_number"),
            
            
            "8"=>capture_input("Tag Number"), 
            "8w"=>array("report_missing"), 
            
            
            
            "9"=>capture_input("District"),
            "9w"=>capture_input("Village"), 
            "9ww"=>capture_input("Tag Number"), 
            "9www"=>array("report_found"), 
            
          

            
            );
     
//connect to api

//function to get all details
function CallAPI($url, $data)
{
    
    $post = $data;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    
    // execute!
    $response = curl_exec($ch);
    
    // close the connection, release resources used
    curl_close($ch);

    return $response;
}
function GetAPI($url)
{
	$ch = curl_init();  

	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//	curl_setopt($ch,CURLOPT_HEADER, false); 

	$output=curl_exec($ch);

	curl_close($ch);
	return $output;
}

//check phone number
function is_phone_stored($phoneNumber){
    $data = array("phone"=>$phoneNumber);
    $status = CallAPI("ussd.myfarmnow.com/api/verifyphone", $data);
    if($status == 1){
        return true;
    }elseif($status == 0){
        return false;
    }
}
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

function edit_animal($operation,$url,$data){
    //$tagid = $data['tag_id'];
    //if( is_valid_tagid($tagid) ){
        CallAPI($url, $data);
        $response = " $operation information has been successfully Registered";
        return $response;
        
    //}else{
      //  $response =" Animal $tagid doesnot exist";
    //    return $response;
    
    //}
}
// This is the main menu
function register_menu($data){
    //$data_returned = CallAPI("cattle.myfarmnow.com/api/insertsoldanimals",$data);
    $response  = "CON Welcome to My Farm\n";
    //$response .= $data_returned."Ji\n";
    $response  .= "Enter Name\n";
    return $response;
}
function main_menu(){
    $response  = "CON My Farm Dashboard\n";
    $response .= "1. Animal Registration \n";
    $response .= "2. Treat Animal \n";
    $response .= "3. Vaccinate  \n";
    $response .= "4. Sell Animal \n";
    $response .= "5. Record Death \n";
    $response .= "6. Slaughter Animal \n";
    $response .= "7. My Account \n";
    $response .= "8. Missing Animal \n";
    $response .= "9. Found Animal \n";
    
    return $response;
}
function number_call($operationType){
    $response = "CON $operationType for\n";
    $response .= "1. This number \n";
    $response .= "2. Another number \n";
    return $response;
}

function capture_input($inputName){
    $response  = "CON Enter $inputName \n";
    return $response;
}

// Animal type menu
function select_animal_type(){
    $response = "CON AnimalType \n";
    $response .= "1. Cattle \n";
    // $response .= "2. Sheep \n";
    // $response .= "3. Horse \n";
    // $response .= "4. Pig \n";
    // $response .= "5. Cow \n";
    return $response;
}
function select_sex(){
    $response = "CON Sex \n";
    $response .= "1. Female \n";
    $response .= "2. Male \n";
    return $response;
}

// This is the menu for diseases
function get_disease_list($animal_type){
    $response = "CON Select Disease\n";
    $response .= "1. Mastitis \n";
    $response .= "2. Brucellosis \n";
    $response .= "3. East Coast Fever \n";
    $response .= "4. Helminthiasis \n";
    $response .= "5. Rabies \n";
    $response .= "6. Others \n";
    
    return $response;
}

// This is the funtion for vaccine menu
function get_vaccine_list($animal_type){
    $response = "CON Select Vaccination \n";
    $response .= "1. Foot & mouth(FMD) \n";
    $response .= "2. Haemorrhagic(HS) \n";
    $response .= "3. Black Quarter  \n";
    $response .= "4. Brucellosis \n";
    $response .= "5. Theileriosis \n";
    $response .= "6. Others \n";
    
    return $response;
}

// Successful operation message
function successuful_addition($operationType){
    $response = "END $operationType information has been successfully Registered";
    return $response;
}

function profile_menu(){
    $response = "CON Get details \n";
    $response .= "1. User Profile \n";
    $response .= "2. Animal statistics \n";
    $response .= "3 Vaccination history \n";
    $response .= "4 Treatment history \n";
    $response .= "5. Change Number \n";
    return $response;
}
function get_profile($profiletype){
    $response = user_details($profiletype);
    return $response;
}

function get_treatment_history($tagid){
    $response = treatment_details($tagid);
    return $response;
}

// function get_vaccination_history($tagid){
//     $response = vaccination_details($tagid);
//     return $response;
// }



function get_menu($text,$menu,$phone,$animals, $diseases, $vaccines){
        $refined_data =explode("*",$text);
        $text_custom=  $refined_data[count($refined_data)-1];
        if(count($refined_data)>1){
            for($i=count($refined_data)-1; $i>0;$i--){
                    if(($i==1 && $refined_data[0]!=8 && $refined_data[0]!=9 )){
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
                        
                        $result = save_animal($text,$phone,$animals);  
                        return $value[0];
                     }
                     if(in_array("save_treatment", $value)){
                         
                        $result = save_treatment($text,$phone,$diseases,$menu,$animals,$vaccines);  
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
                     
                     
                   return $value[0];
                }else{
                    return $value;
                }
                
            }
            
        }
      
}

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

//function to save farmer details
function save_farmer($data, $phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    $data['name']= $data_sent[0];
    $data['nin']= $data_sent[1];
    $data['district']= $data_sent[2];
    $data['village']=$data_sent[3];
    $data['phone']=$phone;
    return CallAPI("ussd.myfarmnow.com/api/insertfamers", $data);
    // return 1;
}

//function to save animal details
function save_animal($data,$phone, $animals){
    $data_sent = ussd_string_to_array($data);
    //check the length of the data
    //unset($data_sent[0]);
    //unset($data_sent[1]);
    $data = array();
    if(count($data_sent)==7){
        $data['animal_type']= $animals[intval($data_sent[2])-1];
        $data['breed']= $data_sent[3];
        $data['name']= $data_sent[4];
        $data['sex']=$data_sent[5];
        $data['tag_id']= $data_sent[6];
        $data['phone']= $phone;
    }elseif(count($data_sent)==8){
        $data['animal_type']= $animals[intval($data_sent[3])-1];
        $data['breed']= $data_sent[4];
        $data['name']= $data_sent[5];
        $data['sex']=$data_sent[5];
        $data['tag_id']=$data_sent[6];
        $data['phone']=$phone;
    }
    
    return CallAPI("ussd.myfarmnow.com/api/insertanimals", $data);
    //return 1;
}
//function cleandata set
function clean_data_set($a1,$position,$trial_count){
    
$a2 =array();
for($i=0;$i<count($a1);$i++){
    if(!($i>=$position-$trial_count && $i<=$position)){
           array_push($a2,$a1[$i]);
    }
    
}
return $a2;

}

//function to animal treatment details
function save_treatment($data,$phone,$diseases,$menu,$animals,$vaccines){
    // $reset= GetAPI("ussd.myfarmnow.com/resettrialposition?phone=$phone");
    $data_sent = ussd_string_to_array($data);
    // $position = count($data_sent)-1; 
    
    // $fetch =GetAPI("ussd.myfarmnow.com/api/fetchtrialcountposition?phone=$phone");
    // $result = to_json_array($fetch);
    // $trial_count= intval($result['trial_count']);
    // $db_position= intval($result['position']);
    // $tagid = end($data_sent);
    // if (is_valid_tagid($tagid)){
        // $data_sent= clean_data_set($data_sent,$db_position,$trial_count);
        // $data = array();
        if(count($data_sent)==5){
            $data['medicine_name']= $data_sent[2];
            $data['disease']= $diseases[$data_sent[3]-1];
            $data['tag_id']= $data_sent[5];
            $data['phone']= $phone;
        }elseif(count($data_sent)==6 && $data_sent[1]==2){
            $data['medicine_name']= $data_sent[3];
            $data['disease']= $diseases[$data_sent[4]-1];
            $data['tag_id']=$data_sent[5];
            $data['phone']= $phone;
        }elseif(count($data_sent)==6 && $data_sent[1]==1 && $data_sent[3]==6){
            $data['medicine_name']= $data_sent[2];
            $data['disease']= $diseases[$data_sent[4]-1];
            $data['tag_id']=$data_sent[5];
            $data['phone']= $phone;
        }elseif(count($data_sent)==6 && $data_sent[1]==1){
            $data['medicine_name']= $data_sent[2];
            $data['disease']= $diseases[$data_sent[3]-1];
            $data['tag_id']=$data_sent[5];
            $data['phone']= $phone;
        }elseif(count($data_sent)==7 && $data_sent[1]==2){
            $data['medicine_name']= $data_sent[3];
            $data['disease']= $data_sent[4];
            $data['tag_id']=$data_sent[6];
            $data['phone']= $phone;
        }elseif(count($data_sent)==6 && $data_sent[1]==1){
            $data['medicine_name']= $data_sent[2];
            $data['disease']= $diseases[$data_sent[3]-1];
            $data['tag_id']=$data_sent[5];
            $data['phone']= $phone;
        }
        elseif(count($data_sent)==7 && $data_sent[1]==2 && $data_sent[4]==6){
            $data['medicine_name']= $data_sent[3];
            $data['disease']= $diseases[$data_sent[5]-1];
            $data['tag_id']=$data_sent[6];
            $data['phone']= $phone;
        }
        elseif(count($data_sent)==7 && $data_sent[1]==2 ){
            $data['medicine_name']= $data_sent[3];
            $data['disease']= $diseases[$data_sent[4]-1];
            $data['tag_id']=$data_sent[6];
            $data['phone']= $phone;
        }
        elseif(count($data_sent)==7 && $data_sent[1]==1 && $data_sent[3]==6){
            $data['medicine_name']= $data_sent[2];                                                          
            $data['disease']= $diseases[$data_sent[4]-1];
            $data['tag_id']=$data_sent[6];
            $data['phone']= $phone;
        }
        elseif(count($data_sent)==8 ){
            $data['medicine_name']= $data_sent[3];
            $data['disease']= $diseases[$data_sent[5]-1];
            $data['tag_id']=$data_sent[7];
            $data['phone']= $phone;
        }
        
        $response = edit_animal("Treatment","ussd.myfarmnow.com/api/animaltreatment",$data);
        return "END $response ";
    // }
    
    
    // else{
    //     $call =increment_trials($phone,$position);
    //     if ($call == 1){
    //         return "END maximum number reached";
    //     }
    //     else
    //         $str = array('2','1','w','w','w','w','w');
    //         return $path = redirect($str,6,2,$menu);
            
    //  }

}
function increment_trials($phone,$position){
        $data = array('phone' =>$phone, 'position'=>$position);
        $result = CallAPI("ussd.myfarmnow.com/api/trialcount",$data);
       
        return $result;
}

function redirect($stg,$position,$trial,$menu){
   
    $result  = "";
    for($i = 0;$i<count($stg);$i++){
        if($i != 0 && ($i>=($position-$trial)  && $i<=($position))){
            continue;
        }
        else{
            $result.=$stg[$i];
         }//else
        // {
        //     $result.="*".$stg[$i];
        // }
    }
  return $menu[$result];
}

//function to save animal vaccination details
function save_vaccination($data,$phone,$vaccines,$diseases){
    
    $data_sent = ussd_string_to_array($data);
    $data = array();
    if(count($data_sent)==5){
        $data['tag_id']= $data_sent[2];
        $data['vaccine_name']= $vaccines[$data_sent[3]-1];
        $data['disease']=$diseases[$data_sent[4]-1];
        $data['phone']= $phone;
    }elseif(count($data_sent)==6 && $data_sent[1]==2){
        $data['tag_id']= $data_sent[3];
        $data['vaccine_name']= $vaccines[$data_sent[4]-1];
        $data['disease']=$diseases[$data_sent[5]-1];
        $data['phone']= $phone;
    }elseif(count($data_sent)==6 && $data_sent[1]==1 && $data_sent[3]==6){
        $data['tag_id']= $data_sent[2];
        $data['vaccine_name']= $vaccines[$data_sent[4]-1];
        $data['disease']=$diseases[$data_sent[5]-1];
        $data['phone']= $phone;
    }elseif(count($data_sent)==6 && $data_sent[1]==1 && $data_sent[6]==6){
        $data['tag_id']= $data_sent[2];
        $data['vaccine_name']= $vaccines[$data_sent[3]-1];
        $data['disease']=$diseases[$data_sent[5]-1];
        $data['phone']= $phone;
    }elseif(count($data_sent)==7 && $data_sent[1]==1){
        $data['tag_id']= $data_sent[2];
        $data['vaccine_name']= $vaccines[$data_sent[4]-1];
        $data['disease']=$diseases[$data_sent[6]-1];
        $data['phone']= $phone;
    }elseif(count($data_sent)==7 && $data_sent[1]==2 && $data_sent[4]==6){
        $data['tag_id']= $data_sent[3];
        $data['vaccine_name']= $vaccines[$data_sent[5]-1];
        $data['disease']=$diseases[$data_sent[6]-1];
        $data['phone']= $phone;
    }elseif(count($data_sent)==7 && $data_sent[1]==2 && $data_sent[5]==6){
        $data['tag_id']= $data_sent[3];
        $data['vaccine_name']= $vaccines[$data_sent[4]-1];
        $data['disease']=$diseases[$data_sent[6]-1];
        $data['phone']= $phone;
    } if(count($data_sent)==8){
        $data['tag_id']= $data_sent[3];
        $data['vaccine_name']= $vaccines[$data_sent[5]-1];
        $data['disease']=$diseases[$data_sent[7]-1];
        $data['phone']= $phone;
    }

    $response = edit_animal("Vaccination","ussd.myfarmnow.com/api/animalvaccination",$data);
    return "END $response ";
    //return 1;
    }



//function to save sold animal details
function sell_animal($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    if(count($data_sent)==5){
        $data['cost']= $data_sent[2];
        $data['buyer_phone']= $data_sent[3];
        $data['tag_id']= $data_sent[4];
        $data['phone']= $phone;
    }elseif(count($data_sent)==6 && $data_sent[1]==2){
        $data['cost']= $data_sent[3];
        $data['buyer_phone']= $data_sent[4];
        $data['tag_id']= $data_sent[5];
        $data['phone']= $phone;
    }

    $response = edit_animal("Transfer","ussd.myfarmnow.com/api/insertsoldanimals",$data);
    return "END $response ";
    //return 1;
}

//function to slaughtered animal details
function slaughter_animal($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    if(count($data_sent)==3){
        $data['tag_id']= $data_sent[2];
        $data['phone']= $phone;
    }elseif(count($data_sent)==4){
        $data['tag_id']= $data_sent[3];
        $data['phone']= $phone;
    }

    //return 1;
    $response = edit_animal("slaughter","ussd.myfarmnow.com/api/slaughteredanimals",$data);
    return "END $response ";
}

//function to save animal death details
function save_death($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    if(count($data_sent)==4){
        $data['tag_id']= $data_sent[2];
        $data['death_cause']= $data_sent[3];
        $data['phone']= $phone;
    }elseif(count($data_sent)==5 && $data_sent[1]==2){
        $data['tag_id']= $data_sent[3];
        $data['death_cause']= $data_sent[4];
        $data['phone']= $phone;
    }
    
    $response = edit_animal("Animal death","ussd.myfarmnow.com/api/deathrecords",$data);
    return "END $response ";
    //return 1;
}

//function to save missing animal details
function report_missing($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    $data['tag_id']= $data_sent[1];
    $data['phone']= $phone;
    $response = edit_animal("Missing animal","ussd.myfarmnow.com/api/missinganimal",$data);
    return "END $response ";
    //return 1;
}

//function to found animal details
function report_found($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    $data['tag_id']= $data_sent[1];
    $data['location']= $data_sent[2];
    $data['founder_phone']= $phone;
    $data['phone']= $phone;
    $response = edit_animal("Found animal","ussd.myfarmnow.com/api/reportfound",$data);
    return "END $response ";
    

    //return 1;
}
function to_json_array($stg){
    $result = str_replace("[","",$stg);
    $result = str_replace("]","",$result);
    $details_array = json_decode($result, true);
    return $details_array;
}
function animal_details($phoneNumber){
    $animal_result = GetAPI("ussd.myfarmnow.com/fetchnumberofanimalsperfarmer?phone=$phoneNumber");
    $deaths_result = GetAPI("ussd.myfarmnow.com/fetchnumberofanimaldeathsperfarmer?phone=$phoneNumber");
    $missing_result = GetAPI("ussd.myfarmnow.com/fetchnumberofmissinganimalsperfarmer?phone=$phoneNumber");
    $result = str_replace("[","",$animal_result);
    $result = str_replace("]","",$result);
    $details_array = json_decode($result, true);
    $animals =to_json_array($animal_result);
    $deaths =to_json_array($deaths_result);
    $missing =to_json_array($missing_result);
    $str ="";
    $str.="Animal sum: ".$animals['sum']."\n"."Deaths: ".$deaths['sum']."\n"."Missing animals: ".$missing['sum']."\n";
    return "END $str";
    
}
function user_details($phoneNumber){
    $result = GetAPI("ussd.myfarmnow.com/fetchfarmerdetailsbyphone?phone=$phoneNumber");
    $result = str_replace("[","",$result);
    $result = str_replace("]","",$result);
    $details_array = json_decode($result, true);
    $str ="";
    $str.="Name: ".$details_array['name']."\n"."Nin: ".$details_array['nin']."\n"."District: ".$details_array['district']."\n"."Village: ".$details_array['village']."\n";
    return "END $str";
    
}
function treatment_details($tagid,$phoneNumber){
    if (is_valid_tagid($tagid)){
        
       
        $result = GetAPI("ussd.myfarmnow.com/fetchanimaltreatmenthistory?tag_id=$tagid");
        if ($result == "[]"){
            return "END Animal $tagid has no vaccination history";
        }else{
        $result = str_replace("[","",$result);
        $result = str_replace("]","",$result);
        $details_array = json_decode($result, true);
        $str ="";
        $str.="Medicine name: ".$details_array['medicine_name']."\n"."Disease: ".$details_array['disease']."\n"."Treatment date: ".$details_array['created_at']."\n";
        return "END $str";
    }
    }else{

        return "CON Animal $tagid doesnot exist";
    }

}
function vaccination_details($tagid){
    if (is_valid_tagid($tagid)){
        
        $result = GetAPI("ussd.myfarmnow.com/fetchanimalvaccinationhistory?tag_id=$tagid");
        if ($result == "[]"){
            return "END Animal $tagid has no vaccination history";
        }else{
        $result = str_replace("[","",$result);
        $result = str_replace("]","",$result);
        $details_array = json_decode($result, true);
        $str ="";
        $str.="Vaccine name: ".$details_array['vaccine_name']."\n"."Disease: ".$details_array['disease']."\n"."Vaccination date: ".$details_array['created_at']."\n";
        return "END $str";
        
    }
        
    }else{
        return "END Animal $tagid doesnot exist";
    }

}


//function to change string into array
function ussd_string_to_array($ussd_string){
    return explode("*",$ussd_string);
}

if(is_phone_stored($phoneNumber)){
    $response = get_menu($text,$menu,$phoneNumber,$animals,$diseases,$vaccines);
}else{
    $response =get_default_menu($text,$register_menu, $phoneNumber);
}


//echo response
header('Content-type: text/plain');
echo $response



?>

 
   