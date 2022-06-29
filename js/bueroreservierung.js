const { createApp } = Vue

var arbeitsplaetze = [];
var reservations = [];
var users = [
    {
        name: 'Timmy',
        id: 1
    },
    {
        name: 'Oliver',
        id: 2
    },
    {
        name: 'Steve',
        id: 3
    }
]

var reservationSearch = {
    datum: '',
    von: '',
    bis: '',
 };

var reservierungTabs = [
    'Kalender',
    'Liste'
];

var vueRoot = {
    el: '#vue-body',
    data: {
        arbeitsplaetze: arbeitsplaetze,
        reservations: reservations,
        currentReservation: {},
        reservationSearch: reservationSearch,
        reservierungTabs: reservierungTabs,
        selectedTab: reservierungTabs[0],
        users: users,
        currentUser: users[0],
        searchText: ''
    },
    methods: {
        selectTab(tab) {
            this.selectedTab = tab;
        },
        toggleReservation(platz) {
            if (this.currentReservation == platz)
                this.currentReservation = undefined;
            else
                this.currentReservation = platz;
        },
        reserve(platz) {
            this.reservations.push({
                platz: platz,
                datum: platz.datum,
                von: platz.von,
                bis: platz.bis,
            });
            this.currentReservation = null;
            sessionStorage.setItem('reservations', JSON.stringify(this.reservations));
        },
        getFreeRooms() {
            $.get('api/raum.php',
            {
                datum: this.reservationSearch.datum,
                von: this.reservationSearch.von,
                bis: this.reservationSearch.bis,
            })
            .done(function(data) {
                var rooms = JSON.parse(data);

                arbeitsplaetze.splice(0);
                for (var room of rooms) {
                    arbeitsplaetze.push(room);
                }
            });
        },
        setUser(user) {
            this.currentUser = user;
            this.getReservierungen();
        },
        getReservierungen() {
            $.get('api/reservierung.php', {
                benutzerId: this.currentUser.id
            })
            .done(function(data) {
                var data = JSON.parse(data);
                
                var events = [];
                reservations.splice(0);

                for (var room of data) {
                    reservations.push(room);
                    console.log(room);
                    var date = new Date(room.Datum);
                    events.push({
                        Date: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                        Title: room.Nummer,
                        Link: '#'
                      });
                }
                
                var settings = {
                    DayClick: onDateClicked
                };
                console.log(events);
                var element = document.getElementById('caleandar');
                element.innerHTML = '';
                caleandar(element, events, settings);
            });
        }
    },
    computed: {
        getFilteredRooms() {
            var lowerSearchText = this.searchText.toLowerCase();
            return this.arbeitsplaetze.filter(x => 
                x.Nummer.toLowerCase().includes(lowerSearchText)
                || x.Ort.toLowerCase().includes(lowerSearchText)
                || x.Straße.toLowerCase().includes(lowerSearchText)
                || x.HausNr.toLowerCase().includes(lowerSearchText)
                || x.features.reduce((previous, current) => previous || current.Name.toLowerCase().includes(lowerSearchText), false)
            )
        },
        canGetFreeRooms() {
            if (this.reservationSearch.datum === undefined
                || this.reservationSearch.von === undefined
                || this.reservationSearch.bis === undefined)
                return false;

            return true;
        }
    },
    mounted() {
        this.getReservierungen();
    }
}

function onDateClicked(day, month, year) {
    var day   = zeroPad(day,   2);
    var month = zeroPad(month, 2);
    var year  = zeroPad(year,  4);

    reservationSearch.datum = `${ year }-${ month }-${ day }`;
}

function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
  }

new Vue(vueRoot);