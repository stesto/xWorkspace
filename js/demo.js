var events = [];

var sessionEvents = sessionStorage.getItem('reservations');
if (sessionEvents !== null) {
  sessionEvents = JSON.parse(sessionEvents);

  sessionEvents.forEach(element => {
    var date = new Date(element.datum);
    console.log(date);
    events.push({
      Date: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
      Title: element.platz.raum,
      Link: '#'
    });
  });
}

function onDateClicked(day, month, year) {
  openPopup(new Date(year, month, day));
}

function openPopup(date) {
  popup.classList.add('active');
  overlay.classList.add('active');

  if (!date)
    return;

  const tagChooser = document.querySelector('#tagChooser');
  tagChooser.value = date.toISOString().substring(0,10);
}

function closePopup() {
  popup.classList.remove('active');
  overlay.classList.remove('active');
}

function onSuchen() {
  const tagChooser = document.querySelector('#tagChooser');
  const vonZeit = document.querySelector('#vonZeit');
  const bisZeit = document.querySelector('#bisZeit');
  const sitzplaetze = document.querySelector('#sitzplaetze');
  window.location.href = "index.php?";
}

var settings = {
  DayClick: onDateClicked
};

var element = document.getElementById('caleandar');
caleandar(element, events, settings);