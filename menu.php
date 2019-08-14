<?php
$animals = array("Cattle");
$diseases = array("Mastitis","Brucellosis","East Coast Fever","Helminthiasis","Rabies");
$vaccines = array("Vibriosis","Bovine","Leptospirovis","Neonatal","Heimia");
$sex =array("Female","Male");

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////menus for both default user not registered and registered user/////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$register_menu =array(
            "" => register_menu($data),   
            "w" => array(capture_input("NIN"),"name"),
            "ww"=>array(capture_input("District"),"nin"),   
            "www" => array(capture_input("Village"),"district"),
            "wwww" => array(successuful_addition("Farmer"),"village","save_farmer"),
            );
            
$menu = array(
            "" => main_menu(),
           
            
            "1"=>select_animal_type(), 
            "1w"=>capture_input("Breed"), 
            "1ww"=>capture_input("Name"), 
            "1www"=>select_sex(), 
            "1wwww"=>capture_input("Tag Number"), 
            "1wwwww" => array(successuful_addition("Animal"),"save_animal"),
           
            
            "2"=>capture_input("Medicine Name"), 
            "2w"=>get_disease_list("Cattle"),
            "2w6"=>capture_input("Disease Name"),
            "2ww"=>capture_input("Tag Number"),
            "2w6w"=>capture_input("Tag Number"),
            "2www"=>array("save_treatment"), 
            "2w6ww"=>array("save_treatment"), 

            
            "3"=>get_vaccine_list("Cattle"), 
            "36"=>capture_input("Vaccine Name"), 
            "3w"=>capture_input("Vaccine Used"), 
            "36w"=>capture_input("Vaccine Used"), 
            "3ww"=>capture_input("Tag Number"), 
            "36ww"=>capture_input("Tag Number"),
            "3www"=>array("save_vaccination"), 
            "36www"=>array("save_vaccination"),  
            
            

            "4"=>capture_input("Cost"), 
            "4w"=>capture_input("Buyer Number"), 
            "4ww"=>capture_input("Tag Number"), 
            "4www"=>array(successuful_addition("Transfer"),"sell_animal"), 
            
          
            "5"=>capture_input("Cause Of Death"), 
            "5w"=>capture_input("Tag Number"), 
            "5ww"=>array(successuful_addition("Death "),"save_death"), 
            
            
            "6"=>capture_input("Tag Number"), 
            "6w"=>array(successuful_addition("Slaughter"),"slaughter_animal"), 
            
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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////functions that return menus////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////call apis of post and get method///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//function to get all details type post
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

//function to get all details type get
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

//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////saving details passed to ussd////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
}

//function to animal treatment details
function save_treatment($data,$phone,$diseases,$menu,$animals,$vaccines,$text_used){
    $data_sent = ussd_string_to_array($data);
    $position = count($data_sent)-1;
    $call =increment_trials($phone,$position);
    $fetched = check_details($phone);
    $tagid = end($data_sent);
    if (is_valid_tagid($tagid)){
        reset_details($phoneNumber);
        $data_sent= clean_data_set($data_sent,$fetched['trial_count'],$fetched['position']);
        $data = array();
        if(count($data_sent)==4){
            $data['medicine_name']= $data_sent[1];
            $data['disease']= $diseases[$data_sent[2]-1];
            $data['tag_id']= $data_sent[3];
            $data['phone']= $phone;
        }else{
            $data['medicine_name']= $data_sent[1];
            $data['disease']= $diseases[$data_sent[3]-1];
            $data['tag_id']=$data_sent[4];
            $data['phone']= $phone;
        }
        
        $response = edit_animal("Treatment","ussd.myfarmnow.com/api/animaltreatment",$data);
        return "END $response ";
     }
    
    else{
         $str = str_split($text_used);
          
        
        if ($call == 1){
            reset_details($phoneNumber);
            return "END $position maximum number reached";
        }
        else{
           
          
            $det = check_details($phone);
            return redirect($str,intval($det['position']),intval($det['trial_count']),$menu);
        }
            
    }
    

}


//function to save animal details
function save_animal($data,$phone, $animals,$sex){
    $data_sent = ussd_string_to_array($data);
    
    $data = array();
    $data['animal_type']= $animals[intval($data_sent[1])-1];
    $data['breed']= $data_sent[2];
    $data['name']= $data_sent[3];
    $data['sex']=$sex[intval($data_sent[4])-1];
    $data['tag_id']= $data_sent[5];
    $data['phone']= $phone;
    
    
    return CallAPI("ussd.myfarmnow.com/api/insertanimals", $data);
}
//function to save animal vaccination details
function save_vaccination($data,$phone,$vaccines,$diseases){
    
    $data_sent = ussd_string_to_array($data);
    $data = array();
    if(count($data_sent)==4){
        $data['vaccination']= $data_sent[1];
        $data['vaccine_name']= $vaccines[$data_sent[2]-1];
        $data['tag_id']=$diseases[$data_sent[3]-1];
        $data['phone']= $phone;
    }else{
        $data['vaccination']= $data_sent[2];
        $data['vaccine_name']= $vaccines[$data_sent[3]-1];
        $data['tag_id']=$diseases[$data_sent[4]-1];
        $data['phone']= $phone;
    } 

    $response = edit_animal("Vaccination","ussd.myfarmnow.com/api/animalvaccination",$data);
    return "END $response ";
    }



//function to save sold animal details
function sell_animal($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    
    $data['cost']= $data_sent[1];
    $data['buyer_phone']= $data_sent[2];
    $data['tag_id']= $data_sent[3];
    $data['phone']= $phone;

    $response = edit_animal("Transfer","ussd.myfarmnow.com/api/insertsoldanimals",$data);
    return "END $response ";
}

//function to slaughtered animal details
function slaughter_animal($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    $data['tag_id']= $data_sent[1];
    $data['phone']= $phone;
    

    $response = edit_animal("slaughter","ussd.myfarmnow.com/api/slaughteredanimals",$data);
    return "END $response ";
}

//function to save animal death details
function save_death($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    
    $data['death_cause']= $data_sent[1];
    $data['tag_id']= $data_sent[2];
    $data['phone']= $phone;
    
    $response = edit_animal("Animal death","ussd.myfarmnow.com/api/deathrecords",$data);
    return "END $response ";
    
}
function save_number($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    
    $data['new_number']= $data_sent[2];
    $data['phone']= $phone;
    
    $response = edit_animal("Animal death","ussd.myfarmnow.com/api/editnumber",$data);
    return "END $response ";
    
}

//function to save missing animal details
function report_missing($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    $data['tag_id']= $data_sent[1];
    $data['phone']= $phone;
    $response = edit_animal("Missing animal","ussd.myfarmnow.com/api/missinganimal",$data);
    return "END $response ";
    
}

//function to found animal details
function report_found($data,$phone){
    $data_sent = ussd_string_to_array($data);
    $data = array();
    $data['district']= $data_sent[1];
    $data['village']= $data_sent[2];
    $data['tag_id']= $phone;
    $data['phone']= $phone;
    $response = edit_animal("Found animal","ussd.myfarmnow.com/api/reportfound",$data);
    return "END $response ";
    
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
//function to return checked details
function check_details($phone){
    $fetch =GetAPI("ussd.myfarmnow.com/fetchtrialcountposition?phone=$phone");
    $result = to_json_array($fetch);
    $trial_count= intval($result['trial_count']);
    $db_position= intval($result['position']);
    return array('trial_count'=>$trial_count,'position'->$db_position);
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////functions to get profiles, statistics//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_profile($profiletype){
    $response = user_details($profiletype);
    return $response;
}

function get_treatment_history($tagid){
    $response = treatment_details($tagid);
    return $response;
}

                
?>