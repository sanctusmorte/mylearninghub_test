require('./bootstrap');

import "bootstrap";
import { createApp } from 'vue'
import Test from './components/Test'

const app = createApp({})

app.component('test-component', Test)

app.mount('#app')
