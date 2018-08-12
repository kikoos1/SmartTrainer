<template>
    <v-card flat>
            <v-card-title>Search for friends</v-card-title>
        <v-layout row pb-2>
            <v-flex xs8 offset-xs2>
                <v-text-field
                    label="Type Name"
                    v-model="search"
                    @keyup = 'Search()'
                ></v-text-field>
            </v-flex>
        </v-layout>
    </v-card>
</template>

<script>
    export default {
        name: "SearchFriends",
        data:()=>({
            search:null
        }),
        methods:{
            Search(){
                console.log(this.search)
            }
        }
    }
</script>

<style scoped>
    .v-card{
        top:0
    }

</style>