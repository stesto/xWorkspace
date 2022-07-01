var vueRoot = {
    el: '#vue-body',
    data: {
        username: '',
        password: '',

        invalidCreds: false,
        
        loading: false
    },
    methods: {
        login() {
            if (this.nameMissing || this.passwordMissing || this.loading)
                return;

            this.loading = true;

            $.get('api/user.php', {
                Name: this.username,
                Password: this.password
            })
            .done(function(data) {
                vueRoot.data.loading = false;
                var result = JSON.parse(data);
                
                if (result.length == 0) {
                    vueRoot.data.invalidCreds = true;
                    alert('Die eingegebenen Daten stimmen nicht');
                    return;
                }

                result = result[0];

                Cookies.set('user_id', result.ID);
                Cookies.set('username', result.Name);
                
                location.href = 'bueroreservierung.php'

            });
        }
    },
    computed: {
        nameMissing() {
            return this.username.trim().length == 0;
        },
        passwordMissing() {
            return this.password.trim().length == 0;
        }
    }
}

new Vue(vueRoot);