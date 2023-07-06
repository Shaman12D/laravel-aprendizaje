<template>
    <div>
        <!-- <h1>Principal</h1> -->
        <!-- <save/> -->
            <nav class="bg-white border-b border-gray-100">
                <header class="max-w-7x1 px-4 sm:px-6 lg:px-8">
                    <div class="flex">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" viewBox="0 0 262 227">
                                <g id="Vue.js_logo_strokes" fill="none" fill-rule="evenodd">
                                    <g id="Path-2">
                                    <polyline class="outer" stroke="#4B8" stroke-width="46" points="12.19 -24.031 131 181 250.351 -26.016" />
                                    </g>
                                    <g id="Path-3" transform="translate(52)">
                                    <polyline class="inner" stroke="#354" stroke-width="42" points="15.797 -14.056 79 94 142.83 -17.863" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="w-full flex py-4 px-4 sm:px-6 justify-between items-center">
                            <div class="flex h-9 items-center">
                                <router-link class="inline-flex pt-1 uppercase border-b-2 text-sm leading-5 mx-3 px-4 py-1
                                text-gray-600 text-center font-bold hover:text-gray-900 hover:border-gray-700
                                hover:-translate-y-1 duration-150 transition-all" v-if="!$root.isLoggedIn" :to="{name:'login'}">Login</router-link>
                                <router-link class="inline-flex pt-1 uppercase border-b-2 text-sm leading-5 mx-3 px-4 py-1
                                text-gray-600 text-center font-bold hover:text-gray-900 hover:border-gray-700
                                hover:-translate-y-1 duration-150 transition-all" v-if="$root.isLoggedIn" :to="{name:'login'}">Post</router-link>
                                <o-button v-if="$root.isLoggedIn" variant="danger" @click="logout">
                                Logout
                                </o-button>
                            </div>
                            <div class="flex flex-col items-center" v-if="$root.isLoggedIn">
                                <div class="rounded-full w-9 h-9 bg-blue-600 text-center p-1 font-bold">
                                    {{ $root.user.name.substr(0,2).toUpperCase() }}
                                </div>
                                <p>
                                    {{ $root.user.name.substr(0,7)  }}
                                </p>
                            </div>
                        </div>
                    </div>
                </header>
            </nav>

            <div class="flex gap-4 bg-gray-400">
            </div>
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
