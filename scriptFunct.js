

function getDaysBetweenDates(startDate, endDate) {
    let start = new Date(startDate);
    let end = new Date(endDate);
    let oneDay = 24 * 60 * 60 * 1000; // milliseconds in a day
    let diffDays = Math.round(Math.abs((end - start) / oneDay));
    return diffDays;
  }
  
    //--------------------------------------------------------------------- KLIKANJE NA KALENDAR -----------------------------------------
    //---------------------------------------------------------------------
    //---------------------------------------------------------------------
  
  let checkInDate = null;
  let checkOutDate = null;
  let clicked = false;
  let nextCheckInDate = null;
  let hoveredDate = null;
  let checkedApartment = null;
  
    function handleClick(td, apartman, startDates2) {
      //makni hovere
  
      let allSubHovered = Array.from(document.querySelectorAll('.sub-hovered'));
      let allTdHovered = Array.from(document.querySelectorAll('.td-hovered'));
      allSubHovered.forEach(element => {
          element.classList.remove('sub-hovered');
      });
      allTdHovered.forEach(element => {
        element.classList.remove('td-hovered');
      });
   
    //prekida ako je booked
    if (td.classList.contains('booked')) {
      return;
    }
  
    // Reset the selected check-in and check-out dates if a new check-in date is clicked
    if (checkInDate&&checkOutDate) {
        document.querySelectorAll('.selected-check-in, .selected-check-out, .highlighted').forEach(el => {
          el.classList.remove('selected-check-in', 'selected-check-out', 'highlighted');
        });
        checkOutDate = null;
        clicked==false;
        nextCheckInDate = null;
        
    }
    let dates = Array.from(document.querySelectorAll(`#calendar-body${apartman} td:not(.disabled)`));
    let endIndex = dates.indexOf(td);
  
    if (!clicked) {
  
      nextCheckInDate = startDates2.find(date => date > new Date(td.dataset.date));
      if (nextCheckInDate==undefined) {
        nextCheckInDate = '2025-01-01';
      }
      else {
        const year1 = nextCheckInDate.getFullYear();
        const month1 = String(nextCheckInDate.getMonth() + 1).padStart(2, '0'); // Add 1 to month index because it is zero-based
        const day1 = String(nextCheckInDate.getDate()).padStart(2, '0');
        nextCheckInDate = `${year1}-${month1}-${day1}`;
        
      }
      //console.log(nextCheckInDate);
  
      checkInDate = td.dataset.date;
      td.classList.add('selected-check-in');
      if (td.classList.contains('check-in')) {
        // Clear selection if user clicks on an already selected check-in date
        td.classList.remove('selected-check-in');
      checkInDate = null;
      return;
    }
      let datesContainerInputs = Array.from(document.querySelectorAll('.dates-container input')); 
      let priceTags = Array.from(document.querySelectorAll('.price-container'));
      datesContainerInputs.forEach(element => {
        element.value = 'select dates';
      });
      priceTags.forEach(element => {
        element.innerHTML = 'select dates';
      });
      clicked = !clicked;
      document.getElementById(`input-check-in${apartman}`).value = checkInDate;
      checkedApartment = apartman;
      
    } else {
      // Only allow selection of check-out dates between check-in date and next date with class 'check-in'
      
       if ((nextCheckInDate && td.dataset.date >= checkInDate && td.dataset.date <= nextCheckInDate)) {
        //console.log('ogroman uvjet');
        //console.log(checkInDate, td.dataset.date);
        if (checkInDate == td.dataset.date) {
          const date = new Date(td.dataset.date);
          date.setDate(date.getDate() + 1);
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          checkOutDate = `${year}-${month}-${day}`;
          endIndex++;
          if (dates[endIndex]==undefined) {
            
          }
          else {
            dates[endIndex].classList.add('selected-check-out');
          }
          
        }
        else {
          checkOutDate = td.dataset.date;
          td.classList.add('selected-check-out');
        } 
        
        
        let startIndex = -1;
        dates.forEach((element, index) => {
          if (element.classList.contains('selected-check-in')) {
            startIndex = index;
          }
        });

        if (startIndex > endIndex) {
          [startIndex, endIndex] = [endIndex, startIndex];
        }
        for (let i = startIndex + 1; i < endIndex; i++) {
          dates[i].classList.add('highlighted');
        }
        clicked = !clicked;
  
        document.getElementById(`input-check-out${apartman}`).value = checkOutDate;
        

        //zbroji sve cijene i stavi ih u prices
        let cijena = parseFloat(document.querySelector('.selected-check-in p').innerHTML);
        let highlighted = Array.from(document.querySelectorAll('.highlighted p'));
        console.log(highlighted);
        highlighted.forEach(element => {
          cijena += parseFloat(element.innerHTML);
        });
        console.log(cijena);
        document.getElementById(`price-container${apartman}`).innerHTML = `Price: ${cijena}€`;
      }
    }
  }
  
  function handleHoverIn(td, apartman) {
    if (clicked) {
      let dates = Array.from(document.querySelectorAll(`#calendar-body${apartman} td:not(.disabled)`));
      let endIndex = dates.indexOf(td);
      let startIndex = dates.indexOf(document.querySelector('.selected-check-in'));
      //console.log(startIndex);
      let allSubHovered = Array.from(document.querySelectorAll('.sub-hovered'));
      let allTdHovered = Array.from(document.querySelectorAll('.td-hovered'));
      allSubHovered.forEach(element => {
          element.classList.remove('sub-hovered');
      });
      allTdHovered.forEach(element => {
        element.classList.remove('td-hovered');
      });
  
      hoveredDate = new Date(td.dataset.date);
      if (hoveredDate>new Date(checkInDate) && hoveredDate<=new Date(nextCheckInDate)) {
        td.classList.add('td-hovered');
        for (let index = startIndex+1; index <= endIndex; index++) {
        dates[index].classList.add('sub-hovered');
      }
      }
  
    }
  }
  function handleHoverOut(td) {
    td.classList.remove('td-hovered');
    
  }
  
  
    function renderCalendar(month, year, bookedDates, apartman, prices) {

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
  
      
      let calendarBodyTds = Array.from(calendarBody.querySelectorAll('td:not(.disabled)'));
      let today = new Date();
      calendarBodyTds.forEach(element => {
        if (new Date(element.dataset.date)<today) {
          element.className = 'disabled';
        }
      });
      calendarBodyTds = Array.from(calendarBody.querySelectorAll('td:not(.disabled)'));
  

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
        if (checkedApartment==apartman) {
          
          // sacuvaj selectani check in i check out
          if (date.getTime()==new Date(checkInDate).getTime()) {
              calendarCell.classList.add('selected-check-in');
            }
          if (date.getTime()==new Date(checkOutDate).getTime()) {
            calendarCell.classList.add('selected-check-out');
          }
          //highlightaj izmedu
          if (!(checkInDate==null)&&!(checkOutDate==null)) {
          if (new Date(checkInDate)<date&& new Date(checkOutDate)>date) {
            calendarCell.classList.add('highlighted');
            }
          }
        }
      });
  
      // ako ima i check in i check out, zamijeni sa booked
      let checkinout = Array.from(document.querySelectorAll('.check-in.check-out'));
      checkinout.forEach(element => {
        element.classList.remove('check-in', 'check-out');
        element.classList.add('booked');
      });

      //dodavanje cijena


      let tdElements = document.querySelectorAll(`#calendar-body${apartman} td:not(.disabled)`);

      let price = defaultPrices[parseInt(apartman)-1][0];
      tdElements.forEach(tdElement => {
        let date = tdElement.getAttribute('data-date');
        
        for (let i = 0; i < prices.length; i++) {
          let { apartment_id, start_date, end_date, price: rangePrice } = prices[i];
          
          if (apartment_id == apartman && new Date(date) >= new Date(start_date) && new Date(date) <= new Date(end_date)) {
            price = rangePrice;

            break;
          }
        }
        let pElement = document.createElement('p');
        pElement.textContent = `${price}€`;
        tdElement.appendChild(pElement);
        
       
      });
  
  
      tdElements.forEach(td => {
        td.addEventListener('click', () => handleClick(td, apartman, startDates2));
        td.addEventListener('mouseover',() => handleHoverIn(td, apartman));
        td.addEventListener('mouseout',() => handleHoverOut(td));
        td.addEventListener('click', () => darkenScreen(apartman));
  
      });
  
  }
  
  var overlay = document.createElement('div');
  overlay.classList.add('overlay');
  
  
  function darkenScreen(apartman) {
    let trenutniApartman = document.querySelector(`#calendar-container${apartman}`);
    if (clicked) {
      
      trenutniApartman.classList.add('focus');
      document.body.appendChild(overlay);
    }
    else {
      trenutniApartman.classList.remove('focus');
      overlay.remove();
    }
  }
  
  
  