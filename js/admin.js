const { createApp } = Vue

let user_array = [
    {
        id: 0,
        name: 'Jon Jones'
    }, 
    {
        id: 1,
        name: 'Tony Stark'
    }, 
    {
        id: 2,
        name: 'Sandra Krüger'
    }, 
    {
        id: 3,
        name: 'Michelle Sand'
    }, 
    {
        id: 4,
        name: 'Thomas Berg'
    }, 
    {
        id: 5,
        name: 'Günther Olaf'
    }, 
    {
        id: 6,
        name: 'Heinrich Sauer'
    }, 
    {
        id: 7,
        name: 'Shawn Cool'
    },
    {
        id: 8,
        name: 'Joachim Kehl'
    }
]

    



vueRoot = {
    el: '#vue-body',
    data: {
        testtext: 'Hello',
        users: user_array,
        searchString: '',
        rooms:[],
        raumString:''
    },
    methods: {
        removeUser(id){
            this.users.splice(id, 1);
            console.log(id); //Testausgabe bro
        },
        removeRoom(id){
           // this.rooms.splice(id,1);
           
            console.log(id); // Testausgabe ob Click funktioniert --> ja funkt.
           // $.post("raum_loeschen.php",{deleteid:id}, function(data){}); // Test

                // ID übergabe an Loeschen_Raum.php
                $.ajax({
                    url: 'raum_loeschen.php',
                    dataType: '',
                    type: 'POST',
                    data: {id:id}, // (vorher: this.raum ::Die JSON.stringify()Methode wandelt einen JavaScript-Wert in eine JSON-Zeichenfolge um und ersetzt optional Werte
                }).done(function(data){
                    location.href = 'admin.php'
                    console.log(data); // data gibt an was die API zurückgibt
                }).fail(function (msg) {
                    console.log('FAIL');
                }).always(function (msg) {
                    console.log('Always');   
                })


        }
        
    },
    computed:   {
        usersFiltered() {
            let filtered = [];
            
            for (let i = 0; i < this.users.length; i++) {
                let user = this.users[i];
                if (user.name.toLowerCase().includes(this.searchString.toLowerCase())) {
                    filtered.push(user);
                }
                
            }

            return filtered;
          }, roomsFiltered(){
            let filtered = [];

            for(let i = 0; i < this.rooms.length; i ++){
                let room = this.rooms[i]
                if (room.Nummer.toLowerCase().includes(this.raumString.toLowerCase())){
                    filtered.push(room);
                }

            }
            return filtered;
       }
    },
    mounted(){
        console.log(this);
        $.ajax({
            url: 'api/v1/rooms/',
            dataType: '',
            type: "GET",
        }).done(function(data) { //done== funktion --> nimmt paramater entgegen -->Function
            this.rooms = data.rooms     
        }.bind(this)); //VUE kram


        // fetch('api/v1/rooms/')
        // .then((response) => response.json())
        // .then((data) => {
        //     this.rooms = data.rooms

        // });
    }
    
}

new Vue(vueRoot);