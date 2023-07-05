<template>
<div class="min-h-screen flex flex-col sm:justify-center items-center">
    <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-md">
        <form @submit.prevent="submit">
            <h2 class="mt-6 mb-6 text-center text-3xl tracking-tight font-bold text-gray-900 ">Sing in to your account</h2>
            <o-field :variant="errors.login?'danger':'primary'" message="" label="Email">
                <o-input v-model="form.email"></o-input>
            </o-field>
            <o-field :variant="errors.login?'danger':'primary'" :message="errors.login" label="Password">
                <o-input v-model="form.password" type="password"></o-input>
            </o-field>
            <o-button class="float-right" variant="primary" native-type="submit">Send</o-button>
        </form>
    </div>
</div>
</template>
<script>
    export default{
        created(){
            if (this.$root.isLoggedIn) {
                this.$router.push({name:"list"});
            }
        },
        methods: {
        cleanErrorsForm(){
            this.errors.login="";
        },
        submit(){
            this.cleanErrorsForm();
            this.$axios.post('/api/user/login',this.form)
                .then((res)=>{
                    console.log(res.data);
                    this.$root.setCookieAuth(res.data);
                    //setTimeout(()=>(window.location.href="/vue/login"),1500);
                    setTimeout(()=>(window.location.href="/vue"),1500);
                    this.$oruga.notification.open({
                        message:'¡Ingresó!',
                        duration: 4000,
                        closable: true,
                        position: "bottom-right",
                    });
                }).catch((error)=>{
                    console.log(error);
                    if(error.response.data){
                        this.errors.login=error.response.data;
                    }
                });
            },
        },
        data(){
            return{
                form:{
                    email:'',
                    password:'',
                },
                errors:{
                    login:"",
                },
            };
        },
    };
</script>
