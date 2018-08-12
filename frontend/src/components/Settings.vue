<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click.native="Close()">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Settings</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click.native="Save()">Save</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-divider></v-divider>
                <v-list three-line subheader>
                    <v-subheader>General</v-subheader>
                    <v-list-tile avatar to = '/settings/notifications'>
                        <v-list-tile-action>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Notifications</v-list-tile-title>
                            <v-list-tile-sub-title>Notify me about new messages</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile avatar to = '/settings/profile'>
                        <v-list-tile-action>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Profile</v-list-tile-title>
                            <v-list-tile-sub-title>Settings for your profile</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile avatar to = '/settings/theme'>
                        <v-list-tile-action>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Theme</v-list-tile-title>
                            <v-list-tile-sub-title>Chose dark or light theme</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile to = '/about' @click = ''>
                        <v-list-tile-content >
                            <v-list-tile-title>About</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click = 'Logout()' class = 'red--text'>
                        <v-list-tile-content >
                            <v-list-tile-title>Logout</v-list-tile-title>
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

            },
            Save(){
                this.Close();
            }
        },
    }
</script>

<style scoped>

</style>