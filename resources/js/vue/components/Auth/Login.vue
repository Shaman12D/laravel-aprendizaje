<template>
    <form @submit.prevent="submit">
        <o-field :variant="errors.login?'danger':'primary'" message="" label="Email">
            <o-input v-model="form.email"></o-input>
        </o-field>
        <o-field :variant="errors.login?'danger':'primary'" :message="errors.login" label="Password">
            <o-input v-model="form.password" type="password"></o-input>
        </o-field>
        <o-button variant="primary" native-type="submit">Send</o-button>
    </form>
</template>
<script>
    export default{
        created(){
            if (this.$root.isLoggedIn) {
<<<<<<< HEAD
                this.$router.push({name:"list"});
=======
                this.$router.push({name:'list'});
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
            }
        },
        methods: {
        cleanErrorsForm(){
            this.errors.login="";
        },
        submit(){
<<<<<<< HEAD
            this.cleanErrorsForm();
=======
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
            this.$axios.post('/api/user/login',this.form)
                .then((res)=>{
                    console.log(res.data);
                    this.$root.setCookieAuth(res.data);
<<<<<<< HEAD
                    //setTimeout(()=>(window.location.href="/vue/login"),1500);
                    setTimeout(()=>(window.location.href="/vue"),1500);
=======
                    setTimeout(()=>(window.location.href="/vue/login"),1500);
>>>>>>> 6117da840b5ecabe404521138f3b00772a834528
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
