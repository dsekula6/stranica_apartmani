<?php
header('Content-Type: application/json');

$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'id19100382_apartmani';

$db = mysqli_connect($host, $username, $password, $dbname);

if (!$db) {
  die('Could not connect: ' . mysqli_connect_error());
}

// dohvacanje podataka iz bookings
$query = "SELECT start_date, end_date, apartment_id FROM bookings";
$result = mysqli_query($db, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// dohvacanje cijena
$query = "SELECT start_date, end_date, price, apartment_id FROM priceRanges";
$result = mysqli_query($db, $query);
$rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch the default price from the 'defaultPrice' table
$queryDefaultPrice = "SELECT price, apartment_id FROM defaultPrice";
$resultDefaultPrice = mysqli_query($db, $queryDefaultPrice);
$rowDefaultPrice = mysqli_fetch_all($resultDefaultPrice);

// Combine the results into a single array
$data = array(
  'bookings' => $rows,
  'priceRanges' => $rows2,
  'defaultPrices' => $rowDefaultPrice
);

// Encode the data as JSON and echo it
echo json_encode($data);

mysqli_close($db);
?>
