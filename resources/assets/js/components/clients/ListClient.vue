<!--Created by Nestor on 4/2/2017./-->
<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p v-if="clients.length === 0">You have not created any Client</p>
                <form id="search">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-sm-push-8">
                            <div class="form-group md-form">
                                <label for="query" class="control-label">
                                    Search <i class="fa fa-search" aria-hidden="true" v-show="searchQuery.length == 0"></i>
                                </label>
                                <input id="query" type="text" class="form-control" name="query" v-model="searchQuery">
                            </div>
                        </div>
                    </div>
                </form>
                <table-custom :data="clients" :columns="colums" :link="true" :filter-key="searchQuery"></table-custom>
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