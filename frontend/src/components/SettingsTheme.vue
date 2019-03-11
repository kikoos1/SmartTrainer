<template>
<v-list>
    <v-list-tile>
        <v-list-tile-action>
            <v-checkbox @change = 'Save' v-model = 'dark' ></v-checkbox>
        </v-list-tile-action>
        <v-list-tile-content>Тъмна тема</v-list-tile-content>
    </v-list-tile>
</v-list>
</template>

<script>
    export default {
        name: "SettingsTheme",
        data:()=>({
            dark:false
        }),
        methods:{
            Save(){
                localStorage.setItem('dark-theme',this.dark);
                this.$eventBus.$emit('change-theme',this.dark);
            }
        },
        created(){
            this.$eventBus.$emit('close-modal');
            if(localStorage.getItem('dark-theme') == 'true'){
                this.dark = true;
            }
        }
    }
</script>

<style scoped>

</style>