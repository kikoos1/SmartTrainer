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
        <v-list-tile v-for="item in items" :key="item.text" @click="" :to = 'item.to' round>
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
              Настройки
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
            
            clipped-left
            :dark = dark
            app
            fixed
    >
      <v-toolbar-side-icon @click.stop="drawer = !drawer" v-show = 'logged'></v-toolbar-side-icon>
      <img src="./imgs/Logo.svg" width = '50px' height = '50px' class="mx-3">
      <v-toolbar-title class="mr-5 align-center">
        <span class="title">Smart Trainer</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>






<v-menu :nudge-width="100" >
        <template v-slot:activator="{ on }">
          <v-toolbar-title v-on="on">
           <v-badge left color = "red">
      <template v-slot:badge >
        <span>{{notifications.lenght}}</span>
      </template>
      <v-btn icon  v-show="logged">
        <v-icon
          large
        >
         notifications
        </v-icon>
      </v-btn>
    </v-badge>
          </v-toolbar-title>
        </template>

        <v-list>
          <v-list-tile
            v-for="notification in notifications"
            :key="notification.id"
            @click=""
          >
            <v-list-tile-content>{{notification.text}}</v-list-tile-content>
            <v-list-tile-action v-if="notification.type == 'friends'">
            <v-btn icon flat color = "green" @click = 'Accept(notification.id)'> 
              <v-icon >
                done
              </v-icon>
            </v-btn>
          </v-list-tile-action>
          <v-list-tile-action v-if="notification.type == 'friends'">
            <v-btn icon flat color = "red" @click = 'Decline(notification.id)'> 
              <v-icon >
                delete
              </v-icon>
            </v-btn>
          </v-list-tile-action>
          </v-list-tile>


          <v-list-tile v-if='notifications.lenght != 0'>
            <v-list-tile-content>
             
            </v-list-tile-content>
            <v-list-tile-action>
              <v-btn  flat @click = 'notifications = []'>
                 Изчисти всички
                <v-icon>clear</v-icon>
              </v-btn>
            </v-list-tile-action>
          </v-list-tile>
          
        </v-list>
      </v-menu>
      
    </v-toolbar>
    <v-content>
      <v-alert v-show="isconfirm"
               :value="true"
               type="error"
      >
        Email is not confirmed!
      </v-alert>
      <v-container justify-center align-center>
      <router-view></router-view>
      </v-container>
      <settings :dialog="dialog"></settings>

    </v-content>
  </v-app>
</template>

<script>
import Pusher from 'pusher-js'
    export default {
        data: () => ({
            drawer: false,
            dialog:false,
            logged:false,
            dark:false,
            isconfirm:false,
            notifications:[],
            items: [
                { icon: 'home', text: 'Начало',to:'/dashboard' },
                { icon: 'restaurant_menu', text: 'Хранителен дневник',to:'/daily-intake' },
                { icon: 'trending_up', text: 'Прогрес' ,to:'/kg-progress'},
              { icon: 'fitness_center', text: 'Тренировки',to:'/progress' },
                { icon: 'people', text: 'Приятели', to:'/friends' },
                { icon: 'ballot', text: 'Блог',to:'/blog' },
                { icon: 'grade', text: 'Постижения',to:'/achievements' },
                //{ icon: 'settings', text: 'Settings',to:'settings' },
                //{ icon: 'info', text: 'About' },
            ],
        }),
        props: {
            source: String
        },
        //Methods
        methods:{
          //Notifications
           FilterNotif(id){
             var app = this;
            this.notifications.forEach(notif=>{
              if(notif.id == id){
                 var idd=app.notifications.indexOf(notif);
                 app.notifications.splice(idd,1);

              }
            })
          },
          Accept(id){
            this.patch('/friends/requests/accept',{
              id:id
            })
            this.FilterNotif(id);
          },
          Decline(id){
            this.delete('/friends/requests/decline/'+id);
            this.FilterNotif(id);
          },
          getRequests(){
            var app = this;
            this.notifications = [];
             this.get('/friends/requests').then(function(resp){
              if(resp.requests !=[]){
                resp.requests.forEach(element => {
                  var notification = {
                  id:element.id,
                  text:element.user.name+" ви изпрати покана",
                  type:"friends"
                }
                app.notifications.unshift(notification);
                });
                
               
              }
              
            });
          },
         
            //Checking auth
          isAuth(){
            var app = this;

            //app.$eventBus.$emit('timer-start');
            if(localStorage.access_token){
            var x = setInterval(function(){
            app.get('/auth/user').then(function(){
              app.logged = true;
              //app.$router.push('/dashboard');
              if(!app.logged){
                app.$eventBus.$emit('logged');
              }
             

            }).catch(function(resp){
              app.$eventBus.$emit('logout')
                //localStorage.setItem('token','')
             clearInterval(x);
            })
            },5000)
          }
          },
          //Puhser
          subscribe(){
          var user = this.$store.getters.getUser;
          var app = this;
        console.log(user.id);
     let pusher = new Pusher('971da6d621cb4b98ebfe', { cluster: 'eu' })
      pusher.subscribe('user-'+user.id)
      pusher.bind("App\\Events\\FriendRequest", data => {
        app.push_notification('',data.text);
       app.getRequests();
      })
          },
            //Fetching the user
          fetchUser(){
            this.isAuth();
            var app = this;
            this.get('/auth/user').then(function(resp){
              app.$store.commit('setUser',resp.data);
              if(!resp.data.isconfirm){
                app.isconfirm = true
              }
              app.subscribe();
            })
           this.getRequests();
          },
            //Changing theme
          SetDark(dark_theme = ''){
            if(dark_theme != ''){
              this.dark = dark_theme;
            }
            if(localStorage.getItem('dark-theme') == 'true'){
                this.dark = true;
            }else{
                this.dark = false;
            }
          }
        },
        //Created function
        created(){
          var app = this;
         // this.isAuth();
          //Checking if the user is logged and fetch the user
          //app.isAuth();
          if(!localStorage.access_token){
        localStorage.setItem('access_token','');
      }
            this.fetchUser();
          this.$eventBus.$on('logged',function(){
              app.isAuth();
            app.$router.push('/dashboard');
            //PUSHER
            app.subscribe()
        })
        //Logout events
      this.$eventBus.$on('logout',function(){
        localStorage.removeItem('access_token') 
        app.logged = false;
        
        app.$router.push('/');
        
      })
      
        
            //Theme
            this.SetDark();
            this.$eventBus.$on('change-theme',function (resp) {
                app.SetDark(resp);
            }),

          //Settings
          this.$eventBus.$on('close-modal',function () {
              app.dialog = false
              //Notification
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
