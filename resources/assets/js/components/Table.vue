<!-- Created by Nestor on 4/5/2017. /-->
<template>
    <table class="table table-responsive">
        <thead>
            <tr class="bg-soluciones">
                <th v-for="key in columns" @click="sortBy(key)" :class="{active: sortKey == key }" class="text-center">
                    {{ key | capitalize }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in filteredData">
                <td v-for="key in columns" v-if="key == 'CI/RIF'">
                    <!--{{ entry[key] }}- {{ entry[key] }}-->
                    {{ entry.id_type_doc }} - {{ entry.number_rif }}
                </td>
                <td v-for="key in columns" v-if="key != 'CI/RIF'">
                    {{ entry[key] }}
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