 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleGallery.css">
    <link rel="stylesheet" href="styleHeader.css">
    <script src="scriptGallery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>

<style> 
.person-price-container {
  max-width: 800px;
  margin: 0 auto;

}
.section-wrapper {
  padding-bottom: 200px;
}
section {
  margin-bottom: 50px;
}
.parni {
  background-color: rgb(246, 246, 246);
}
td p {
  padding: 0;
  font-size:8px;
  color: rgb(117, 117, 117);
  margin: 0;
}
.calendar-legend {
  margin: 5px 0;
  height: fit-content;
}
.legend-part {
  height: 25px;
}
.legend-booked {
  padding: 5px 10px;
  background-color: #ffd560;
  border: 1px solid rgb(156, 156, 156);
}
.legend-selected {
  padding: 5px 10px;
  background-color: rgb(93, 247, 255);
  border: 1px solid rgb(156, 156, 156);
}
.legend-available {
  padding: 5px 10px;
  background-color: rgb(255, 255, 255);
  border: 1px solid rgb(156, 156, 156);
}
.gallery-container {
  position: relative;
}
.btn-left, .btn-right {
  z-index: 2;
}
.commodities-item img{
  height: 25px;
}
.commodities-item{
  flex-basis: 250px;
  display: flex;
  justify-content: space-between;
  padding: 5px;
  margin: 5px;
  background-color: rgb(244, 244, 244);
}
.apt-info {
  max-width: 800px;
  text-align: center;
  margin: 0 auto;
}
.text-info {
  max-width: 700px;
}
.text-info {
  margin: 0 auto;
  text-align: left;
}
h2 {
  background-color: #2560e9;
  padding: 1rem;
  margin-top: 0;
  color: white;
}
.button-order {
  background-color: #2560e9;
  padding: 1rem 2rem;
  color:white;
  font-size: x-large;
}
.calendar-header, th {
  background-color: #244287;
}
.calendar-table th {
  background-color: #244287;
}



</style>
    
    <!-- <script type="text/javascript" src="script.js"></script> -->
    <title>Document</title>

</head>
<body>

  <header id="top">
    <div class="header_1_wrapper"> 
        <div class="flex between header_1">
            <div class="home"><a href="#">Apartmani Sekula | Bibinje</a></div>
            <nav>
                <ul class="nav_list flex">
                    <li class="apartmani"><a href="#">APARTMANI <i class="fas fa-list"></i></a>
                        <ul class="dropdown">
                            <li><a href="index.php">MASLINA</a></li>
                            <li><a href="#">LAVANDA</a></li>
                            <li><a href="#">SALVIA</a></li>
                        </ul>
                    </li>
                    <li><a href="#">KONTAKT</a></li>
                    <li><a href="#">U BLIZINI</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="header_2_wrapper">
        <div class="header_2">
            <h1>APARTMANI SEKULA</h1>
            <p>3 apartmana u mirnoj četvrti</p>
        </div>
    </div>
  </header>

  <div class="section-wrapper">
  <!-- prvi -->
  <h2>MASLINA</h2>
  <section class="flex horizontal even neparni">
    <div class="apartment-container flex dir-col">

      <div class="calendar-container" id="calendar-container1">
        
        <div class="calendar-header even">
          <div class="flex-wrapper1">
          <button id="prev-btn1"><</button>
          <select id="month-select1">
            <option value="0">January</option>
            <option value="1">February</option>
            <option value="2">March</option>
            <option value="3">April</option>
            <option value="4">May</option>
            <option value="5">June</option>
            <option value="6">July</option>
            <option value="7">August</option>
            <option value="8">September</option>
            <option value="9">October</option>
            <option value="10">November</option>
            <option value="11">December</option>
          </select>
          <button id="next-btn1">></button></div>
          <select id="year-select1" class="flex-wrapper1"></select>
        </div>
        <table class="calendar-table">
          <thead>
            <tr>
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>
          </thead>
          <tbody id="calendar-body1" class="unloaded"></tbody>
        </table>
        <div class="loader"></div>
      </div>
      <div class="calendar-legend flex even">
        <div class="legend-part">
          <span>Booked:</span><span class="legend-booked"></span>
        </div>
        <div class="legend-part">
          <span>Selected:</span><span class="legend-selected"></span>
        </div>
        <div class="legend-part">
          <span>Available:</span><span class="legend-available"></span>
        </div>
      </div>
      <div class="person-price-container">
        <!-- <div class="flex-wrapper2"> -->
          <div class="person-container flex vertical">
            <span>No. of people</span>
            <select id="person-count1">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="dates-container">
            <span>Check in: </span><input type="text" id="input-check-in1" value="select date" disabled><br>
            <span>Check out: </span><input type="text" id="input-check-out1" value="select date" disabled>
          </div>
        <!-- </div> -->
        <!-- <div class="flex-wrapper2"> -->
          <span class="price-container" id="price-container1">Price: -</span>
          <button id="button-order1" class="button-order">Order</button>
        <!-- </div> -->
      </div>
    </div>
    <div class="gallery-container flex">

      <div class="gallery-main">
        
        <img src="img/lavanda_1.jpg" class="main-img" alt="Image 1" />
        <button class="btn-left"><img src="icon/icons8-left-50.png" alt=""></button>
        <button class="btn-right"><img src="icon/icons8-right-50.png" alt=""></button>
      </div>
      <div class="gallery-preview" id="gallery-preview1">
        <div class="preview-inner">
          <div class="image-container"><img src="img/lavanda_1.jpg" alt="Image 1" data-index="0" class="active" /></div>
          <div class="image-container"><img src="img/lavanda_2.jpg" alt="Image 2" data-index="1" /></div>
          <div class="image-container"><img src="img/lavanda_3.jpg" alt="Image 3" data-index="2" /></div>
          <div class="image-container"><img src="img/lavanda_4.jpg" alt="Image 4" data-index="3" /></div>
          <div class="image-container"><img src="img/terasa_1.jpg" alt="Image 5" data-index="4" /></div>
          <div class="image-container"><img src="img/terasa_2.jpg" alt="Image 6" data-index="5" /></div>
        </div>
      </div>
    </div>

  </section>
  <div class="apt-info">
    <div class="commodities flex dir-col">
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-air-conditioner-50.png" alt=""><span>Air conditioning</span></span>
        <span class="commodities-item"><img src="icon/icons8-grill-50.png" alt=""><span>Grilling equipment</span></span>
        <span class="commodities-item"><img src="icon/icons8-no-smoking-50.png" alt=""><span>No smoking apartments</span></span>
      </div>
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-olive-50.png" alt=""><span>Garden</span></span>
        <span class="commodities-item"><img src="icon/icons8-parking-64.png" alt=""><span>Free parking</span></span>
        <span class="commodities-item"><img src="icon/icons8-terrace-64.png" alt=""><span>Terrace</span></span>
      </div>
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-wifi-30.png" alt=""><span>Free wifi</span></span>
      </div>
    </div>
    <div class="text-info">
      <h3><b>about</b></h3>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias debitis possimus id itaque quos fuga ut laboriosam facere deserunt sunt reiciendis quia nihil natus dignissimos in ratione, beatae voluptatibus rerum.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, soluta alore Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat nisi quo numquam a eum voluptatum quod odit cum dicta reiciendis voluptate, itaque sit, facere assumenda provident ducimus reprehenderit nobis. minima repudiandae nostrum rerum corporis, illo cupiditate asperiores rem laudantium. Ex quod dolores soluta exercitationem ad, magnam quasi provident.</p>
      
    </div>
  </div>
  </div>

  
  


  <!--drugi kalendar  --------------------------- -->
  <!--  -->
  <div class="section-wrapper parni">
  <h2>LAVANDA</h2>
  <section class="flex horizontal even">
    <div class="gallery-container flex">
      <div class="gallery-main">
        <img src="img/maslina_1.jpg" class="main-img" alt="Image 1" />
        <button class="btn-left"><img src="icon/icons8-left-50.png" alt=""></button>
        <button class="btn-right"><img src="icon/icons8-right-50.png" alt=""></button>
      </div>
      <div class="gallery-preview" id="gallery-preview2">
        <div class="preview-inner">
          <div class="image-container"><img src="img/maslina_1.jpg" alt="Image 5" data-index="0" class="active" /></div>
          <div class="image-container"><img src="img/maslina_2.jpg" alt="Image 6" data-index="1" /></div>
          <div class="image-container"><img src="img/maslina_3.jpg" alt="Image 7" data-index="2" /></div>
          <div class="image-container"><img src="img/maslina_4.jpg" alt="Image 8" data-index="3" /></div>
          <div class="image-container"><img src="img/maslina_5.jpg" alt="Image 7" data-index="4" /></div>
          <div class="image-container"><img src="img/maslina_6.jpg" alt="Image 8" data-index="5" /></div>
          <div class="image-container"><img src="img/terasa_1.jpg" alt="Image 9" data-index="6" /></div>
          <div class="image-container"><img src="img/terasa_2.jpg" alt="Image 10" data-index="7" /></div>
        </div>
      </div>
    </div>
    <div class="apartment-container flex dir-col">
      <!-- <h2>Availability Calendar</h2> -->
      <div class="calendar-container" id="calendar-container2">
        <div class="calendar-header even">
          <div class="flex-wrapper1">
            <button id="prev-btn2"><</button>
            <select id="month-select2">
              <option value="0">January</option>
              <option value="1">February</option>
              <option value="2">March</option>
              <option value="3">April</option>
              <option value="4">May</option>
              <option value="5">June</option>
              <option value="6">July</option>
              <option value="7">August</option>
              <option value="8">September</option>
              <option value="9">October</option>
              <option value="10">November</option>
              <option value="11">December</option>
            </select>
            <button id="next-btn2">></button>
          </div>
          <select id="year-select2" class="flex-wrapper1"></select>
        </div>
        <table class="calendar-table">
          <thead>
            <tr>
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>
          </thead>
          <tbody id="calendar-body2" class="unloaded"></tbody>
        </table>
        <div class="loader"></div>
      </div>
      <div class="calendar-legend flex even">
        <div class="legend-part">
          <span>Booked:</span><span class="legend-booked"></span>
        </div>
        <div class="legend-part">
          <span>Selected:</span><span class="legend-selected"></span>
        </div>
        <div class="legend-part">
          <span>Available:</span><span class="legend-available"></span>
        </div>
      </div>
      <div class="person-price-container">
        <!-- <div class="flex-wrapper2"> -->
          <div class="person-container flex vertical">
            <span>No. of people</span>
            <select id="person-count2">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="dates-container">
            <span>Check in: </span><input type="text" id="input-check-in2" value="select date" disabled><br>
            <span>Check out: </span><input type="text" id="input-check-out2" value="select date" disabled>
          </div>
        <!-- </div> -->
        <!-- <div class="flex-wrapper2"> -->
          <span class="price-container" id="price-container2">Price: -</span>
          <button id="button-order2" class="button-order">Order</button>
        <!-- </div> -->
      </div>
    </div>
    

  </section>
  <div class="apt-info">
    <div class="commodities flex dir-col">
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-air-conditioner-50.png" alt=""><span>Air conditioning</span></span>
        <span class="commodities-item"><img src="icon/icons8-grill-50.png" alt=""><span>Grilling equipment</span></span>
        <span class="commodities-item"><img src="icon/icons8-no-smoking-50.png" alt=""><span>No smoking apartments</span></span>
      </div>
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-olive-50.png" alt=""><span>Garden</span></span>
        <span class="commodities-item"><img src="icon/icons8-parking-64.png" alt=""><span>Free parking</span></span>
        <span class="commodities-item"><img src="icon/icons8-terrace-64.png" alt=""><span>Terrace</span></span>
      </div>
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-wifi-30.png" alt=""><span>Free wifi</span></span>
      </div>
    </div>
    <div class="text-info">
      <h3><b>about</b></h3>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias debitis possimus id itaque quos fuga ut laboriosam facere deserunt sunt reiciendis quia nihil natus dignissimos in ratione, beatae voluptatibus rerum.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, soluta alore Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat nisi quo numquam a eum voluptatum quod odit cum dicta reiciendis voluptate, itaque sit, facere assumenda provident ducimus reprehenderit nobis. minima repudiandae nostrum rerum corporis, illo cupiditate asperiores rem laudantium. Ex quod dolores soluta exercitationem ad, magnam quasi provident.</p>
      
    </div>
  </div>
  </div>

  <!--treci kalendar  --------------------------- -->
  <div class="section-wrapper">
  <h2>SALVIA</h2>
  <section class="flex horizontal even neparni">
    <div class="apartment-container flex dir-col">
      <!-- <h2>Availability Calendar</h2> -->
      <div class="calendar-container" id="calendar-container3">
        
        <div class="calendar-header even">
          <div class="flex-wrapper1">
          <button id="prev-btn3"><</button>
          <select id="month-select3">
            <option value="0">January</option>
            <option value="1">February</option>
            <option value="2">March</option>
            <option value="3">April</option>
            <option value="4">May</option>
            <option value="5">June</option>
            <option value="6">July</option>
            <option value="7">August</option>
            <option value="8">September</option>
            <option value="9">October</option>
            <option value="10">November</option>
            <option value="11">December</option>
          </select>
          <button id="next-btn3">></button></div>
          <select id="year-select3" class="flex-wrapper3"></select>
        </div>
        <table class="calendar-table">
          <thead>
            <tr>
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>
          </thead>
          <tbody id="calendar-body3" class="unloaded"></tbody>
        </table>
        <div class="loader"></div>
      </div>
      <div class="calendar-legend flex even">
        <div class="legend-part">
          <span>Booked:</span><span class="legend-booked"></span>
        </div>
        <div class="legend-part">
          <span>Selected:</span><span class="legend-selected"></span>
        </div>
        <div class="legend-part">
          <span>Available:</span><span class="legend-available"></span>
        </div>
      </div>
      <div class="person-price-container">
        <!-- <div class="flex-wrapper2"> -->
          <div class="person-container flex vertical">
            <span>No. of people</span>
            <select id="person-count3">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="dates-container">
            <span>Check in: </span><input type="text" id="input-check-in3" value="select date" disabled><br>
            <span>Check out: </span><input type="text" id="input-check-out3" value="select date" disabled>
          </div>
        <!-- </div> -->
        <!-- <div class="flex-wrapper2"> -->
          <span class="price-container" id="price-container3">Price: -</span>
          <button id="button-order3" class="button-order">Order</button>
        <!-- </div> -->
      </div>
    </div>
    <div class="gallery-container flex">
      <div class="gallery-main">
        <img src="img/salvia_1.jpg" class="main-img" alt="Image 1" />
        <button class="btn-left"><img src="icon/icons8-left-50.png" alt=""></button>
        <button class="btn-right"><img src="icon/icons8-right-50.png" alt=""></button>
      </div>
      <div class="gallery-preview" id="gallery-preview3">
        <div class="preview-inner">
          <div class="image-container"><img src="img/salvia_1.jpg" alt="Image 1" data-index="0" class="active" /></div>
          <div class="image-container"><img src="img/salvia_2.jpg" alt="Image 2" data-index="1" /></div>
          <div class="image-container"><img src="img/salvia_3.jpg" alt="Image 3" data-index="2" /></div>
        </div>
      </div>
    </div>

  </section>
  <div class="apt-info">
    <div class="commodities flex dir-col">
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-air-conditioner-50.png" alt=""><span>Air conditioning</span></span>
        <span class="commodities-item"><img src="icon/icons8-grill-50.png" alt=""><span>Grilling equipment</span></span>
        <span class="commodities-item"><img src="icon/icons8-no-smoking-50.png" alt=""><span>No smoking apartments</span></span>
      </div>
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-olive-50.png" alt=""><span>Garden</span></span>
        <span class="commodities-item"><img src="icon/icons8-parking-64.png" alt=""><span>Free parking</span></span>
        <span class="commodities-item"><img src="icon/icons8-terrace-64.png" alt=""><span>Terrace</span></span>
      </div>
      <div class="commodities-row flex even">
        <span class="commodities-item"><img src="icon/icons8-wifi-30.png" alt=""><span>Free wifi</span></span>
      </div>
    </div>
    <div class="text-info">
      <h3><b>about</b></h3>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias debitis possimus id itaque quos fuga ut laboriosam facere deserunt sunt reiciendis quia nihil natus dignissimos in ratione, beatae voluptatibus rerum.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, soluta alore Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat nisi quo numquam a eum voluptatum quod odit cum dicta reiciendis voluptate, itaque sit, facere assumenda provident ducimus reprehenderit nobis. minima repudiandae nostrum rerum corporis, illo cupiditate asperiores rem laudantium. Ex quod dolores soluta exercitationem ad, magnam quasi provident.</p>
      
    </div>
  </div>
  </div>

  <footer class="parni">
    <div class="footer_wrapper">
        <div class="flex even kontakt">
            <div class="kontakt_div">
                <div>
                    <h4>Kontakt email:</h4>
                    <a href="mailto:ninasekula69@gmail.com" class="lightblue">ninasekula69@gmail.com</a>
                    <br>
                </div>
                <a href="mailto:ninasekula69@gmail.com"><i class="fas fa-envelope fa-2x"></i></a>
            </div>
            <div class="kontakt_div">
                <div>
                    <h4>Kontakt tel:</h4>
                    <a href="tel:+385917390716" class="lightblue">+385 91 7390716</a>
                    <br>
                </div>
                <a href="tel:+385917390716"><i class="fas fa-phone fa-2x"></i></a>
            </div>
            <div class="kontakt_div">
                <div>
                    <h4>Lokacija:</h4>
                    <a href="https://www.google.hr/maps/place/Sekule+ul.+11,+23205,+Bibinje" class="lightblue">Sekule 11 <br>Bibinje 23205</a>
                    <br>
                </div>
                <a href="https://www.google.hr/maps/place/Sekule+ul.+11,+23205,+Bibinje"><i class="fas fa-map-marker-alt fa-2x"></i></a>
            </div>
        </div>
        <div class="back_to_top"><a href="#top"><i class="fas fa-arrow-circle-up fa-2x"></i></a></div>
    </div>
</footer>
</body>


  <!-- script za napraviti kalendar i staviti ono nakon sto se loada -->
<script type="text/javascript" src="scriptButtons.js"></script>
<script  type="text/javascript" src="renderprvi.js"></script>

  <!-- script koji proslijedi varijablu u php -->

<script type="text/javascript">
let bookedDates1;
let prices;
let defaultPrices;
$(document).ready(function() {
  $.ajax({
    url: "get_data.php",
    type: "GET",
    dataType: "json",
    success: function(data) {
      //console.log('jquery'+data); 
      
      bookedDates1 = data.bookings;
      prices = data.priceRanges;
      defaultPrices = data.defaultPrices;
      console.log(defaultPrices);
      let brojevi = ['1', '2', '3'];
      let loaderi = Array.from(document.getElementsByClassName('loader'));
      let unloadedi = Array.from(document.getElementsByClassName('unloaded'));
      brojevi.forEach(element => {
        renderCalendar(currentMonth, currentYear, bookedDates1, element, prices);
      });
      loaderi.forEach(element => {
        element.style.display = 'none';
      });
      unloadedi.forEach(element => {
        element.classList.remove('unloaded');
      });


    },
    error: function(xhr, status, error) {
      console.log(error); // handle the error
    }
  });
});

$(document).ready(function() {
  $('.button-order').click(function() {
    var date = $('#date').val();
    let brojLjudi = document.getElementById(`person-count${checkedApartment}`);
    $.ajax({
      url: 'ajax-val.php',
      method: 'post',
      data: {checkInDate: checkInDate, checkOutDate: checkOutDate, apartment_id: checkedApartment, ppl_count : brojLjudi.value, fromMain: 1},
      success: function(response) {
        if (response == '1') {
          // redirect to reservation.php with data
          var url = 'reservation.php?checkInDate=' + checkInDate + '&checkOutDate=' + checkOutDate + '&apartment_id=' + checkedApartment + '&ppl_count=' + brojLjudi.value;
          window.location.href = url;
        } else {
          console.log(response);
        }
      }
    });
  });
});


</script>


<script src="scriptFunct.js"></script>

</html>
