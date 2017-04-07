<!--Created by Nestor on 4/2/2017./-->
<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p v-if="clients.length === 0">You have not created any Client</p>
                <!--<table class="table table-responsive" v-if="clients.length > 0">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">CI/RIF</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client in clients">
                            <td>{{ client.name | capitalize }}</td>
                            <td>{{ client.id_type_doc }} - {{ client.number_rif}}</td>
                            <td>{{ client.address | capitalize }}</td>
                            <td>{{ client.email }}</td>
                            <td>{{ client.contact | capitalize }}</td>
                        </tr>
                    </tbody>
                </table>-->
                <form id="search">
                    Search <input class="form-control" name="query" v-model="searchQuery">
                </form>
                <table-custom :data="clients" :columns="colums" :filter-key="searchQuery"></table-custom>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchQuery: '',
                clients: [],
                colums: ['CI/RIF','name','address','email','contact'],
            };
        },
        ready() {
            this.prepareComponent();
        },
        mounted() {
            this.prepareComponent();
        },
        filters: {
            capitalize: function (str) {
                return str.charAt(0).toUpperCase() + str.slice(1)
            }
        },
        methods: {
            prepareComponent() {
                this.getClients();
            },
            getClients() {
                axios.get('api/client')
                    .then(response => {
                        this.clients = response.data;
                    })
            }
        }
    }
</script>