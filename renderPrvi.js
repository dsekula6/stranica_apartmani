function renderPrvi (month, year) {
    
    const calendarBody = document.getElementById('calendar-body1');
    const calendarBody2 = document.getElementById('calendar-body2');
    const calendarBody3 = document.getElementById('calendar-body3');

    let calendarBodies = [calendarBody, calendarBody2, calendarBody3];
    
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
        calendarBodies[1].appendChild(row.cloneNode(true));
        calendarBodies[2].appendChild(row.cloneNode(true));
        row = document.createElement('tr');
      }
    }
  
    // Add empty cells to last row if necessary
    while (row.children.length < 7) {
      let cell = document.createElement('td');
      cell.classList.add('disabled');
      row.appendChild(cell);
    }
    calendarBodies[0].appendChild(row);
    calendarBodies[1].appendChild(row.cloneNode(true));
    calendarBodies[2].appendChild(row.cloneNode(true));
  }
renderPrvi(currentMonth, currentYear);