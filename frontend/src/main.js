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
Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
    token: ''
  },
  mutations: {
    get (state) {
      return state.token
    },
    set(state,newtoken){
      state.token = newtoken
    }
  }
})
axios.defaults.baseURL = 'hhtp://localhost:8000/api'
axios.defaults.headers= {'X-Requested-With': 'XMLHttpRequest','Authorization':'Bearer '+$store.state.token.get};

Vue.use(VueCharts);
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
