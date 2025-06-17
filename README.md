# ✈️  FlightAware-API AND Air Niugini API

This project consist of to API demonstrates how to fetch live or simulated flight data. It is a public API that retrieves information such as arrival and departure flights, schedules, routes, flight origins, destinations, and flight names from **Air Niugini** and **Flight Aware**.

---

## 🧰 Requirements for installing this project

- PHP 7.0 or higher  
- Internet connection  
- cURL enabled in your PHP installation  

---

## 📦 Installation

1. Clone the repository or download the PHP file:

    ```bash
    git clone https://github.com/your-username/your-repo-name.git
    ```

2. Navigate into the project directory:

    ```bash
    cd your-repo-name
    ```

3. Run the PHP script using a local server (e.g., XAMPP, MAMP, or PHP’s built-in web server):

    ```bash
    php -S localhost:8000
    ```

4. Visit `http://localhost:8000/index.php` (or your file name) in a web browser.

---

## 💡 Fetch Air Niugini API Example Code in PHP 

```php
<?php

$curl = curl_init();
$url = "https://sweb2.com/SWEB2/projects/flight%20data%20api/air-niugini-api.php?types=arrivals";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
]);

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    echo "cURL Error: $err";
} else {
    echo "<script>console.table($response)</script>";
}

curl_close($curl);
?>
```

### Response JSON

```json
[
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX7140",
    "Origin": "POM",
    "Destinations": "WWK",
    "Scheduled": "6:20 am PGT",
    "Estimate": "6:58 am PGT",
    "Status": "ARRIVED LATE",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX275",
    "Origin": "KVG",
    "Destinations": "RAB",
    "Scheduled": "6:35 am PGT",
    "Estimate": "6:25 am PGT",
    "Status": "ARRIVED ON TIME",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX7244",
    "Origin": "POM",
    "Destinations": "HKN",
    "Scheduled": "6:45 am PGT",
    "Estimate": "6:46 am PGT",
    "Status": "ARRIVED ON TIME",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX100",
    "Origin": "POM",
    "Destinations": "LAE",
    "Scheduled": "6:55 am PGT",
    "Estimate": "6:38 am PGT",
    "Status": "ARRIVED ON TIME",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX7140",
    "Origin": "WWK",
    "Destinations": "VAI",
    "Scheduled": "7:25 am PGT",
    "Estimate": "8:21 am PGT",
    "Status": "ARRIVED LATE",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX9607A",
    "Origin": "MXH",
    "Destinations": "POM",
    "Scheduled": "7:40 am PGT",
    "Estimate": "7:41 am PGT",
    "Status": "ARRIVED ON TIME",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX111",
    "Origin": "MAG",
    "Destinations": "POM",
    "Scheduled": "7:50 am PGT",
    "Estimate": "8:12 am PGT",
    "Status": "ARRIVED LATE",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  },
  {
    "Type": "arrivals",
    "Date": "17/06/2025",
    "Flights": "PX091",
    "Origin": "CNS",
    "Destinations": "POM",
    "Scheduled": "8:30 am PGT",
    "Estimate": "8:45 am PGT",
    "Status": "ARRIVED ON TIME",
    "error_mgs": 0,
    "response_status": 200,
    "parametre_types": "arrivals",
    "parametre_options": null
  }
]


```

## 💡 Fetch FlightAware-API Example Code in PHP 

```php
<?php

$curl = curl_init();
$url = "https://sweb2.com/SWEB2/projects/flight%20data%20api/flight-api.php?mode=live%20arrivals";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
]);

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    echo "cURL Error: $err";
} else {
    echo "<script>console.table($response)</script>";
}

curl_close($curl);
?>
```
### Repsonse JSON
```json 
[
  {
    "mode": "Live Arrivals",
    "identity": "P2-ATE",
    "type": "AT76",
    "origin": "Near Kokoda, Papua New Guinea",
    "depart": "06:53p +10",
    "arrive": "07:16p +10"
  },
  {
    "mode": "Live Arrivals",
    "identity": "P2-ATB",
    "type": "AT76",
    "origin": "Goroka (GKA / AYGA)",
    "depart": "05:49p +10",
    "arrive": "06:49p +10"
  },
  {
    "mode": "Live Arrivals",
    "identity": "P2-ANU",
    "type": "F70",
    "origin": "Goroka (GKA / AYGA)",
    "depart": "05:45p +10",
    "arrive": "06:30p +10"
  },
  { 
    "mode":"Live Arrivals",
    "identity":"P2-ATZ",
    "type":"",
    "origin":"Near Port Moresby",
    "depart":"03:46p +10",
    "arrive":"04:00p +10"
  },
  {
    "mode":"Live Arrivals",
    "identity":"P2-ANU",
    "type":"F70",
    "origin":"Near Kundiawa",
    "depart":"02:50p +10",
    "arrive":"03:32p +10"
  },
  {
    "mode":"Live Arrivals",
    "identity":"P2-MCK",
    "type":"",
    "origin":"Near Kokoda, Papua New Guinea",
    "depart":"03:07p +10",
    "arrive":"03:23p +10"
  }
]

```
## Parameter types & options

There are two parameters **types** and **options**. The "option" parameter is optional hehe😆 unless you want to fetch a specific data from the flights data .

### types 
`arrivals` : Fetch the data for the arrival flights.

`departures` : Fetch the data for the departure flights.

### options

`flights` : Fetch only the **flight** data from arrival or departure flights.

`destination` : Fetch only the **destination** data from arrival or departure flights.

`origin` : Fetch only the **origin** data from arrival or departure flights.

`scheduled` : Fetch only the **scheduled** data from arrival or departure flights.

`estimate` : Fetch only the **estimate** data from arrival or departure flights.

`status` : Fetch only the **status** data from arrival or departure flights.

