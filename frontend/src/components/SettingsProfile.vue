<template>
    <div>
        <v-list three-line subheader>
            <v-subheader>Генерални</v-subheader>
            <v-list-tile avatar @click = 'profile = true'>
                <v-list-tile-action>
                    <v-icon>account_circle</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Профил</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile avatar @click = 'calories_and_nutrition = true'>
                <v-list-tile-action>
                    <v-icon>restaurant</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Калории и макроси</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <Profile :dialog = 'profile'></Profile>
        <CalorieAndNutrition :dialog = 'calories_and_nutrition'></CalorieAndNutrition>
    </div>
</template>

<script>
    import Profile from '../components/Profile'
    import CalorieAndNutrition from '../components/CalorieAndNutrition'
    export default {
        name: "SettingsProfile",
        components:{
            Profile,
            CalorieAndNutrition
        },
        data:()=>({
            profile:false,
            calories_and_nutrition:false
        }),
        created(){
            var app = this;
            this.$eventBus.$on('close-modal',function () {
                app.profile = false;
                app.calories_and_nutrition = false;
            })
            this.$eventBus.$emit('close-modal')
        }
    }
</script>

<style scoped>

</style>