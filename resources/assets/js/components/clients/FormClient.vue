<!-- Created by Nestor on 4/3/2017. /-->
<template>
    <form @submit.prevent="submit" novalidate v-cloak>
        <div class="form-group md-form">
            <label for="name" class="control-label">Name</label>
            <input v-model="client.name" type="text" class="form-control" name="name" id="name">
        </div>
        <p v-if="typeDocs.length === 0">You have not created any Document Type.</p>
        <div class="form-group mdl-selectfield md-form" v-if="typeDocs.length > 0">
            <select v-model="client.id_type_doc" class="browser-default">
                <option v-for="typeDoc in typeDocs" v-bind:value="typeDoc.id">
                    {{ typeDoc.name }}
            </option>
            </select>
        </div>
        <div class="form-group md-form">
            <label for="numeroRif" class="control-label">CI/RIF</label>
            <input v-model="client.numeroRif" type="text" class="form-control" name="numeroRif" id="numeroRif">
        </div>
        <div class="form-group md-form">
            <label for="address" class="control-label">Address</label>
            <input v-model="client.address" type="text" class="form-control" name="address" id="address">
        </div>
        <div class="form-group md-form">
            <label for="email" class="control-label">Email</label>
            <input v-model="client.email" type="text" class="form-control" name="email" id="email">
        </div>
        <div class="form-group md-form">
            <label for="contact" class="control-label">Contact</label>
            <input v-model="client.contact" type="text" class="form-control" name="contact" id="contact">
        </div>
        <div class="form-group">
            <div class="col-md-12 col-md-offset- text-center">
                <button class="btn btn-primary">
                    <i class="glyphicon glyphicon-save"></i>
                    Save
                </button>
            </div>
        </div>
    </form>

    <!--<notify v-bind:alert="alert"></notify>-->
</template>

<script>
    export default {
        props: {
            client: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                alert: {
                    show: false,
                    type: null,
                    title: null,
                    message: null,
                },
                typeDocs: [],
                errors: {}
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
                // Set all methods for init
                this.getTypeDocs();
            },
            submit() {
                let formData = new FormData();

                formData.set('name', this.client.name);
                formData.set('id_type_doc', this.client.id_type_doc);
                formData.set('number_rif', this.client.numeroRif);
                formData.set('address', this.client.address);
                formData.set('email', this.client.email);
                formData.set('contact', this.client.contact);

                this.$emit('submit', formData);
            },
            getTypeDocs() {
                axios.get('/api/TypeDocs')
                    .then(response => {
                        this.typeDocs = response.data;
                    });
            },
        },
        events: {
            'formErrors'(errors) {
                this.errors = errors;
            },
        },
    }
</script>