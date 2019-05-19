<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">Профил</span>
                    <v-btn flat icon @click = "edit = !edit"><v-icon>edit</v-icon></v-btn>
                </v-card-title>
             <center>
                      <v-avatar
          
          color="grey lighten-4"
          size="117"
        >
          <img :src="this.user.img_url" alt="avatar">
        </v-avatar>
        </center>
        <center>
         <v-btn flat @click = "change = !change">Промени Снимката</v-btn>
         </center>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout  wrap>
                             <v-flex xs12>
                                <v-text-field label="Линк към снимката" v-show="change" v-model="user.img_url" required ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field label="Име" v-model="user.name" required :disabled="!edit"></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Email" v-model="user.email" required type="email" disabled></v-text-field>
                            </v-flex>
                             <v-flex xs12 >
                                <v-text-field label="Височина(см)" v-model="user.height" required type = "number" :disabled="!edit"></v-text-field>
                            </v-flex>
                             <v-flex xs12 >
                                <v-text-field label="Килогарми(кг)" v-model="user.weight" required type = "number" step="any" :disabled="!edit"></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Възраст" v-model="user.age" required type = "number"  :disabled="!edit"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="Close">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="Save">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        name: "Profile",
        props:['dialog'],
        data:()=>({
            edit:false,
            change:false,
            user:{}
        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal');
            },
            Save(){
                this.Close();
                var app = this
                var cal = this.Calculate_Calories(this.user.weight,this.user.height,this.user.age,this.user.activity,this.user.target);
                console.log(cal);
                this.patch('/auth/user',{
                    name:this.user.name,
                    calories:cal.calories,
                    protein:cal.protein,
                    carbs:cal.carbs,
                    fat:cal.fat,
                    img_url:this.user.img_url,
                    weight:this.user.weight,
                    height:this.user.height,
                    target:this.user.target,
                    age:this.user.age,
                    activity:this.user.activity, 
                    gender:this.user.gender
                }).then(function(){
                    app.Close();
                    app.change = false;
                    app.edit = false;
                })
            }
        },
        created(){
            var app = this;
            this.get('/auth/user').then(function (resp) {
                app.user = resp.data
            })
        }
    }
</script>

<style scoped>

</style>