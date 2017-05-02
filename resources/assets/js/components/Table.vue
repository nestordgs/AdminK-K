<!-- Created by Nestor on 4/5/2017. /-->
<template>
    <table class="table table-responsive">
        <thead>
            <tr class="bg-soluciones">
                <th v-for="key in columns" @click="sortBy(key)" :class="{active: sortKey == key }" class="text-center">
                    {{ key | capitalize }}
                </th>
                <th v-if="link == true"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in filteredData">
                <td v-for="key in columns" v-if="key == 'CI/RIF'" class="text-center">
                    {{ entry.type_doc.initial }}{{ entry.number_rif }}
                </td>
                <td v-for="key in columns" v-if="key != 'CI/RIF'">
                    {{ entry[key] }}
                </td>
                <td v-if="link == true" class="text-center">
                    <router-link :to="{ name: 'editClient', params: { id: entry.id } }" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit
                    </router-link>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: {
            data: Array,
            columns: Array,
            link: Boolean,
            filterKey: String
        },
        data: function () {
            let sortOrders = {};
            this.columns.forEach(function (key) {
                sortOrders[key] = 1
            });
            return {
                sortKey: '',
                sortOrders: sortOrders
            }
        },
        computed: {
            filteredData: function () {
                let sortKey = this.sortKey;
                let filterKey = this.filterKey && this.filterKey.toLowerCase();
                let order = this.sortOrders[sortKey] || 1;
                let data = this.data;

                if (filterKey) {
                    data = data.filter(function (row) {
                        return Object.keys(row).some(function (key) {
                            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                        })
                    })
                }
                if (sortKey) {
                    data = data.slice().sort(function (a, b) {
                        a = a[sortKey];
                        b = b[sortKey];
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }
                return data
            }
        },
        filters: {
            capitalize: function (str) {
                return str.charAt(0).toUpperCase() + str.slice(1)
            }
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
            },
            sortBy: function (key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1
            }
        }
    }
</script>