<template>
    <v-container grid-list-sm fluid align-content-center>
        <v-btn
                color="blue"
                dark
                fixed
                bottom
                right
                fab
                @click = "show = !show"
        >
            <v-icon>add</v-icon>

        </v-btn>
        <SearchFriends v-show = 'show'></SearchFriends>
        <br>
    <v-layout row wrap>
        <v-flex d-flex xs12 sm6 md4 v-if="searchresults.length == 0">
            <v-card>
                <v-card-media
                        src="https://scontent-sof1-1.xx.fbcdn.net/v/t1.0-9/35761517_1026576604163337_5866743370046504960_n.jpg?_nc_cat=0&oh=b24f20d3f84ac2f5db741adbdf299999&oe=5C0EF9F2"
                        height="350px"
                >
                </v-card-media>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">Zlatin Stefaonv</div>
                        <span class="grey--text">1,000 miles of wonder</span>
                    </div>
                </v-card-title>
                <v-card-actions>
                    <v-btn flat color="blue">View Profile</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn flat color="purple"><v-icon>send</v-icon>Send Message</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
        </v-container>
</template>

<script>
    import SearchFriends from './SearchFriends'
    export default {
        name: "Friends",
        components:{
            SearchFriends
        },
        data:()=>({
            show:false,
            friends:[],
            searchresults:[]
        })
    }
</script>

<style scoped>

</style>