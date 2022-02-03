require('./bootstrap');

// window.Vue = require('vue').default;

import { createApp } from 'vue'
import App from './components/App'
import router from './router'

createApp(App).use(router).mount('#app')

