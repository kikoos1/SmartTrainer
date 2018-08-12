<template>
  <v-app
          id="inspire"
          :dark = "dark"
  >
    <v-navigation-drawer
            v-model="drawer"
            fixed
            clipped
            app
            v-show = 'logged'
    >
      <v-list dense v-show = 'logged'>
        <v-list-tile v-for="item in items" :key="item.text" @click="" :to = 'item.to'>
          <v-list-tile-action >
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content >
            <v-list-tile-title>
              {{ item.text }}
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click = 'dialog = true'>
          <v-list-tile-action >
            <v-icon>settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-content >
            <v-list-tile-title>
              Settings
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
            color="blue lighten-1"
            clipped-left
            dark
            app
            fixed
    >
      <v-toolbar-side-icon @click.stop="drawer = !drawer" v-show = 'logged'></v-toolbar-side-icon>
      <img src="./imgs/Logo.svg" width = '50px' height = '50px' class="mx-3">
      <v-toolbar-title class="mr-5 align-center">
        <span class="title">Smart Trainer</span>
      </v-toolbar-title>
    </v-toolbar>
    <v-content>
      <v-container justify-center align-center>
      <router-view></router-view>
      </v-container>
      <settings :dialog="dialog"></settings>
    </v-content>
  </v-app>
</template>

<script>
    export default {
        data: () => ({
            drawer: false,
            dialog:false,
            logged:true,
            dark:false,
            items: [
                { icon: 'home', text: 'Dashboard',to:'/dashboard' },
                { icon: 'restaurant_menu', text: 'Daily intake',to:'/daily-intake' },
                { icon: 'trending_up', text: 'Gym Progress' ,to:'/progress'},
                { icon: 'people', text: 'Friends', to:'/friends' },
                { icon: 'trending_up', text: 'Blog',to:'/blog' },
                { icon: 'grade', text: 'Achievments',to:'/achievements' },
                //{ icon: 'settings', text: 'Settings',to:'settings' },
                //{ icon: 'info', text: 'About' },
            ],
        }),
        props: {
            source: String
        },
        created(){
            var app = this;
            if(localStorage.getItem('dark-theme') == 'true'){
                this.dark = true;
            }
            this.$eventBus.$on('change-theme',function (resp) {
                app.dark = resp;
            }),
            setInterval(function(){
              app.post('/api/login')
            },1000);
          this.$eventBus.$on('close-modal',function () {
              app.dialog = false
              setInterval(function(){
                  var now = new Date();
                 var date = now.getHours() + ":"+now.getMinutes();
                 if(date == localStorage.getItem('breakfast')){
                     app.push_notification('',"It's a just a reminder to log you breakfast")
                 }else if(date == localStorage.getItem('lunch')){
                     app.push_notification('',"It's a just a reminder to log you lunch")
                 }else if(date == localStorage.getItem('dinner')){
                     app.push_notification('',"It's a just a reminder to log you dinner")
                 }
              },1000*30)
          })
        }
    }
</script>

<style>
body {
  margin: 0;
}

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

main {
  text-align: center;
  margin-top: 40px;
}

header {
  margin: 0;
  height: 56px;
  padding: 0 16px 0 24px;
  background-color: #35495E;
  color: #ffffff;
}

header span {
  display: block;
  position: relative;
  font-size: 20px;
  line-height: 1;
  letter-spacing: .02em;
  font-weight: 400;
  box-sizing: border-box;
  padding-top: 16px;
}
</style>
