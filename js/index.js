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

var vueRoot = {
    el: '#vue-body',
    data: {
        arbeitsplaetze: arbeitsplaetze,
        reservations: reservations,
        currentReservation: {},
        reservationSearch: {},
        users: users,
        currentUser: users[0],
        searchText: ''
    },
    methods: {
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
            $.get('api/reservierung.php',
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
                var rooms = JSON.parse(data);
                reservations.splice(0);
                for (var room of rooms) {
                    reservations.push(room);
                }
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
        // $.get('api/reservierung.php')
        //     .done(function(data) {
        //         var rooms = JSON.parse(data);

        //         for (var room of rooms) {
        //             reservations.push(room);
        //         }
        //     });
    }
}

new Vue(vueRoot);