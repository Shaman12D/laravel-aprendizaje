<template>
    <form @submit.prevent="submit">
        <h1 v-if="post">Actualizar Post <span class="font-bold">{{ post.title }}</span></h1>
        <h1 v-else>Crear Post</h1>
        <div class="grid grid-cols-2 gap-2">
            <o-field label="Título" :variant="errors.title ? 'danger' : 'primary'" :message="errors.title">
                <o-input v-model="form.title" value=""></o-input>
            </o-field>
            <o-field label="Descripción" :variant="errors.description ? 'danger' : 'primary'" :message="errors.description">
                <o-input v-model="form.description" type="textarea" value=""></o-input>
            </o-field>
            <o-field label="Contenido" :variant="errors.content ? 'danger' : 'primary'" :message="errors.content">
                <o-input v-model="form.content" type="textarea" value=""></o-input>
            </o-field>
            <o-field label="Categoría" :variant="errors.category_id ? 'danger' : 'primary'" :message="errors.category_id">
                <o-select v-model="form.category_id" placeholder="Seleccionar categoría">
                    <option v-for="c in categories" v-bind:key="c.id" :value="c.id">{{ c.title }}</option>
                </o-select>
            </o-field>
            <o-field label="Posted" :variant="errors.posted ? 'danger' : 'primary'" :message="errors.posted">
                <o-select v-model="form.posted" placeholder="Seleccionar estado">
                    <option value="yes">Yes</option>
                    <option value="not">Not</option>
                </o-select>
            </o-field>
            <div class="flex gap-4" v-if="post">
                <o-field :message="fileError" >
                    <o-upload v-model="file">
                        <o-button tag="a" variant="primary">
                            <o-icon icon="upload"></o-icon>
                            <span>Click para cargar</span>
                        </o-button>
                    </o-upload>
                </o-field>

                <o-button icon-left="upload" @click="upload">Subir</o-button>
            </div>

            <div class="flex gap-4" v-if="post">
                <o-field :message="fileError" >
                    <o-upload v-model="filesDD" multiple drag-drop>
                        <section>
                            <o-icon icon="upload"></o-icon>
                            <span>Drag and Drop para cargar</span>
                        </section>
                    </o-upload>
                </o-field>

                <span v-for="(file, index) in filesDD" :key="index">
                    {{ file.name }}
                </span>
            </div>
        </div>
        <br/>
        <o-button variant="primary" native-type="submit">Enviar</o-button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            form: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },
            errors: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },
            post:"",
            file:null,
            filesDD:[],
            fileError: "",
        }
    },
    async mounted() {
        if (this.$route.params.slug) {
            await this.getPost();
            this.initPost();
        }
        this.getCategory();
    },
    methods: {
        cleanErrorsForm() {
            this.errors.title = ""
            this.errors.description = ""
            this.errors.content = ""
            this.errors.category_id = ""
            this.errors.posted = ""
        },
        submit() {
            this.cleanErrorsForm();

            const config={
                headers: { Authorization: `Bearer ${this.$cookies.get('auth').token}` },
                // headers: {Authorization: 'Bearer ' +this.$cookies.token}
            };

            if(this.post == "" )
                return this.$axios.post("/api/post",
                    this.form, config
                ).then(res => {
                    this.$oruga.notification.open({
                        message:'¡Registado!',
                        duration: 4000,
                        closable: true,
                        position: "bottom-right",
                    });
                    console.log(res);
                }).catch(error => {
                    console.log(error.response.data);

                    if (error.response.data.title) {
                        this.errors.title = error.response.data.title[0]
                    }

                    if (error.response.data.description) {
                        this.errors.description = error.response.data.description[0]
                    }

                    if (error.response.data.content) {
                        this.errors.content = error.response.data.content[0]
                    }

                    if (error.response.data.category_id) {
                        this.errors.category_id = error.response.data.category_id[0]
                    }

                    if (error.response.data.posted) {
                        this.errors.posted = error.response.data.posted[0]
                    }
                })

                //actualizar
                this.$axios.patch("/api/post/" + this.post.id,
                    this.form, config
                ).then(res => {
                    this.$oruga.notification.open({
                        message:'¡Modificado!',
                        duration: 4000,
                        closable: true,
                        position: "bottom-right",
                    });
                    console.log(res);
                }).catch(error => {
                console.log(error.response.data);

                if (error.response.data.title) {
                    this.errors.title = error.response.data.title[0]
                }

                if (error.response.data.description) {
                    this.errors.description = error.response.data.description[0]
                }

                if (error.response.data.content) {
                    this.errors.content = error.response.data.content[0]
                }

                if (error.response.data.category_id) {
                    this.errors.category_id = error.response.data.category_id[0]
                }

                if (error.response.data.posted) {
                    this.errors.posted = error.response.data.posted[0]
                }
            })
        },
        upload(){

        // return console.log(this.file);
        this.fileError="";

        const formData=new FormData();
        formData.append("image",this.file)

        this.$axios.post("/api/post/upload/"+this.post.id,formData,{
            headers:{
                "content-type":"multipart/form-data",
                // headers: { Authorization: `Bearer ${this.$cookies.get('auth').token}` },
                "Authorization": 'Bearer ' +this.$cookies.token
            }
            }).then((res)=>{
                console.log(res);
            }).catch((error)=>{
                this.fileError = error.response.data.message;
            })
        },
        getCategory() {
            const config={
                // headers: { Authorization: `Bearer ${this.$cookies.get('auth').token}` },
                headers: {Authorization: 'Bearer ' +this.$cookies.token}
            };

            this.$axios.get("/api/category/all", config).then(res => {
                this.categories = res.data;
            });
        },
        async getPost() {
            const config={
                // headers: { Authorization: `Bearer ${this.$cookies.get('auth').token}` },
                headers: {Authorization: 'Bearer ' +this.$cookies.token}
            };
            this.post = await this.$axios.get("/api/post/slug/" + this.$route.params.slug);
            this.post = this.post.data;
        },
        initPost() {
            this.form.title = this.post.title;
            this.form.description = this.post.description;
            this.form.content = this.post.content;
            this.form.category_id = this.post.category_id;
            this.form.posted = this.post.posted;
        }
    },
    watch:{
        filesDD:{
            handler(val){
                //return console.log(val[val.length-1]);

                this.fileError = "";
                const formData=new FormData();
                formData.append("image",val[val.length-1])

                this.$axios.post("/api/post/upload/"+this.post.id,formData,{
                    headers:{
                        "content-type":"multipart/form-data"
                    }
                    }).then((res)=>{
                        console.log(res);
                    }).catch((error)=>{
                        this.fileError = error.response.data.message;
                    })
            },
            deep: true
        },
    },
};
</script>
