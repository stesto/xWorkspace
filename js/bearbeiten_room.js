const { createApp } = Vue

vueRoot = {
    el: '#vue-body',
    data: {
        raum:{},
        features:JSON.parse('[{"FeatureID":0,"Name":"Computer"},{"FeatureID":1,"Name":"Drucker"},{"FeatureID":2,"Name":"Whiteboard"}]')

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
            console.log(speicherRaum)
        }
    },
    computed:   {

    }, 
    mounted(){
        fetch('api/v1/rooms/' + roomId)
        .then((response) => response.json())
        .then((data)=> {
            this.raum = data.room
        });
    }

}

new Vue(vueRoot);