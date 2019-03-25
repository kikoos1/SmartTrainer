<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click.native="Close()">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Настройки</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click.native="Save()">Запази</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-divider></v-divider>
                <v-list three-line subheader>
                    <v-subheader>Генерални</v-subheader>
                    <v-list-tile avatar to = '/settings/notifications'>
                        <v-list-tile-action>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Известия</v-list-tile-title>
                            <v-list-tile-sub-title>Напомняй ми за храненията</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile avatar to = '/settings/profile'>
                        <v-list-tile-action>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Профил</v-list-tile-title>
                            <v-list-tile-sub-title>Настройки на профила</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile avatar to = '/settings/theme'>
                        <v-list-tile-action>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Тема</v-list-tile-title>
                            <v-list-tile-sub-title>Избери каква да е темата на приложението</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile to = '/about' @click = ''>
                        <v-list-tile-content >
                            <v-list-tile-title>Относно</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click = 'Logout()' class = 'red--text'>
                        <v-list-tile-content >
                            <v-list-tile-title>Излез</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>



                </v-list>
            </v-card>
        </v-dialog>
    </v-layout>
</template>
<script>
    export default {
        name: "Settings",
        props:['dialog'],
        data:()=>({
        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal');
            },
            Logout(){
                this.$eventBus.$emit('logout');
                this.Close();
            },
            Save(){
                this.Close();
            }
        },
    }
</script>

<style scoped>

</style>