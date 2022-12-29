const { createApp } = Vue

vueRoot = {
    el: '#vue-body',
    data: {
        users: [],
        searchString: '',
        rooms: [],
        raumString:''
    },
    methods: {
        getRooms() {
            this.getDbData('rooms')
        },
        getUsers() {
            this.getDbData('users')
        },
        removeRoom(room) {
            this.deleteDbEntry('rooms', room.ID)
                .then((data) => {
                    if (data.success)
                        this.getRooms()
                })
        },
        removeUser(user) {
            this.deleteDbEntry('users', user.ID)
                .then((data) => {
                    if (data.success)
                        this.getUsers()
                })
        },

    // helpers to dry up code

        /**
         * Ruft Daten eines Endpoints ab und spichert sie im angegebenen Vue-objekt.
         * Werden 'responsePropertyName' und/oder 'destination' nicht definiert, wird der Wert von 'endpoint' genutzt
         * @param {string} endpoint
         * @param {string} responsePropertyName Name des Objekts aus dem Response.
         * @param {string} destination Name des Vue-Wertes, in welchem die Daten gespeichert werden sollen.
         * @returns A Promise for the completion of which ever callback is executed.
         */
        getDbData(endpoint, responsePropertyName = undefined, destination = undefined) {
            return fetch(`api/v1/${endpoint}/`)
                .then((resp) => resp.json())
                .then((data) => this[destination ?? endpoint] = data[responsePropertyName ?? endpoint]);
        },

        /**
         * Löscht einen Eintrag des entsprechenden Endpints.
         * @param {string} endpoint 
         * @param {string | number} identifier Datenbank-ID
         * @returns A Promise for the completion of which ever callback is executed.
         */
        deleteDbEntry(endpoint, identifier) {
            return fetch(`api/v1/${endpoint}/${identifier}`, {
                method: 'DELETE'
            })
            .then((resp) => resp.json())
        },

        /**
         * Filtert die angebene Liste mithilfe eines Suchtextes
         * @param {array} list Array mit allen Werten
         * @param {string} searchProperty Name der Variable, in der gesucht werden soll
         * @param {string} query Suchtext
         * @returns Array mit gefilterten Werten
         */
        search(list, searchProperty, query) {
            let filtered = [];
            query = query.toLowerCase();

            for (let i = 0; i < list.length; i++) {
                let item = list[i];
                if (item[searchProperty].toLowerCase().includes(query))
                    filtered.push(item);
            }

            return filtered;
        }
    },
    computed: {
        usersFiltered() {
            return this.search(this.users, 'Name', this.searchString);
        }, 
        roomsFiltered(){
            return this.search(this.rooms, 'Nummer', this.raumString);
       }
    },
    mounted(){
        this.getRooms();
        this.getUsers();
    },
    
    
}

new Vue(vueRoot);