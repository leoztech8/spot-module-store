<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        Store List
                        <button class="btn btn-info float-right" @click="create()">Novo</button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Endereço</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cervs in cervejarias">
                                <td>{{cervs.name}}</td>
                                <td>{{cervs.description}}</td>
                                <td>{{cervs.address}}</td>
                                <td>
                                    <button class="btn btn-success" @click="edit(cervs.id)">Editar</button>
                                    <button class="btn btn-danger" @click="destroy(cervs.id)">Excluir</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Store Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" v-model="store.name">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" v-model="store.description">
                        </div>
                        <div class="form-group">
                            <label>Endereço</label>
                            <input type="text" class="form-control" v-model="store.address">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="save()" v-if="action == 'new'">Salvar</button>
                        <button type="button" class="btn btn-primary" @click="update()" v-if="action == 'edit'">Atualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




</template>

<script>
    export default {
        mounted() {
            this.get();
        },
        data: function () {
            return {
                cervejarias: [],
                textbody: "Texto do Body Aqui",
                store: {
                    name: '',
                    description: '',
                    address: ''
                },
                action: false
            }
        },
        methods: {
            create(){
                this.action = 'new';
                this.cleanForm();
                this.showModal();
            },
            get() {
                this.$http.get('http://spot-skeleton.test/api/store').then(response => {
                    this.cervejarias = response.data;
                })
            },
            save() {
                var data = this.store;
                this.$http.post('http://spot-skeleton.test/api/store', data).then(response => {
                   this.get();
                   this.closeModal();
                    this.cleanForm();
                })
            },
            edit(id) {
                this.$http.get('http://spot-skeleton.test/api/store/'+id+'/edit').then(response => {
                    this.action = 'edit';
                    var store = response.data;
                    this.store.name = store.name;
                    this.store.description = store.description;
                    this.store.address = store.address;
                    this.store.id = store.id;

                    this.showModal();
                })
            },
            update() {
                var data = this.store;
                this.$http.put('http://spot-skeleton.test/api/store/'+data.id, data).then(response => {
                    this.get();
                    this.closeModal();
                    this.cleanForm();
                })
            },
            destroy(id) {
                this.$http.delete('http://spot-skeleton.test/api/store/'+id).then(response => {
                    this.get();
                })
            },
            cleanForm() {
                this.store.name = '';
                this.store.description = '';
                this.store.address = '';
                this.store.id = '';
            },
            showModal() {
                $('#exampleModal').modal('show')
            },
            closeModal() {
                $('#exampleModal').modal('hide')
            }
        }

    }
</script>

<style>

</style>
