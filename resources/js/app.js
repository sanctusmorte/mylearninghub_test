require('./bootstrap');

import "bootstrap";
import { createApp } from 'vue'
import EnrollmentsList from './components/EnrollmentsList'
import { TailwindPagination } from 'laravel-vue-pagination';

const app = createApp({})

app.component('enrollments-list-component', EnrollmentsList)
app.component('TailwindPagination', TailwindPagination)


app.mount('#app')
