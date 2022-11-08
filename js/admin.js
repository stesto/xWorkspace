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
let room_array = [
    {
        id: 0,
        name: '6A 125'
    }, 
    {
        id: 1,
        name: '6A 124'
    }, 
    {
        id: 2,
        name: '6A 123'
    }, 
    {
        id: 3,
        name: '6A 122'
    }, 
    {
        id: 4,
        name: '6A 121'
    }, 
    {
        id: 5,
        name: '6A 120'
    }, 
    {
        id: 6,
        name: '6A 119'
    } 
    
]


vueRoot = {
    el: '#vue-body',
    data: {
        testtext: 'Hello',
        users: user_array,
        searchString: '',
        rooms: room_array,
        raumString:''
    },
    methods: {
    },
    computed: {
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
                if(room.name.toLowerCase().includes(this.raumString.toLowerCase())){
                    filtered.push(room);
                }

            }
            return filtered;
       }
    }
    
}

new Vue(vueRoot);