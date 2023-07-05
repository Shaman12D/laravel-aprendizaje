<template>
    <div>
        <!-- <h1>Principal</h1> -->
        <!-- <save/> -->
        <header>
            <div class="flex gap-4 bg-gray-400">
                <router-link v-if="!$root.isLoggedIn" :to="{name:'login'}">Login</router-link>
                <p v-if="$root.isLoggedIn">
                    {{ $root.user.name }}
                </p>
                <o-button v-if="$root.isLoggedIn" variant="danger" @click="logout">
                    Logout
                </o-button>
            </div>
        </header>
        <router-view></router-view>
    </div>
</template>

<script>
// import Save from './components/Save.vue'
// export default {
//     components:{
//         Save
//     }
// }

export default{
    data(){
        return{
            isLoggedIn:false,
            user:"",
            token:"",
        };
    },
    created(){
        if(window.Laravel.isLoggedIn){
            this.isLoggedIn = true;
            this.user = window.Laravel.user;
            this.token = window.Laravel.token;
        } else{
            const auth = this.$cookies.get("auth");
            if(auth){
                this.isLoggedIn = true;
                this.user = auth.user;
                this.token = auth.token;
                this.$axios.post("/api/user/token-check",{
                    token: auth.token,
                })
                .then(() => {})
                .catch(() => {
                    this.setCookieAuth('');
                    window.location.href="/vue/login";
                });
            }
        }
    },
    methods:{
        logout(){
            this.$axios.post('/api/user/logout', {
                token: this.token
            }).then((res)=>{
                this.setCookieAuth('');
                window.location.href="/vue/login";
            });
        },
        setCookieAuth(data){
            this.$cookies.set("auth", data);
        },
    },
};
</script>
