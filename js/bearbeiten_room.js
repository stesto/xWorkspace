const { createApp } = Vue

// let mikel= [
//     'Hi',
//     '2',
//     {Name:"Justin",Alter:6}
// ]

// ali[1];

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
            this.Features.splice(id, 1); // die 1 steht für, wieviele Objekte gelöscht werden sollen
            console.log(obj);
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