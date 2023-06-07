<?php

$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'id19100382_apartmani';

$valid='1';


$db = mysqli_connect($host, $username, $password, $dbname);

if (!$db) {
  die('Could not connect: ' . mysqli_connect_error());
}
//dohvati podatke o tablici
$checkin = $_POST['checkInDate'];
$checkout = $_POST['checkOutDate'];
$checkedApartment = $_POST['apartment_id'];
$fromMain = isset($_POST['fromMain']) ? true : false;

if (!($checkedApartment == '1' || $checkedApartment == '2' || $checkedApartment == '3')) {
  if ($fromMain) {
    exit('krivi id apartmana');
  }
  else{
    $valid = '0';
    header("Location:fail.php");
    exit;
  }
}

//provjera je li datum veci od danasnjeg

$todaysDate = date('Y-m-d');
if (strtotime($checkin) < strtotime($todaysDate)) {
  if ($fromMain) {
    exit('check-in fail');
  }
  else{
    $valid = '0';
    header("Location:fail.php");
    exit;
  }

}
if (strtotime($checkin) >= strtotime($checkout)) {
  if ($fromMain) {
    exit('check-in fail reverse');
  }
  else{
    $valid = '0';
    header("Location:fail.php");
    exit;
  }
}


// prepare statement to select bookings with overlapping dates
$stmt = mysqli_prepare($db, "SELECT start_date, end_date, apartment_id 
                             FROM bookings 
                             WHERE apartment_id = ? AND start_date >= CURDATE() 
                             ORDER BY start_date ASC");

//napravi da ako je prazan rezultat iz baze da exita

mysqli_stmt_bind_param($stmt, "i", $checkedApartment);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// fetch all rows from the result set
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the result set and close the statement
mysqli_free_result($result);
mysqli_stmt_close($stmt);
 

//provjeri je li datum vec u bazi za odredeni apartman
foreach ($rows as $booking) {
  $bookingStartDate = strtotime($booking['start_date']);
  $bookingEndDate = strtotime($booking['end_date']);
  $checkinDate = strtotime($checkin);
  $checkoutDate = strtotime($checkout);

//provjeri je li datum u dozvoljenom odabiru, izmedu check outa ukljucivo i sljedeceg check ina ukljucivo
//selected checkout dozvoli na check in i check out dozvoli na selected check in

  if (($checkinDate >= $bookingStartDate && $checkinDate < $bookingEndDate) ||
  ($checkoutDate > $bookingStartDate && $checkoutDate <= $bookingEndDate) ||
  ($bookingStartDate >= $checkinDate && $bookingStartDate < $checkoutDate) ||
  ($bookingEndDate > $checkinDate && $bookingEndDate <= $checkoutDate)) {
    if ($fromMain) {
      exit("Booking found that overlaps with checkin and checkout dates");
    }
    else{
      $valid = '0';
      header("Location:fail.php");
      exit;
    }
    
   
  }
}

echo '1';


mysqli_close($db);
?>
