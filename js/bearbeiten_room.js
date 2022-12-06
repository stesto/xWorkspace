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
           // console.log(JSON.stringify(this.raum))
           //let data = {'ID':'Name'} // ohne zeile 21 steht Data is not defined
            $.ajax({
            url: 'api/v1/rooms/' + roomId,
            dataType: '',
            type: 'PUT',
            data: this.raum, //Die JSON.stringify()Methode wandelt einen JavaScript-Wert in eine JSON-Zeichenfolge um und ersetzt optional Werte
        }).done(function(data){
            
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
        console.log('api/v1/rooms/' + roomId);
        $.ajax({
            url: 'api/v1/rooms/' + roomId,
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