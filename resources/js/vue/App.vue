<template>
    <div>
        <!-- <h1>Principal</h1> -->
        <!-- <save/> -->
        <header>
            <div class="flex gap-4 bg-gray-400">
                <router-link :to="{name:'login'}">Login</router-link>
                <o-button variant="danger" @click="logout">
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
<<<<<<< HEAD
        };
=======
        }
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
    },
    created(){
        if(window.Laravel.isLoggedIn){
            this.isLoggedIn = true;
            this.user = window.Laravel.user;
            this.token = window.Laravel.token;
        } else{
            const auth = this.$cookies.get("auth");
            if(auth){
<<<<<<< HEAD
                this.isLoggedIn = true;
                this.user = auth.user;
                this.token = auth.token;
                this.$axios.post("/api/user/token-check",{
                    token: auth.token,
                })
                //.then(() => {})
                .catch(() => {
                    this.setCookieAuth('');
                    window.location.href="/vue/login";
                });
=======
                this.$axios.post("/api/user/token-check").then(() => {});
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
            }
        }
    },
    methods:{
        logout(){
<<<<<<< HEAD
            this.$axios.post('/api/user/logout',{
                token: this.token,
            }).then((res)=>{
=======
            this.$axios.post('/api/user/logout').then((res)=>{
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
                this.setCookieAuth('');
                window.location.href="/vue/login";
            });
        },
        setCookieAuth(data){
            this.$cookies.set("auth", data);
<<<<<<< HEAD
        },
=======
        }
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
    },
};
</script>
