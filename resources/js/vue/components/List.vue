<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-4 bg-gray-300">
                <o-button variant="danger" @click="deletePost()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive=false">Cancelar</o-button>
            </div>
        </o-modal>
        <h1 class="text-center">Listado de post</h1>
        <o-button iconLeft="plus" @click="$router.push({name: 'save'})">Crear</o-button>
        <div class="mb-4"></div>
        <o-table :loading="isLoading" :data="posts.currrent_page && posts.data.length == 0 ? [] : posts.data">
            <o-table-column field="id" label="id" numeric v-slot="p">
                {{ p.row.id }}
            </o-table-column>
            <o-table-column field="title" label="Título" v-slot="p">
                {{ p.row.title }}
            </o-table-column>
            <o-table-column field="posted" label="Posteado" v-slot="p">
                {{ p.row.posted }}
            </o-table-column>
            <o-table-column field="created_at" label="Fecha" v-slot="p">
                {{ p.row.created_at }}
            </o-table-column>
            <o-table-column field="category" label="Categoría" v-slot="p">
                {{ p.row.category.title }}
            </o-table-column>
            <o-table-column field="slug" label="Acciones" v-slot="p">
                <router-link class="mr-2" :to="{ name: 'save', params: { 'slug': p.row.slug } }">Editar</router-link>
                <o-button iconLeft="delete-forever" rounded size="small" variant="danger" @click="deletePostRow=p;
                confirmDeleteActive=true">Eliminar</o-button>
            </o-table-column>
        </o-table>
        <br>
        <o-pagination v-if="posts.current_page && posts.data.length > 0" @change="updatePage" :total="posts.total"
            v-model:current="currentPage" :range-before="2" range-after="2" order="centered" :size="small" :simple="false"
            :rounded="true" :per-page="posts.per_page">
        </o-pagination>
    </div>
</template>

<script>

export default {
    data() {
        return {
            posts: [],
            isLoading: true,
            currentPage: 1,
            confirmDeleteActive: false,
            deletePostRow:"",
        }
    },
    methods: {
        updatePage() {
            setTimeout(this.listPage, 100);
        },
        listPage() {
            //console.log("Click" + this.currentPage)

            const config={
                // headers: { Authorization: `Bearer ${this.$cookies.get('auth').token}` },
                headers: {Authorization: 'Bearer ' +this.$root.token}
            };

            this.isLoading = true;
            this.$axios.get('/api/post?page=' + this.currentPage, config).then((res) => {
                this.posts = res.data;
                //console.log(this.posts);
                this.isLoading = false;
            });
        },
        deletePost() {
            const config={
                // headers: { Authorization: `Bearer ${this.$cookies.get('auth').token}` },
                headers: {Authorization: 'Bearer ' +this.$root.token}
            };
            this.confirmDeleteActive=false;
            this.posts.data.splice(this.deletePostRow.index,1);
            this.$axios.delete('/api/post/' + this.deletePostRow.row.id, config);
            this.$oruga.notification.open({
                message:'¡Eliminado!',
                duration: 4000,
                variant: 'danger',
                closable: true,
                position: "bottom-right",
            });
        },
    },
    async mounted() {
        
         console.log('cookies');
        console.log(this.$cookies.get('auth'));
        this.listPage();
    },
};
</script>
