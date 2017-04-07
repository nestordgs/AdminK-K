/**
* Created by Nestor on 3/22/2017.
*/
<template>
    <p v-if="typeDocs.length === 0">You have not created any Document Type.</p>
    <div class="mdl-selectfield" v-else-if="typeDocs.length > 0">
        <select v-model="typeRif" class="browser-default">
            <option v-for="typeDoc in typeDocs" v-bind:value="typeDoc.id" :selected="typeDoc.id == select">
                {{ typeDoc.name }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            select: {
                type: Number,
                required: true
            },
        },
        /*
         * The component's data.
         */
        data() {
            return {
                typeDocs: [],
                typeRif: '',
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getTypeDocs();
            },

            /**
             * Get all of the OAuth clients for the user.
             */
            getTypeDocs() {
                axios.get('/api/TypeDocs')
                    .then(response => {
                        this.typeDocs = response.data;
                    });
            },
        }
    }
</script>