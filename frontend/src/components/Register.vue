

        <template>
            <v-form ref="form" v-model="valid" lazy-validation>
            <v-stepper v-model="e1">
                <v-stepper-header>
                    <v-stepper-step :complete="e1 > 1" step="1"   :rules = "[()=>valid]" editable>Register</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 2" step="2" :rules = "[()=>valid]" editable>Getting some information about you</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 3" step="3" :rules = "[()=>valid]" editable>Select your goal</v-stepper-step>
                    <v-divider></v-divider>

                    <v-stepper-step step="4">Finish</v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                       <v-container>
                           <v-text-field
                                   type = 'text'
                                   required
                                   label = "Name"
                                   :rules = 'nameRules'
                                   v-model = 'name'

                           ></v-text-field>
                           <v-text-field
                                   type = 'email'
                                   required
                                   label = "Email"
                                    :rules = 'emailRules'
                                    v-model = 'email'
                           ></v-text-field>
                           <v-text-field
                                   type = 'password'
                                   required
                                   label = "Password"
                                  :rules = 'passwordRules'
                                  v-model = 'password'
                           ></v-text-field>
                       </v-container>
                        <v-btn
                                color="primary"
                                @click="e1 = 2"
                        >
                            Continue
                        </v-btn>

                        <v-btn flat>Cancel</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="2">
                        <v-container>
                        <v-text-field
                                type = 'number'
                                step='any'
                                label = "Enter your weight in kg"
                                required
                                v-model="weight"
                                :rules = 'numberRules'

                        >
                        </v-text-field>

                        <v-text-field
                                type = 'number'
                                step='any'
                                label = "Enter your height in cm"
                                required
                                v-model="height"
                                 :rules = 'numberRules'
                        >
                        </v-text-field>
                            <v-text-field
                                    type = 'number'
                                    step='any'
                                    label = "Enter your age"
                                    required
                                    v-model="age"
                                     :rules = 'numberRules'
                            >
                            </v-text-field>
                            <v-select
                                    :items = 'activities'
                                    v-model="activity"
                                    label = 'select your activity'
                                    single line
                                     :rules = 'selectRules'
                            >

                            </v-select>

                        <v-btn
                                color="primary"
                                @click="e1 = 3"
                        >
                            Continue
                        </v-btn>

                        <v-btn flat>Cancel</v-btn>
                        </v-container>
                    </v-stepper-content>

                    <v-stepper-content step="3">
                       <v-container>
                          <v-select
                        v-model="goal"
                        :items="goals"
                        :rules="selectRules"
                        label="Select goal"
                        required
                            ></v-select>
                       </v-container>


                        <v-btn
                                color="primary"
                                @click="e1 = 4"
                        >
                            Continue
                        </v-btn>

                        <v-btn flat>Cancel</v-btn>
                    </v-stepper-content>
                    <v-stepper-content step="4">
                        <v-container>
                           <p>Calories:{{Calories}}</p>
                            <br>
                            <p>Protein:{{Protein}}</p>
                            <br>
                            <p>Fat:{{Fat}}</p>
                            <br>
                            <p>Carbs:{{Carbs}}</p>
                        </v-container>


                        <v-btn
                                color="primary"
                                @click="Register"
                        >
                            Finish
                        </v-btn>

                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
            </v-form>
</template>

<script>
    export default {
        name: "Register",
        data:()=>({
            email:'',
            register:true,
            info:true,
            goals:true,
            password:'',
            valid:true,
            weight:0,
            e1:0,
            goal:0,

            calories:0,
            protein:0,
            name:'',

            nameRules:[
              v=>!!v||'Name is required'
            ],
            emailRules:[
                v=>!!v||'Email is required'
            ],
            passwordRules:[
                v=>!!v||'Password is required'
            ],
            selectRules:[
                v=>!!v||' Please select an option',

            ],
            numberRules:[
                v=>!!v||'This Field is required'
            ],
            fat:0,
            carbs:0,
            height:0,
            activity:0,
            age:0,
            goals:[
                {text:"Lose 0.5 per week",value:-500},
                {text:"Maintain current weight",value:1},
                {text:"Gain 0.5 per week",value:500},
            ],
            activities:[
                {text:'Sedentary (little to no exercise)',value:1.2},
                {text:'Lightly Active (light exercise/sports 1-3 days/week) ',value:1.375},
                {text:'Moderately Active (moderate exercise/sports 3-5 days/week) ',value:1.55},
                {text:'Very Active (hard exercise/sports 6-7 days a week)',value:1.725},
                {text:'Extremely Active (very heavy exercise/ physical job/ training twice a day) ',value:1.9},
            ]
        }),
        methods:{
            Register(){
                var app = this;
                if (this.$refs.form.validate()) {
                   this.post('/auth/register',{
                       email:app.email,
                       name:app.name,
                       password:app.password,
                       calories:app.calories,
                       protein:app.protein,
                       carbs:app.carbs,
                       fat:app.fat
                   }).then(function(){
                        app.$router.push('/');
                   })
                }
            }
        },
        computed:{
            Calories(){
                var  bmr = ((this.height*6.25)+(this.weight*9.99)-(this.age*4.92)+5);
                var calories = (bmr*this.activity)+(this.goal)
                this.calories = calories
                return  Math.round(calories);
            },
            Protein(){
                 this.protein = this.weight*2;
                return this.protein
            },
            Carbs(){
                this.carbs = (this.calories-((this.protein*4)+(this.fat*9)));
                this.carbs = this.carbs/4;
                return Math.floor(this.carbs)
            },
            Fat(){
                this.fat = Math.round(this.weight);
                return this.fat
            }
        }
    }
</script>

<style scoped>

</style>