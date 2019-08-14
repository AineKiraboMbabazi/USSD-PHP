<?php
//saving details passed to ussd
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        reset_details($phoneNumber);
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
    $fetch =GetAPI("ussd.myfarmnow.com/api/fetchtrialcountposition?phone=$phone");
    $result = to_json_array($fetch);
    $trial_count= intval($result['trial_count']);
    $db_position= intval($result['position']);
    return array('trial_count'=>$trial_count,'position'->$db_position);
}


//function to animal treatment details
function save_treatment($data,$phone,$diseases,$menu,$animals,$vaccines,$text_used){
    $data_sent = ussd_string_to_array($data);
    $position = count($data_sent)-1; 
    $fetched = check_details($phone);
    $tagid = end($data_sent);
    if (is_valid_tagid($tagid)){
        $data_sent= clean_data_set($data_sent,$fetched['trial_count'],$fetched['position']);
        $data = array();
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
     }
    
    else{
        $call =increment_trials($phone,$position);
        if ($call == 1){
            return "END maximum number reached";
        }
        else{
            $str = str_split($text_used);
            $det = check_details($phone);
            return $path = redirect($str,$det['position'],$det['trial_count'],$menu);
        }
            
    }
    //return "END maximum number reached";

}

?>