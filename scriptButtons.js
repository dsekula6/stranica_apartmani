// Get current date
const currentDate = new Date();
  // Initialize calendar with current month and year
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

let currentMonth2 = currentDate.getMonth();
let currentYear2 = currentDate.getFullYear();

let currentMonth3 = currentDate.getMonth();
let currentYear3= currentDate.getFullYear();

let currentMonths = [currentMonth, currentMonth2, currentMonth3];
let currentYears = [currentYear, currentYear2, currentYear3];

//napravi ono da se ucita tocan misec
document.getElementById('month-select1').value = currentMonth.toString();
document.getElementById('month-select2').value = currentMonth2.toString();
document.getElementById('month-select3').value = currentMonth3.toString();

document.getElementById('year-select1').value = currentYear.toString();
document.getElementById('year-select2').value = currentYear2.toString();
document.getElementById('year-select3').value = currentYear3.toString();

let brojevi = ['1', '2', '3'];
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
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element, prices); //------------------tu triba dodati jos jedan argument za koji je apartman
});
  let yearSelect = document.getElementById('year-select'+element);
  yearSelect.addEventListener('change', () => {
  currentYears[index] = parseInt(yearSelect.value);
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element, prices);
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
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element, prices);
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
  renderCalendar(currentMonths[index], currentYears[index], bookedDates1, element, prices);
  });

});

  //renderCalendar(currentMonth, currentYear, bookedDates1);
  
  });
