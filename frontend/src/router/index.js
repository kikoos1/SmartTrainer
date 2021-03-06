import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Login from '@/components/Login'
import Register from '@/components/Register'
import Dashboard from '@/components/Dashboard'
import DailyIntake from '@/components/DailyIntake'
import Blog from '@/components/Blog'
import Article from '@/components/Article'
import Progress from '@/components/Progress'
import Settings from '@/components/Settings'
import SettingsNotfications from '@/components/SettingsNotfications'
import SettingsProfile from '@/components/SettingsProfile'
import Achievements from '@/components/Achievments'
import SettingsTheme from '@/components/SettingsTheme'
import About from '@/components/About'
import Friends from '@/components/Friends'
import KgProgress from '@/components/KgProgress'
import AddMeal from '@/components/AddMeal'
import Workout from '@/components/Workout'
import Exercise from "../components/Exercise";

Vue.use(Router)

export default new Router({
    //mode:'history',
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
      {
          path: '/',
          name: 'Login',
          component: Login
      },
      {
          path: '/register',
          name: 'Register',
          component: Register
      },
      {
          path: '/dashboard',
          name: 'Dashboard',
          component: Dashboard
      },
      {
          path: '/daily-intake',
          name: 'DailyIntake',
          component: DailyIntake
      },
      {
          path: '/blog',
          name: 'Blog',
          component: Blog
      },
      {
          path: '/article',
          name: 'Article',
          component: Article
      },
      {
          path: '/progress',
          name: 'Progress',
          component: Progress
      },
      {
          path: '/settings/',
          name: 'Settings',
          component: Settings
      },
      {
          path: '/settings/notifications',
          name: 'SettingsNotifications',
          component: SettingsNotfications
      },
      {
          path: '/settings/profile',
          name: 'SettingsProfile',
          component: SettingsProfile
      },
      {
          path: '/achievements',
          name: 'Achievements',
          component: Achievements
      },
      {
          path: '/settings/theme',
          name: 'SettingsTheme',
          component: SettingsTheme
      },
      {
          path: '/about',
          name: 'About',
          component: About
      },
      {
          path: '/friends',
          name: 'Friends',
          component: Friends
      },
      {
          path: '/kg-progress',
          name: 'KgProgress',
          component: KgProgress
      },
      {
          path:'/daily-intake/addFood/',
          name:'AddMeal',
          component:AddMeal,
      },
      {
          path:'/daily-intake/addmeal/:id',
          name:'AddMeal',
          component:AddMeal,
          props:true
      },
      {
        path:'/daily-intake/updateMeal/:meal_id',
        name:'AddMeal',
        component:AddMeal,
        props:true
    },

      {
          path:'/workout/:id',
          name:'Workout',
          component:Workout,
          props:true
      },
      {
        path:'/workout/:id/addExercise/:exercise_id',
        name:'Exercise',
        component:Exercise,
        props:true
    },
      {
          path:'/exercises/add',
          name:'exercise',
          component:Exercise,
          //props:true
      },
      {
          path:'/exercises/edit',
          name:'exercise',
          component:Exercise,
          props:true
      },

  ]
})
