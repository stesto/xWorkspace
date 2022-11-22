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
        raum:JSON.parse('{"ID":"1","Nummer":"6A 123","Stra\u00dfe":"Alt Friedrichsfelde","HausNr":"60","Ort":"Berlin","PLZ":"10315","Plaetze":null,"features":[{"RaumID":"1","FeatureID":"2","Name":"Projektor"},{"RaumID":"1","FeatureID":"3","Name":"Konferenzraum"},{"RaumID":"1","FeatureID":"5","Name":"Drucker"}]}'),
        features:JSON.parse('[{"FeatureID":0,"Name":"Computer"},{"FeatureID":1,"Name":"Drucker"},{"FeatureID":2,"Name":"Whiteboard"}]')

    },
    methods: {
        removefeature(idx){
            this.raum.features.splice(idx, 1);
            console.log(idx);
        },
        addfeature(obj, id){
            this.raum.features.push(obj);
            this.features.splice(id, 1); // die 1 steht für, wieviele Objekte gelöscht werden sollen
            console.log(obj);
        }
    },
    computed:   {

    }

}

new Vue(vueRoot);