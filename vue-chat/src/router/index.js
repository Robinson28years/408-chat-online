import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import chat from '@/components/chat'
import test from '@/views/test.vue'

Vue.use(Router)

export default new Router({
  routes: [
    // {
    //   path: '/',
    //   name: 'Hello',
    //   component: Hello
    // },
    // {
    //   path: '/chat',
    //   component: chat
    // },
    {
      path: '/test',
      component: test
    }
  ]
})
