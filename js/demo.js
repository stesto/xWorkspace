var events = [];

var sessionEvents = sessionStorage.getItem('reservations');
if (sessionEvents != null)
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

var settings = {};

var element = document.getElementById('caleandar');
caleandar(element, events, settings);