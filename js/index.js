const { createApp } = Vue

var arbeitsplaetze = [];
var reservations = [];

var vueRoot = {
    el: '#vue-body',
    data: {
        arbeitsplaetze: arbeitsplaetze,
        reservations: reservations,
        currentReservation: {},
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
                || x.features.reduce((previous, current) => previous || current.toLowerCase().includes(lowerSearchText), false)
            )
        }
    },
    mounted() {
        $.get('api/raum.php')
            .done(function(data) {
                var rooms = JSON.parse(data);

                for (var room of rooms) {
                    console.log(room);
                    arbeitsplaetze.push(room);
                }
            });
        //
    }
}

new Vue(vueRoot);

var sessionReservations = sessionStorage.getItem('reservations');
if (sessionReservations != null)
    for (var res of JSON.parse(sessionReservations))
        reservations.push(res);
