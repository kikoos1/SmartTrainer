<template>
    <div>
    <v-list three-line subheader>
        <v-subheader>General</v-subheader>
        <v-list-tile avatar>
            <v-list-tile-action>
                <v-checkbox v-model = 'notifications' input-value="false" @change = 'ChangeNotif()'></v-checkbox>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Notifications</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click = 'mealnotif = true' v-if = 'notifications'>
            <v-list-tile-content >
                <v-list-tile-title>Set when to send notifications for meals</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>
        <meal-notifications :dialog= 'mealnotif'></meal-notifications>
    </div>
</template>

<script>
    export default {
        name: "SettingsNotfications",
        data:()=>({
            notifications:false,
            mealnotif:false
        }),
        methods:{
            ChangeNotif(){
                localStorage.setItem('notifications',this.notifications);
            }
        },
        created(){
            this.$eventBus.$emit('close-modal');
            var app = this;

            if(localStorage.getItem('notifications')!= null){
                console.log(localStorage.getItem('notifications'));
                console.log(this.notifications);
                    if(localStorage.getItem('notifications') == 'false'){
                        this.notifications = false;
                    }else {
                        this.notifications = true;
                    }

            }
            this.$eventBus.$on('close-modal',function () {
                app.mealnotif = false;
            })
        }
    }
</script>

<style scoped>

</style>