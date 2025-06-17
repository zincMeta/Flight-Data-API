<?php

set_time_limit(0);
ini_set('memory_limit', '512M');

include_once("simple_html_dom.php");

function GetHtml(){

    $url = "https://www.flightaware.com/live/airport/AYPY";
    $outputFile = "POM-FLIGHT.html";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        $success = file_put_contents($outputFile, $response);
        $html_file = $success ? $outputFile : "failed to fetch data";
        clearstatcache();
    }

    curl_close($ch);
    return $html_file;
}


$flight_data = GetHtml();

if($flight_data == "failed to fetch data"){
    echo "Error" . " : " . $flight_data;
    error_log("Error" . " : ". $flight_data);
    exit;   
}

$html = file_get_html($flight_data);
$tables = $html->find("table");

/* VARIABLES PARAMETER TYPES */

$mode    = $_GET['mode'];
$options = $_GET['option'];

/* ----------------------- */

/* VARIABLES FOR SCHEDULES */

$liveArrivals_data      = array();
$liveDeparture_data     = array();
$enSchedule_data        = array();
$scheduleDeparture_data = array();

/* ----------------------- */


/* LIVE ARRIVALS DATA EXTRACTION */

foreach($tables[0]->find(".smallrow1") as $td1){

    $column_1 = $td1->find("td");
   
    $indentity_row1 = trim($column_1[0]->plaintext);
    $type_row1      = trim($column_1[1]->plaintext);
    $origin_row1    = trim(str_replace("Int'l ",'International', $column_1[2]->plaintext));
    $depart_row1    = trim(str_replace('&nbsp;',' ', $column_1[3]->plaintext));
    $arrive_row1    = trim(str_replace('&nbsp;',' ', $column_1[5]->plaintext));

    
    $Data_liveArrivals_row1 = [
        "mode"      => "Live Arrivals",
        "identity" => $indentity_row1,
        "type"      => $type_row1,
        "origin"    => $origin_row1,
        "depart"    => $depart_row1,
        "arrive"    => $arrive_row1
    ];

    $liveArrivals_data[] = $Data_liveArrivals_row1;
    
}

foreach($tables[0]->find(".smallrow2") as $td2){

    $column_2 = $td2->find("td");
   
    $indentity_row2 = trim($column_2[0]->plaintext);
    $type_row2      = trim($column_2[1]->plaintext);
    $origin_row2    = trim(str_replace("Int'l",'International', $column_2[2]->plaintext));
    $depart_row2    = trim(str_replace('&nbsp;',' ', $column_2[3]->plaintext));
    $arrive_row2    = trim(str_replace('&nbsp;',' ', $column_2[5]->plaintext));

    
    $Data_liveArrivals_row2 = [
        "mode"      => "Live Arrivals",
        "identity" => $indentity_row2,
        "type"      => $type_row2,
        "origin"    => $origin_row2,
        "depart"    => $depart_row2,
        "arrive"    => $arrive_row2
    ];
    
    $liveArrivals_data[] = $Data_liveArrivals_row2;
    
}

/* ----------------------------------------------------- */


/* LIVE DEPARTURES DATA EXTRACTION */

foreach($tables[1]->find(".smallrow1") as $td1){

    $column_1 = $td1->find("td");
   
    $indentity_row1 = trim($column_1[0]->plaintext);
    $type_row1      = trim($column_1[1]->plaintext);
    $origin_row1    = trim(str_replace("Int'l ",'International', $column_1[2]->plaintext));
    $depart_row1    = trim(str_replace('&nbsp;',' ', $column_1[3]->plaintext));
    $arrive_row1    = trim(str_replace('&nbsp;',' ', $column_1[5]->plaintext));

    
    $Data_liveDeparture_row1 = [
        "mode"      => "Live departures",
        "identity" => $indentity_row1,
        "type"      => $type_row1,
        "origin"    => $origin_row1,
        "depart"    => $depart_row1,
        "arrive"    => $arrive_row1
    ];

    $liveDeparture_data[] = $Data_liveDeparture_row1;
    
}

foreach($tables[1]->find(".smallrow2") as $td2){

    $column_2 = $td2->find("td");
   
    $indentity_row2 = trim($column_2[0]->plaintext);
    $type_row2      = trim($column_2[1]->plaintext);
    $origin_row2    = trim(str_replace("Int'l",'International', $column_2[2]->plaintext));
    $depart_row2    = trim(str_replace('&nbsp;',' ', $column_2[3]->plaintext));
    $arrive_row2    = trim(str_replace('&nbsp;',' ', $column_2[5]->plaintext));

    
    $Data_liveDeparture_row2 = [
        "mode"      => "Live departures",
        "identity" => $indentity_row2,
        "type"      => $type_row2,
        "origin"    => $origin_row2,
        "depart"    => $depart_row2,
        "arrive"    => $arrive_row2
    ];
    
    $liveDeparture_data[] = $Data_liveDeparture_row2;
    
}

/* ----------------------------------------------------- */


/* EN ROUTE/SCHEDULES DATA EXTRACTION */

foreach($tables[2]->find(".smallrow1") as $td1){

    $column_1 = $td1->find("td");
   
    $indentity_row1 = trim($column_1[0]->plaintext);
    $type_row1      = trim($column_1[1]->plaintext);
    $origin_row1    = trim(str_replace("Int'l ",'International', $column_1[2]->plaintext));
    $depart_row1    = trim(str_replace('&nbsp;',' ', $column_1[3]->plaintext));
    $arrive_row1    = trim(str_replace('&nbsp;',' ', $column_1[5]->plaintext));

    
    $Data_enSchedules_row1 = [
        "mode"      => "En routes/schedules",
        "identity" => $indentity_row1,
        "type"      => $type_row1,
        "origin"    => $origin_row1,
        "depart"    => $depart_row1,
        "arrive"    => $arrive_row1
    ];

    $enSchedule_data[] = $Data_enSchedules_row1;
    
}

foreach($tables[2]->find(".smallrow2") as $td2){

    $column_2 = $td2->find("td");
   
    $indentity_row2 = trim($column_2[0]->plaintext);
    $type_row2      = trim($column_2[1]->plaintext);
    $origin_row2    = trim(str_replace("Int'l",'International', $column_2[2]->plaintext));
    $depart_row2    = trim(str_replace('&nbsp;',' ', $column_2[3]->plaintext));
    $arrive_row2    = trim(str_replace('&nbsp;',' ', $column_2[5]->plaintext));

    
    $Data_enSchedules_row2 = [
        "mode"      => "En routes/schedules",
        "identity" => $indentity_row2,
        "type"      => $type_row2,
        "origin"    => $origin_row2,
        "depart"    => $depart_row2,
        "arrive"    => $arrive_row2
    ];
    
    $enSchedule_data[] = $Data_enSchedules_row2;
    
}

/* ----------------------------------------------------- */


/* DEPARTURE SCHEDULES DATA EXTRACTION */


foreach($tables[3]->find(".smallrow1") as $td1){

    $column_1 = $td1->find("td");
   
    $indentity_row1 = trim($column_1[0]->plaintext);
    $type_row1      = trim($column_1[1]->plaintext);
    $origin_row1    = trim(str_replace("Int'l ",'International', $column_1[2]->plaintext));
    $depart_row1    = trim(str_replace('&nbsp;',' ', $column_1[3]->plaintext));
    $arrive_row1    = trim(str_replace('&nbsp;',' ', $column_1[5]->plaintext));

    
    $Data_ScheduleDepart_row1 = [
        "mode"      => "Schedule Departures",
        "identity" => $indentity_row1,
        "type"      => $type_row1,
        "origin"    => $origin_row1,
        "depart"    => $depart_row1,
        "arrive"    => $arrive_row1
    ];

    $scheduleDeparture_data[] = $Data_ScheduleDepart_row1;
    
}

foreach($tables[3]->find(".smallrow2") as $td2){

    $column_2 = $td2->find("td");
   
    $indentity_row2 = trim($column_2[0]->plaintext);
    $type_row2      = trim($column_2[1]->plaintext);
    $origin_row2    = trim(str_replace("Int'l",'International', $column_2[2]->plaintext));
    $depart_row2    = trim(str_replace('&nbsp;',' ', $column_2[3]->plaintext));
    $arrive_row2    = trim(str_replace('&nbsp;',' ', $column_2[5]->plaintext));

    
    $Data_ScheduleDepart_row2 = [
        "mode"      => "Schedule Departures",
        "identity" => $indentity_row2,
        "type"      => $type_row2,
        "origin"    => $origin_row2,
        "depart"    => $depart_row2,
        "arrive"    => $arrive_row2
    ];
    
    $scheduleDeparture_data[] = $Data_ScheduleDepart_row2;
    
}

/* ----------------------------------------------------- */


/* ENCODED SCHEDULES VARIABLES FOR OUTPUTING */

$encode_LA_data = json_encode($liveArrivals_data); 
$encode_LD_data = json_encode($liveDeparture_data);
$encode_ES_data = json_encode($enSchedule_data);
$encode_SD_data = json_encode($scheduleDeparture_data);

/* ------------------------------------------- */



/* ------- FUNCTIONS FOR EXECUTION ------ */

function error_param($error){
    $error_msg = [
        "error_msg" =>"Field not matched",
        "field_given" => $error,
        "status" => "error",
        "error" => 1
    ];

    $encode_error = json_encode($error_msg);
    echo "<script>console.table($encode_error)</script>";
}

function All_data($data){
    $content_data = $data;
    echo "<script>console.table($content_data)</script>";
}

function Indentity_data($data){
   $content_data = array();

   foreach($data as $Indentity_data){
       $ident= [
            "mode"     => $Indentity_data["mode"],
            "identity" => $Indentity_data["identity"]
       ];
       $content_data[] = $ident;
   }
 
   $encode_content_data = json_encode($content_data);
   echo "<script>console.table($encode_content_data)</script>";
}

function Type_data($data){
    $content_data = array();
 
    foreach($data as $Type_data){
        $Type= [
            "mode" => $Type_data["mode"],
            "type" => $Type_data["type"]
        ];
        $content_data[] = $Type;
    }
  
    $encode_content_data = json_encode($content_data);
    echo "<script>console.table($encode_content_data)</script>";
}

function Origin_data($data){
    $content_data = array();
 
    foreach($data as $Origin_data){
        $Origin = [
            "mode"   => $Origin_data["mode"],
            "origin" => $Origin_data["origin"]
        ];
        $content_data[] = $Origin;
    }
  
    $encode_content_data = json_encode($content_data);
    echo "<script>console.table($encode_content_data)</script>";
}

function Depart_data($data){
    $content_data = array();
 
    foreach($data as $Depart_data){
        $Depart = [
            "mode"   => $Depart_data["mode"],
            "depart" => $Depart_data["depart"]
        ];
        $content_data[] = $Depart;
    }
  
    $encode_content_data = json_encode($content_data);
    echo "<script>console.table($encode_content_data)</script>";
}

function Arrive_data($data){
    $content_data = array();
 
    foreach($data as $Arrive_data){
        $Arrive = [
            "mode"   => $Arrive_data["mode"],
            "arrive" => $Arrive_data["arrive"]
        ];
        $content_data[] = $Arrive;
    }
  
    $encode_content_data = json_encode($content_data);
    echo "<script>console.table($encode_content_data)</script>";
}

/* --------------------------------------------- */


/* ---- CONDITIONS ---- */

if($mode !== "live arrivals" && $mode !== "live departures" && $mode !== "enschedules" && $mode !== "en routes" && $mode !== "schedule departures"  ){
    error_param($mode);
    exit;
}

# FOR LIVE ARRIVALS

if($mode == "live arrivals"){

    switch($options){

        case "identity":  
            Indentity_data($liveArrivals_data);
            break;
            
        case "type":  
            Type_data($liveArrivals_data);
            break;

        case "origin":
            Origin_data($liveArrivals_data);  
            break;
            
        case "depart":
            Depart_data($liveArrivals_data);  
            break;

        case "arrive":
            Arrive_data($liveArrivals_data);  
            break;
        
        default:
            All_data($encode_LA_data);  
            break;   

    }
}


# FOR LIVE DEPARTURES

if($mode == "live departures"){

    switch($options){

        case "identity":  
            Indentity_data($liveDeparture_data);
            break;
            
        case "type":  
            Type_data($liveDeparture_data);
            break;

        case "origin":
            Origin_data($liveDeparture_data);  
            break;
            
        case "depart":
            Depart_data($liveDeparture_data);  
            break;

        case "arrive":
            Arrive_data($liveDeparture_data);  
            break;
        
        default:
            All_data($encode_LD_data);  
            break;   

    }
}


# FOR EN SCHEDULES

if($mode == "enschedules" || $mode == "en routes" ){

    switch($options){

        case "identity":  
            Indentity_data($enSchedule_data);
            break;
            
        case "type":  
            Type_data($enSchedule_data);
            break;

        case "origin":
            Origin_data($enSchedule_data);  
            break;
            
        case "depart":
            Depart_data($enSchedule_data);  
            break;

        case "arrive":
            Arrive_data($enSchedule_data);  
            break;
        
        default:
            All_data($encode_ES_data);  
            break;   

    }
}

# FOR DEPARTURE SCHEDULES

if($mode == "schedule departures"){

    switch($options){

        case "identity":  
            Indentity_data($scheduleDeparture_data);
            break;
            
        case "type":  
            Type_data($scheduleDeparture_data);
            break;

        case "origin":
            Origin_data($scheduleDeparture_data);  
            break;
            
        case "depart":
            Depart_data($scheduleDeparture_data);  
            break;

        case "arrive":
            Arrive_data($scheduleDeparture_data);  
            break;
        
        default:
            All_data($encode_SD_data);  
            break;   

    }
}


/* ---- END CONDITIONS ---- */
