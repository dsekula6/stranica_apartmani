<?php

$price;

if (isset($_POST['checkInDate']) && isset($_POST['checkOutDate'])) {
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];

    // Calculate the number of nights
    $startDate = new DateTime($checkInDate);
    $endDate = new DateTime($checkOutDate);

    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'id19100382_apartmani';

    $db = mysqli_connect($host, $username, $password, $dbname);

    if (!$db) {
    die('Could not connect: ' . mysqli_connect_error());
    }

    $apt_id = $_POST['apartment_id'];
    $query = "SELECT start_date, end_date, price, apartment_id FROM priceRanges WHERE apartment_id = $apt_id";
    $result = mysqli_query($db, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Fetch the default price from the 'defaultPrice' table
    $queryDefaultPrice = "SELECT price, apartment_id FROM defaultPrice where apartment_id=$apt_id";
    $resultDefaultPrice = mysqli_query($db, $queryDefaultPrice);
    $rowDefaultPrice = mysqli_fetch_assoc($resultDefaultPrice);
    $defaultPrice = $rowDefaultPrice['price'];

    // Get all the price ranges from the 'priceRanges' table
    $priceRanges = $rows;
    $pricesForEachDay = [];

    function getPriceForADay($date) {
        global $priceRanges, $defaultPrice;
    
        // Check if the date falls within any date range in priceRanges (inclusive)
        foreach ($priceRanges as $range) {
            $startDate = $range['start_date'];
            $endDate = $range['end_date'];
            $price = $range['price'];
        
            if ($date >= $startDate && $date <= $endDate) {
                return $price;
            }
        }
    
        return $defaultPrice;
    }

    // Loop from check-in to check-out date (inclusive)
    for ($date = strtotime($checkInDate); $date < strtotime($checkOutDate); $date = strtotime('+1 day', $date)) {
        $formattedDate = date('Y-m-d', $date);
        $price = getPriceForADay($formattedDate);
        $pricesForEachDay[] = $price;
    }


    $price = array_sum($pricesForEachDay);

    echo $price;
}
?>