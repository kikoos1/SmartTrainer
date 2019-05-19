// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import CalorieWidget from './components/CalorieWidget'
import AddFoodModal from './components/AddFoodModal';
import mix from './mixin.js'
import axios from 'axios'
import AddGymProgress from './components/AddGymProgress'
import Settings from './components/Settings'
import MealNotifications from './components/MealNotifications'
import VueCharts from 'vue-chartjs'
import Vuex from 'vuex'
import moment from 'moment'
import VueAxios from 'vue-axios';



Vue.mixin(mix);// mixin

//Axios
Vue.use(VueAxios, axios);
axios.defaults.headers= {'Content-Type':'application/x-www-form-urlencoded',
'X-Requested-With': 'XMLHttpRequest',
'Authorization':'Bearer '+localStorage.access_token}
axios.defaults.baseURL = 'http://localhost:8000/api'

//Vue Store
Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    user:[]
  },
  mutations: {
    setUser(state,newuser){
      state.user = newuser
    }
  },
  getters:{
    getUser: state => {
      return state.user;
    }
  }
})
  

Vue.prototype.$store = store;
//Event Bus
Vue.prototype.$eventBus = new Vue();

 //Vue components
Vue.use(VueCharts);
Vue.component('meal-notifications',MealNotifications);
Vue.component('settings',Settings);

Vue.component('add-gym-progress-widget',AddGymProgress);
Vue.component('calorie-widget',CalorieWidget);
Vue.component('add-food-modal',AddFoodModal);

Vue.use(Vuetify);



Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
