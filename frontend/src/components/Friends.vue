<template>
    <v-container grid-list-sm fluid align-content-center>
        <v-btn
                :dark="dark"
                fixed
                bottom
                right
                fab
                @click = "show = !show"
        >
            <v-icon>add</v-icon>

        </v-btn>
       <v-card flat v-show = 'show'>
            <v-card-title>Потърси приятели</v-card-title>
        <v-layout row pb-2>
            <v-flex xs8 offset-xs2>
                <v-text-field
                    label="Въведи име"
                    v-model="search"
                ></v-text-field>
            </v-flex>
        </v-layout>
    </v-card>
        <br>
    <v-layout row wrap>
        <v-flex d-flex xs12 sm6 md4>
            <v-card v-for="friend in friends" :key="friend.id">
                <v-card-media
                        :src="friend.img_url"
                        height="350px"
                >
                </v-card-media>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">{{friend.name}}</div>
                        <span class="grey--text">1,000 miles of wonder</span>
                    </div>
                </v-card-title>
                <v-card-actions v-if="friend.is_friends" >
                    <v-btn flat color="blue">Профил</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn flat color="purple"><v-icon>send</v-icon>Съобщение</v-btn>
                </v-card-actions>
                 <v-card-actions v-else >
                    <v-btn flat color="blue" @click='Add_As_Friend(friend.id)' v-if = "send">
                        <v-icon>add</v-icon>
                        Добави като приятел
                        </v-btn>

                    <v-btn flat color="blue" v-else-if="send">
                        <v-icon>add</v-icon>
                        Поканата е изпратена
                        </v-btn>
                         <v-btn flat color="purple" @click="" >
                        <v-icon>send</v-icon>
                        Съобщение
                        </v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
        </v-container>
</template>

<script>
    export default {
        name: "Friends",
        data:()=>({
            show:false,
            friends:[],
            search:'',
            send:false,
            dark:localStorage.getItem("dark-theme")
            
        }),
        methods:{
            Search(){
                var app = this;
                this.get('/friends/search/'+this.search).then(function(resp){
                    app.friends = resp.users;
                })
            },
            Add_As_Friend(id){
                var app = this;
                this.post('/friends/requests/send',{
                    user_id:id
                }).then(function(){
                    app.send = true;
                })
            }
        },
        created(){
            var app = this;
            this.get('/friends').then(function(resp){
                app.friends = resp.friends;
            })
        },
        watch:{
            search(val){
                this.Search();
            }
        }
    }
</script>

<style scoped>

</style>