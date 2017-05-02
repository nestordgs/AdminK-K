<!-- Created by Nestor on 4/23/2017. /-->
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="card">
                <div class="card-block">
                    <div class="form-header bg-soluciones text-center">
                        <h4><i class="fa fa-lock"></i> Edit Client:</h4>
                    </div>
                    <div class="panel-body">
                        <create-cli-form :client="client" :phones="phones" @submit="submit"></create-cli-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url:'api/client/'+this.$route.params.id,
                method: 'POST',
                client: {},
                phones: []
            };
        },
        ready() {
            this.prepareComponent();
        },
        mounted() {
            this.prepareComponent();
        },
        methods: {
            prepareComponent() {
                this.getClient(this.$route.params.id);
                $('.control-label').toggleClass('active');
            },
            submit(formData) {
                formData.set('_method', 'PUT');
                axios({
                    method:this.method,
                    url:this.url,
                    data: formData,
                }).then(response => {
                    swal({
                        title: 'Success',
                        type: 'success',
                        text: 'Client went updated successfully.',
                    });
                }).catch(response => {
                    let errors = Object.assign({}, response);
                    for (let [k,value] of Object.entries(errors.response.data)){
                        swal({
                            title: 'Something went wrong',
                            type: 'error',
                            text: value,
                        });
                    }
                });
            },
            getClient(id) {
                axios.get('api/client/'+id+'/edit')
                    .then(response => {
                        this.client = response.data;
                        this.client.numeroRif = response.data.number_rif;
                        this.phones = response.data.phones;
                    })
            },
        }
    }
</script>