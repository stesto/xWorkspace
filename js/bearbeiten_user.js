const { createApp } = Vue

vueRoot = {
    el: '#vue-body',
    data: {
        benutzer:{},
        features:[]
    },

    methods: {
        removefeature(index){
            this.benutzer.Features.splice(index, 1);
            console.log(index);
        },
        addfeature(obj, id){
            this.raum.Features.push(obj);
            this.features.splice(id, 1); // die 1 steht für, wieviele Objekte gelöscht werden sollen
            console.log(obj);
        },
    
        speicherBenutzer(){ 

            let url_user = 'api/v1/users/';
            let http_method = 'PUT';
            
            if (userId === undefined) {
                http_method = 'POST';
            }
            else {
                url_user += userId
            }

            console.log(url_user);
            // console.log(JSON.stringify(this.raum))
            //let data = {'ID':'Name'} // ohne zeile 21 steht Data is not defined
            $.ajax({
                url: url_user,
                dataType: '',
                type: http_method,
                data: this.benutzer, //Die JSON.stringify()Methode wandelt einen JavaScript-Wert in eine JSON-Zeichenfolge um und ersetzt optional Werte
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
    mountedUser(){
        //hier holen wir alle Räume mit deren Information aus der API (Get)
        
        let url_user = 'api/v1/users/';

        if (userId === undefined) {
            url_user += 'new';
        }
        else {
            url_user += userId;
        }
        

        console.log(url_user);

        $.ajax({
            url: url_user,
            dataType: '',
            type: 'GET',
        }).done(function(data){
            this.benutzer = data.user //ersetzen was rechts ist nach links :D
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