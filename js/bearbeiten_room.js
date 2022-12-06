const { createApp } = Vue

vueRoot = {
    el: '#vue-body',
    data: {
        raum:{},
        features:[]
    },
    methods: {
        removefeature(idx){
            this.raum.Features.splice(idx, 1);
            console.log(idx);
        },
        addfeature(obj, id){
            this.raum.Features.push(obj);
            this.features.splice(id, 1); // die 1 steht für, wieviele Objekte gelöscht werden sollen
            console.log(obj);
        },
     
        speicherRaum(){ 

            let url_room = 'api/v1/rooms/';
            let http_method = 'PUT';
            
            if (roomId === undefined) {
                http_method = 'POST';
            }
            else {
                url_room += roomId
            }

            console.log(url_room);
            // console.log(JSON.stringify(this.raum))
            //let data = {'ID':'Name'} // ohne zeile 21 steht Data is not defined
            $.ajax({
                url: url_room,
                dataType: '',
                type: http_method,
                data: this.raum, //Die JSON.stringify()Methode wandelt einen JavaScript-Wert in eine JSON-Zeichenfolge um und ersetzt optional Werte
            }).done(function(data){
                location.href = 'admin.php'
                console.log(data); // data gibt an was die API zurückgibt
            }).fail(function (msg) {
                console.log('FAIL');
            }).always(function (msg) {
                console.log('Always');   
            })
        },
        
    },
    computed:   {   

    }, 
    mounted(){
        //hier holen wir alle Räume mit deren Information aus der API (Get)
        
        let url_room = 'api/v1/rooms/';

        if (roomId === undefined) {
            url_room += 'new';
        }
        else {
            url_room += roomId;
        }

        console.log(url_room);

        $.ajax({
            url: url_room,
            dataType: '',
            type: 'GET',
        }).done(function(data){
            this.raum = data.room //ersetzen was rechts ist nach links :D
        }.bind(this));

        //-------------------------------------------------------------------------------------------------------//
        // hier holen wir mit der Methode GET alle Features aus der API die es gibt
        $.ajax({
            url: 'api/v1/features',
            dataType: '',
            type: 'GET',
        }).done(function(data){
            this.features = data.features
        }.bind(this));

        //-------------------------------------------------------------------------------------------------------//

      
    }




        // fetch('api/v1/rooms/' + roomId)
        // .then((response) => response.json())
        // .then((data)=> {
        //     this.raum = data.room
        // });

        // fetch('api/v1/rooms/' + roomId)
        // .then((response) => response.json())
        // .then((data)=> {
        //     this.raum = data.room
        // });
    
    

}

new Vue(vueRoot);