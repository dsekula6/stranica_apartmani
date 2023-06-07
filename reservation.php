<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
      const currentDate = new Date();
      let currentMonth = currentDate.getMonth();
      let currentYear = currentDate.getFullYear();
      let currentMonths = [currentMonth];
      let currentYears = [currentYear];
      let bookedDates1; 
      


      $(document).ready(function() {
        bookedDates1 = [{start_date: '<?php echo isset($_GET['checkInDate']) ? $_GET['checkInDate'] : '2001-01-01'; ?>',
                                           end_date: '<?php echo isset($_GET['checkOutDate']) ? $_GET['checkOutDate'] : '2001-01-02'; ?>', 
                                           apartment_id: '1'}];
        renderCalendar(currentMonth, currentYear, bookedDates1, '1');

        $.ajax({
          url: 'get_price.php',
          type: 'POST',
          data: {
            checkInDate: '<?php echo isset($_GET['checkInDate']) ? $_GET['checkInDate'] : '2001-01-01'; ?>',
            checkOutDate: '<?php echo isset($_GET['checkOutDate']) ? $_GET['checkOutDate'] : '2001-01-02'; ?>',
            ppl_count: '<?php echo isset($_GET['ppl_count']) ? $_GET['ppl_count'] : '1'; ?>',
            apartment_id: '<?php echo isset($_GET['apartment_id']) ? $_GET['apartment_id'] : '1'; ?>'
          },
          
          success: function(response) {
            $('#price').html(response + '€');
            var price = parseInt(response * 100); // Assuming the price returned from get_price.php is a numeric value
            var stripeButton = $('<script/>', {
              class: 'stripe-button',
              src: 'https://checkout.stripe.com/checkout.js',
              'data-key': 'pk_test_51N8iGcJP99waCG4ijvYy5OrysFUawIHQi7i9SHcUQ0lUCXJjNMMOoDqHMZKNqprKuCZWCHC5OWAFevYitecNo3lZ00iq8pdfTC',
              'data-amount': price,
              'data-name': '<?php echo isset($_GET['apartment_id']) ? $_GET['apartment_id'] : '1'; ?>',
              'data-description': '<?php echo isset($_GET['checkInDate']) ? $_GET['checkInDate'] : '2001-01-01'; ?>-<?php echo isset($_GET['checkOutDate']) ? $_GET['checkOutDate'] : '2001-01-02'; ?>',
              'data-currency': 'eur',
              'data-locale': 'auto'
            });
            $('.reservation-form').append(stripeButton);

          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      });
    </script>
    <style>
body {
  max-width: 1000px;
  margin: 0 auto;
  font-family: Arial, sans-serif;
}
section {
    display: flex;
    align-items: center;
    /* justify-content: space-evenly; */
}
.apartment-container {
    flex: 1;
}
.reservation-container {
    flex: 1;
    margin-left: 10px;
}

.reservation-form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  background-color: #f2f2f2;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="date"],
select {
  font-size: 16px;
  padding: 5px;
  border-radius: 4px;
  border: none;
  outline: none;
  box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
}

#price {
  font-weight: bold;
}

button {
  background-color: #334257;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 8px 16px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
}

button:hover {
  background-color: #FF6060;
  color: #fff;
  transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
}

    </style>
</head>
<body>
    <main>
      
    <h2>Availability Calendar</h2>
    <section>
      
        <div class="apartment-container">
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
                <tbody id="calendar-body1" class=""></tbody>
                </table>
            </div>
        </div>
        <div class="reservation-container">
          <form class="reservation-form" action="checkout-charge.php" method="POST">
            <div class="form-group">
              <label for="check-in-date">Check In:</label>
              <input type="date" id="check-in-date" name="checkInDate" value="<?php echo isset($_GET['checkInDate']) ? $_GET['checkInDate'] : '2001-01-01'; ?>" readonly> 
            </div>
            <div class="form-group">
              <label for="check-out-date">Check Out:</label>
              <input type="date" id="check-out-date" name="checkOutDate" value="<?php echo isset($_GET['checkOutDate']) ? $_GET['checkOutDate'] : '2001-01-02'; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="num-people">Number of People:</label>
              <input type="text" id="num-people" name="num-people" value="<?php echo isset($_GET['ppl_count']) ? $_GET['ppl_count'] : '1'; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="apartment-id">Apartment id:</label>
              <input type="text" id="apartment-id" name="apartment_id" value="<?php echo isset($_GET['apartment_id']) ? $_GET['apartment_id'] : '1'; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="price">Price:</label>
              <span id="price">$0</span>
            </div>
            <?php  ?>
          </form>
        </div>
    </section>
    <!-- <div>

    </div> -->
    </main>

</body>
<script>



// Ucitavanje tocnog mjeseca
document.getElementById('month-select1').value = currentMonth.toString();

document.getElementById('year-select1').value = currentYear.toString();
let brojevi = ['1'];
brojevi.forEach(element => {
  let yearSelect = document.getElementById('year-select'+element);
  for (let i = 0; i <= 5; i++) {
    const yearOption = document.createElement('option');
    yearOption.value = currentDate.getFullYear() + i;
    yearOption.text = yearOption.value;
    yearSelect.appendChild(yearOption);
  }
});


document.addEventListener('DOMContentLoaded', () => {
  // Add event listener to month and year selects
brojevi.forEach((element, index) => {
  let monthSelect = document.getElementById('month-select'+element);
  monthSelect.addEventListener('change', () => {
  currentMonths[index] = parseInt(monthSelect.value);
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element);
});
  let yearSelect = document.getElementById('year-select'+element);
  yearSelect.addEventListener('change', () => {
  currentYears[index] = parseInt(yearSelect.value);
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element);
});
  // Add event listeners to prev-btn and next-btn
  let prevBtn = document.getElementById('prev-btn'+element);
  prevBtn.addEventListener('click', () => {
  currentMonths[index]--;
  if (currentMonths[index] < 0) {
    currentMonths[index] = 11;
    currentYears[index]--;
    yearSelect.value = currentYears[index];
  }
  monthSelect.value = currentMonths[index];
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element);
});
  let nextBtn = document.getElementById('next-btn'+element);
  nextBtn.addEventListener('click', () => {
  currentMonths[index]++;
  if (currentMonths[index] > 11) {
    currentMonths[index] = 0;
    currentYears[index]++;
    yearSelect.value = currentYears[index];
  }
  monthSelect.value = currentMonths[index];
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element);
  });

});

  //renderCalendar(currentMonth, currentYear, bookedDates1);
  
  });
</script>
<script>
    function renderPrvi (month, year) {
    const calendarBody = document.getElementById('calendar-body1');

    let calendarBodies = [calendarBody];
    calendarBody.innerHTML = '';
    const currentMonthDate = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfWeek = currentMonthDate.getDay();
    let calendarData = [];

    let row = document.createElement('tr');
    for (let i = 0; i < firstDayOfWeek; i++) {
      let cell = document.createElement('td');
      cell.classList.add('disabled');
      row.appendChild(cell);
      
    }
  
    for (let day = 1; day <= lastDayOfMonth; day++) {
      let cell = document.createElement('td');
      cell.innerText = day;
      cell.setAttribute('data-date', `${year}-${month + 1}-${day}`);
      row.appendChild(cell);
  
      if (row.children.length === 7) {
        calendarBodies[0].appendChild(row);
        row = document.createElement('tr');
      }
    }
    while (row.children.length < 7) {
      let cell = document.createElement('td');
      cell.classList.add('disabled');
      row.appendChild(cell);
    }
    calendarBodies[0].appendChild(row);
  }
    renderPrvi(currentMonth, currentYear);
</script>
<script>
function renderCalendar(month, year, bookedDates, apartman) {
    const calendarBody = document.getElementById('calendar-body'+apartman);
    calendarBody.innerHTML = '';
    const currentMonthDate = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfWeek = currentMonthDate.getDay();
    let calendarData = [];

    let row = document.createElement('tr');
    for (let i = 0; i < firstDayOfWeek; i++) {
    let cell = document.createElement('td');
    cell.classList.add('disabled');
    row.appendChild(cell);
    
    }

    for (let day = 1; day <= lastDayOfMonth; day++) {
    let cell = document.createElement('td');
    cell.innerText = day;
    if (month<9) {
          if (day<10) {
          cell.setAttribute('data-date', `${year}-0${month + 1}-0${day}`);
        }
          else {
          cell.setAttribute('data-date', `${year}-0${month + 1}-${day}`);
          }
  
        }
        else {
          if (day<10) {
            cell.setAttribute('data-date', `${year}-${month + 1}-0${day}`);
          }
          else {
            cell.setAttribute('data-date', `${year}-${month + 1}-${day}`);
          }
          
        }
    
    row.appendChild(cell);

    if (row.children.length === 7) {
        calendarBody.appendChild(row);
        row = document.createElement('tr');
    }
    }

    // Add empty cells to last row if necessary
    while (row.children.length < 7) {
    let cell = document.createElement('td');
    cell.classList.add('disabled');
    row.appendChild(cell);
    }
    calendarBody.appendChild(row);

    // dodane i modificirane linije iz script.js
    
    let calendarBodyTds = Array.from(calendarBody.querySelectorAll('td:not(.disabled)'));
    let today = new Date();
    calendarBodyTds.forEach(element => {
    if (new Date(element.dataset.date)<today) {
        element.className = 'disabled';
    }
    });
    calendarBodyTds = Array.from(calendarBody.querySelectorAll('td:not(.disabled)'));

    //console.log(calendarBodyTds);
    console.log(bookedDates);
    // Loop through booked dates and mark corresponding dates in calendar data array as booked
    bookedDates = bookedDates.filter(apartment => apartment.apartment_id === apartman);
      bookedDates.forEach(booking => {
        const startDate = new Date(booking.start_date);
        const endDate = new Date(booking.end_date);
  
    
        for (let i = 0; i < calendarBodyTds.length; i++) {
          const date = new Date(calendarBodyTds[i].getAttribute('data-date'));
  
    
    
          if (date > startDate && date < endDate) {
            calendarData[i]=true;
          }
        }
      });
      
      //console.log(calendarData);
  
      //modificirana procedura
      let startDates = bookedDates.map(booking => booking.start_date);
      let endDates = bookedDates.map(booking => booking.end_date);
      let startDates2 = [];
      let endDates2 = [];
  
      startDates.forEach((element, index) => {
        startDates2[index] = new Date(element);
      });
      startDates2.sort((a, b) => {
        return a - b;
      });
      endDates.forEach((element, index) => {
        endDates2[index] = new Date(element);
      });
      endDates2.sort((a, b) => {
        return a - b;
      });
  
      let currentDayOfWeek = firstDayOfWeek;
      calendarBodyTds.forEach((calendarCell, index) => {
  
        const date = new Date(calendarCell.getAttribute('data-date'));
        //console.log(date);
    
        if (calendarData[index]==true) {
          
          calendarCell.classList.add('booked');
        }
        startDates2.forEach(e => {
          if (e.getTime()==date.getTime()) {
            calendarCell.classList.add('check-in');
          }
          
        });
        endDates2.forEach(e => {
          if (e.getTime()==date.getTime()) {
            calendarCell.classList.remove('booked');
            calendarCell.classList.add('check-out');
          }
        });
      });
  
      // ako ima i check in i check out, zamijeni sa booked
      let checkinout = Array.from(document.querySelectorAll('.check-in.check-out'));
      checkinout.forEach(element => {
        element.classList.remove('check-in', 'check-out');
        element.classList.add('booked');
      });

}

</script>


</html>