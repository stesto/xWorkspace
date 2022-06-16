const { createApp } = Vue

var reservations = [];

var vueApp = {};
var vueRoot = {
    data() {
        return {
            arbeitsplaetze: arbeitsplaetze,
            reservations: reservations,
            currentReservation: {},
            searchText: ''
        }
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
                x.raum.toLowerCase().includes(lowerSearchText)
                || x.ort.toLowerCase().includes(lowerSearchText)
                || x.features.reduce((previous, current) => previous || current.toLowerCase().includes(lowerSearchText), false)
            )
        }
    }
}

window.onload = function() {
    var sessionReservations = sessionStorage.getItem('reservations');
    if (sessionReservations != null)
        reservations = JSON.parse(sessionReservations);

    vueApp = createApp(vueRoot)
    vueApp.mount('#vue-body');
}