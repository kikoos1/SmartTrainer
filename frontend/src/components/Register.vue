

        <template>
            <v-form ref="form" v-model="valid" lazy-validation>
            <v-stepper v-model="e1">
                <v-stepper-header>
                    <v-stepper-step :complete="e1 > 1" step="1"   :rules = "[()=>valid]" editable>Регистрация</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 2" step="2" :rules = "[()=>valid]" editable>Малко информация относно теб</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 3" step="3" :rules = "[()=>valid]" editable>Избери си цел</v-stepper-step>
                    <v-divider></v-divider>

                    <v-stepper-step step="4">Всичко е готово</v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                       <v-container>
                           <v-text-field
                                   type = 'text'
                                   required
                                   label = "Име"
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
                                   label = "Парола"
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
                                label = "Въведи колко тежиш в КГ"
                                required
                                v-model="weight"
                                :rules = 'numberRules'

                        >
                        </v-text-field>

                        <v-text-field
                                type = 'number'
                                step='any'
                                label = "Въведи колко си висок в сантиметри"
                                required
                                v-model="height"
                                 :rules = 'numberRules'
                        >
                        </v-text-field>
                            <v-text-field
                                    type = 'number'
                                    step='any'
                                    label = "Въведи си възраста"
                                    required
                                    v-model="age"
                                     :rules = 'numberRules'
                            >
                            </v-text-field>
                            <v-select
                                    :items = 'activities'
                                    v-model="activity"
                                    label = 'Колко си активен'
                                    single line
                                     :rules = 'selectRules'
                            >

                            </v-select>
                                <v-select
                                    :items = 'genders'
                                    v-model="gender"
                                    label = 'Пол'
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
                        label="Избрери си цел"
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
                           <p>Калории:{{Calories}}</p>
                            <br>
                            <p>Протеин:{{Protein}}</p>
                            <br>
                            <p>Мазнини:{{Fat}}</p>
                            <br>
                            <p>Въглехидрати:{{Carbs}}</p>
                        </v-container>


                        <v-btn
                                color="primary"
                                @click="Register"
                        >
                            Готово
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
            gender:'',
            calories:0,
            protein:0,
            name:'',

            nameRules:[
              v=>!!v||'Име е необходимо'
            ],
            emailRules:[
                v=>!!v||'Email е необходим'
            ],
            passwordRules:[
                v=>!!v||'Парола е необходима'
            ],
            selectRules:[
                v=>!!v||' Моля избери опция',

            ],
            numberRules:[
                v=>!!v||'Това поле е необходимо'
            ],
            fat:0,
            carbs:0,
            height:0,
            activity:0,
            age:0,
            goals:[
                {text:"Сваляй по 0,5кг на седмица",value:-500},
                {text:"Поддържай килограми",value:1},
                {text:"Качвай по 0,5кг на седмица",value:500},
            ],
            activities:[
                {text:'Заседнал начин на живот (малко или никакви упражнения)',value:1.2},
                {text:'Ниско активен (леки упражнения/спорт  1-3 дни/сецмица) ',value:1.375},
                {text:'Средно Активен (Средни упражнения/спорт 3-5 дни/седмица) ',value:1.55},
                {text:'Много Активен (Трудни упражнениея/спорт 6-7 дни/седмица)',value:1.725},
                {text:'Екстремно активен (Много тежки упражнения/ Работа в склад/ Тренировки по 2 пъти на ден) ',value:1.9},
            ],
            genders:[
                {text:"Мъж",value:"male"},
                {text:"Жена",value:"female"}
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
                       height:app.height,
                       weight:app.weight,
                       target:app.goal,
                       activity:app.activity,
                       age:app.age,
                       fat:app.fat,
                       gender:app.gender
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