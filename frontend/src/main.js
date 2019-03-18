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

var token = localStorage.getItem('token');
Vue.use(Vuex)
axios.defaults.baseURL = 'http:///89.253.142.114:8000/api'
const store = new Vuex.Store({
  state: {
    token: localStorage.getItem('token'),
    user:[]
  },
  mutations: {
    set(state,newtoken){
      state.token = newtoken
    },
    setUser(state,newuser){
      state.user = newuser
    }
  },
  getters:{
    get: state => {
      return state.token;
    },
    getUser: state => {
      return state.user;
    }
  }
})
  

Vue.prototype.$store = store;
if(localStorage.getItem('token') && localStorage.getItem('access_token') != ''){
  axios.defaults.headers= {'Content-Type':'application/x-www-form-urlencoded','X-Requested-With': 'XMLHttpRequest','Authorization':'Bearer '+localStorage.getItem('access_token')};
}
//axios.defaults.headers= {'Content-Type':'application/x-www-form-urlencoded','X-Requested-With': 'XMLHttpRequest'};
//axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
//axios.defaults.headers.Authorization =   token;


Vue.use(VueCharts);
Vue.use(moment);
Vue.component('meal-notifications',MealNotifications);
Vue.component('settings',Settings);
Vue.mixin(mix);
Vue.component('add-gym-progress-widget',AddGymProgress);
Vue.component('calorie-widget',CalorieWidget);
Vue.component('add-food-modal',AddFoodModal);
Vue.prototype.$eventBus = new Vue();
Vue.use(Vuetify);



Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
