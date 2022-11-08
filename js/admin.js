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
        searchString: ''
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
        }
    }
}

new Vue(vueRoot);