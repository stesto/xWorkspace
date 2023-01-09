const { createApp } = Vue

var arbeitsplaetze = [];
var reservations = [];

var reservationSearch = {
    datum: '',
    von: '',
    bis: '',
 };

 var reservationBooking = {
    datum: '',
    von: '',
    bis: '',
 };

var reservierungTabs = [
    {
        symbol: 'calendar_month',
        title: 'Kalenderansicht'
    },
    {
        symbol: 'list',
        title: 'Listenansicht'
    }
];

var vueRoot = {
    el: '#vue-body',
    data: {
        username: '',
        user_id: -1,
        arbeitsplaetze: arbeitsplaetze,
        reservations: reservations,
        currentReservation: {},
        reservationSearch: reservationSearch,
        reservationBooking: reservationBooking,
        reservierungTabs: reservierungTabs,
        selectedTab: reservierungTabs[0],
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
            // console.log(platz);
            // console.log(this.currentReservation);
            $.get('api/set_reservierung.php', {
                cmd: 'new',
                benutzerId: this.user_id,
                raumId: platz.ID,
                datum: this.reservationBooking.datum,
                von: this.reservationBooking.von,
                bis: this.reservationBooking.bis
            })
            .done(function(data) {
                this.getReservierungen();
            }.bind(this));
            

            this.currentReservation = null;
        },
        getFreeRooms() {
            this.reservationBooking.datum = this.reservationSearch.datum;
            this.reservationBooking.von = this.reservationSearch.von;
            this.reservationBooking.bis = this.reservationSearch.bis;
            $.get('api/get_raum.php',
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
        getReservierungen() {
            fetch('api/get_reservierung.php?benutzerId=' + this.user_id)
                .then((resp) => resp.json())
                .then((data) => {
                    reservations.splice(0);

                    for (let room of data) {
                        reservations.push(room);
                    }

                    this.drawCalendar();
                });
        },
        drawCalendar() {
            let events = [];
            for (let res of reservations) {
                let date = new Date(res.Datum);
                events.push({
                    Date: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    Title: res.Nummer,
                    Link: '#'
                });
            }
                
            var settings = {
                DayClick: onDateClicked
            };
            
            let element = document.getElementById('caleandar');
            element.innerHTML = '';
            element.className = '';
            caleandar(element, events, settings);
        },
        cancel(reservierung) {
            reservierung.deleting = true;
            this.$forceUpdate();
            $.get('api/set_reservierung.php', {
                cmd: 'delete',
                reservierungId: reservierung.ReservierungID,
            })
            .done(function(data) {
                this.getReservierungen();
            }.bind(this));
        },
        logout() {
            Cookies.remove('user_id');
            Cookies.remove('username');

            location.href = 'login.php';
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
        this.username = Cookies.get('username');
        this.user_id = Cookies.get('user_id');
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
    return Array(+(zero > 0 && zero)).join('0') + num;
  }

new Vue(vueRoot);