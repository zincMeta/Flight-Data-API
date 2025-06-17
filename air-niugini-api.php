<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){

    include_once("simple_html_dom.php");

    function getHtml($flight_data){

        $flights = $flight_data;
        
        if($flights == "departures"){   
            return file_get_html("airniugini_flight_departures.html");
        }
        if($flights == "arrivals"){   
            return file_get_html("airniugini_flight_arrivals.html"); 
        }

        return false;
    }

    function error($error_type){
        $error = [
            "error_mgs" => isset($error_type) ? "parametre not matched" : "parametre not given",
            "response_status" => 400,
            "parametre_type" => isset($error_type) ? $error_type : null,
        ];
        $encode_error = json_encode($error);
        echo $encode_error;
        exit;
    }

    function TypeArrival(){       

        $url = "https://www.airniugini.com.pg/book/flight-arrivals/";
        $outputFile = "airniugini_flight_arrivals.html";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            file_put_contents($outputFile, $response);
            clearstatcache();
        }
        curl_close($ch);
 
    }

    function TypeDeparture(){

        $url = "https://www.airniugini.com.pg/book/flight-departures/";
        $outputFile = "airniugini_flight_departures.html";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            file_put_contents($outputFile, $response);
            clearstatcache();
        }

        curl_close($ch);
    }
    
    $Type = $_GET["types"];
    $Options = $_GET['options'];
    
    if($Type == "" || $Type !== "arrivals" && $Type !== "departures"){
        error($Type);
        exit;
    }

    if($Type == "arrivals" && $Options == "flights" || $Options == "origin" || $Options == "destination" || $Options == "scheduled" || $Options == "estimate" || $Options == "status" || $Options == null  ){
        TypeArrival();
        $Arrival =  $Type;
        $html = getHtml($Arrival);
    }
    
    if($Type == "departures" && $Options == "flights" || $Options == "origin" || $Options == "destination" || $Options == "scheduled" || $Options == "estimate" || $Options == "status" || $Options == null){
        TypeDeparture();
        $Departure =  $Type;
        $html = getHtml($Departure);
    }

    if (!$html) {
        $error_html = [
            "error" => true,
            "error_msg" => "Failed to fetch data from air niugini"
        ];
        $encode_error_html = json_encode($error);
        echo $encode_error_html;
    }

    $data = array();
    
    foreach ($html->find("table.apm_table tbody tr") as $row) {
        $columns = $row->find("td");

        if (count($columns) >= 7) {
            
            $date        = trim($columns[0]->plaintext);
            $flight      = trim($columns[1]->plaintext);
            $origin      = trim($columns[2]->plaintext);
            $destination = trim($columns[3]->plaintext);
            $scheduled   = trim($columns[4]->plaintext);
            $estimate    = trim($columns[5]->plaintext);
            $status      = trim($columns[6]->plaintext);

            $data_array = [
                "Type" => $Type,
                "Date" => $date,
                "Flights" => $flight,
                "Origin" => $origin,
                "Destinations" => $destination,
                "Scheduled" => $scheduled,
                "Estimate" => $estimate,
                "Status" => $status,     
                "error_mgs" => 0,
                "response_status" => 200,
                "parametre_types" => $Type,
                "parametre_options" => isset($Options) ? $Options : null
            ];

            $data[]=$data_array;
                    
        }

    }


    function Flights($data_f){

        $Flight_data= $data_f;
        $data = [];

        foreach($Flight_data as $Flight_meta){
            $data[] = array(
                "Type"=> $Flight_meta["Type"],
                "Flight" => $Flight_meta['Flights'],
                "Option" => $Flight_meta['parametre_options']
             );
        }
        
        $encode_data = json_encode($data);
        echo $encode_data;
    }

    function Origin($data_o){
        
        $origin_data = $data_o;
        $data = [];

        foreach($origin_data as $origin_meta){
            $data[] = array(
                "Type"=> $origin_meta["Type"],
                "Origin" => $origin_meta['Origins'],
                "Option" => $origin_meta['parametre_options']
             );
        }

        $encode_data = json_encode($data);
        echo $encode_data;
    }

    function Destination($data_d){

        $Destination_data = $data_d;
        $data = [];

        foreach($Destination_data as $destination_meta){
            $data[] = array(
               "Type"=> $destination_meta["Type"],
               "Destination" => $destination_meta['Destinations'],
               "Option" => $destination_meta['parametre_options']
            );
        }

        $encode_data = json_encode($data);
        echo $encode_data;
    }

    function Scheduled($data_s){

        $scheduleds_data = $data_s;
        $data = [];

        foreach($scheduleds_data as $scheduleds_meta){
            $data[] = array(
               "Type"=> $scheduleds_meta["Type"],
               "Scheduled" => $scheduleds_meta['Scheduled'],
               "Option" => $scheduleds_meta['parametre_options']
            );
        }

        $encode_data = json_encode($data);
        echo $encode_data;
    }

    
    function Estimate($data_e){

        $estimate_data = $data_e;
        $data = [];

        foreach($estimate_data as $estimate_meta){
            $data[] = array(
               "Type"=> $estimate_meta["Type"],
               "Estimate" => $estimate_meta['Estimate'],
               "Option" => $estimate_meta['parametre_options']
            );
        }

        $encode_data = json_encode($data);
        echo $encode_data;
    }
    
    function Status($data_st){

        $status_data = $data_st;
        $data = [];

        foreach($status_data as $status_meta){
            $data[] = array(
               "Type"=> $status_meta["Type"],
               "Status" => $status_meta['Status'],
               "Option" => $status_meta['parametre_options']
            );
        }

        $encode_data = json_encode($data);
        echo $encode_data;
    }

    function AllData($all_data){
        $all = json_encode($all_data);
        echo $all;
    }

    if($Type=="departures" || $Type=="arrivals" ){
        switch($Options){
            case "flights":
                Flights($data);
                break;    
            case "destination":
                Destination($data);
                break;
            case "origin":
                Origin($data);
                break;
            case "scheduled":
                Scheduled($data);
                break;
            case "estimate":
                Estimate($data);
                break;
            case "status":
                Status($data);
                break;

            case null:
             AllData($data);
        }

    }
 
}