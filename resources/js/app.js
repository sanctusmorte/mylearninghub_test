require('./bootstrap');

import "bootstrap";
import { createApp } from 'vue'
import EnrollmentsList from './components/EnrollmentsList'
import EnrollmentsCreate from './components/EnrollmentsCreate'
import Notifications from '@kyvg/vue3-notification'

const app = createApp({})
app.use(Notifications)

app.component('enrollments-list-component', EnrollmentsList)
app.component('enrollments-create-component', EnrollmentsCreate)


app.mount('#app')
