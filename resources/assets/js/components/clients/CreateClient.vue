<!-- Created by Nestor on 4/2/2017. /-->
<template>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="card">
                    <div class="card-block">
                        <div class="form-header bg-soluciones text-center">
                            <h4><i class="fa fa-lock"></i> Create Client:</h4>
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
                url: '/api/client',
                method: 'post',
                client: {
                    name: '',
                    id_type_doc: 1,
                    numeroRif: '',
                    address: '',
                    email: '',
                    contact: '',
                },
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

            },
            submit(formData) {
                axios({
                    method:this.method,
                    url:this.url,
                    data: formData,
                }).then(response => {
                    swal({
                        title: 'Success',
                        type: 'success',
                        text: 'Client successfully created.',
                    });
                    this.resetForm();
                    $(".control-label").toggleClass('active');
                }).catch(response => {
                    let errors = Object.assign({}, response);
                    for (let [k,value] of Object.entries(errors.response.data)){
                        swal({
                            title: 'Something Went Wrong',
                            type: 'error',
                            text: value,
                        });
                    }
                });
            },
            resetForm() {
                this.client = {
                    name: '',
                    id_type_doc: 1,
                    numeroRif: '',
                    address: '',
                    email: '',
                    contact: '',
                };
                this.phones = {}
            }
        }
    }
</script>