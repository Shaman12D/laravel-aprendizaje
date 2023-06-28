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
                <o-upload v-model="file">
                    <o-button tag="a" variant="primary">
                        <o-icon icon="upload"></o-icon>
                        <span>Click para cargar</span>
                    </o-button>
                </o-upload>

                <o-button icon-left="upload" @click="upload">Subir</o-button>
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

            if(this.post == "" )
                return this.$axios.post("/api/post",
                    this.form
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
                    this.form
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

        const formData=new FormData();
        formData.append("image",this.file)

        this.$axios.post("/api/post/upload/"+this.post.id,formData,{
            headers:{
                "content-type":"multipart/form-data"
            }
            }).then((res)=>{
                console.log(res);
            }).catch((error)=>{
                console.log(error);
            })
        },
        getCategory() {
            this.$axios.get("/api/category/all").then(res => {
                this.categories = res.data;
            });
        },
        async getPost() {
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
}
</script>
