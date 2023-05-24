<script>

import { useNotification } from "@kyvg/vue3-notification";

const { notify }  = useNotification()

const API_ENROLLMENTS = '/api/v1/enrollments'
const API_USERS = '/api/v1/users'
const API_COURSES = '/api/v1/courses'

export default {
    created: function() {
        this.fetch_available_users();
        this.fetch_available_courses();
    },
    data: function() {
        return {
            course_id: null,
            user_id: null,
            users: [],
            courses: [],
            is_loading: false,
            is_error: false,
            error_text: '',
            success_text: '',
        }
    },
    methods: {
        fetch_available_users: function () {
            fetch(API_USERS + '?token=0a68d206-d271-47da-846f-07ec94075f6c')
                .then(res => res.json())
                .then(json => {
                    this.users = json.items;
                });
        },
        fetch_available_courses: function () {
            fetch(API_COURSES + '?token=0a68d206-d271-47da-846f-07ec94075f6c')
                .then(res => res.json())
                .then(json => {
                    this.courses = json.items;
                });
        },
        create_new: function () {
            this.is_error = false;

            if (this.course_id === null && this.user_id === null) {
                this.is_error = true;
                this.error_text = "Please select user's id and course's id"
            } else if (this.course_id === null) {
                this.is_error = true;
                this.error_text = "Please select course's id"
            } else if (this.user_id === null) {
                this.is_error = true;
                this.error_text = "Please select user's id"
            }

            if (!this.is_error) {

                this.is_loading = true;

                fetch(API_ENROLLMENTS, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(
                        {
                            user_id: this.user_id,
                            course_id: this.course_id,
                        }
                    )
                })
                    .then(res => res.json())
                    .then(res => {
                        if (res.status === 'success') {
                            this.success_text = 'You successfully created enrollment, you will be redirected after 2 seconds'

                            setTimeout(() => {
                                window.location.replace('/');
                            }, 2000);

                        } else {
                            this.is_error = true;
                            this.error_text = 'Something wrong with creating enrollment'
                            this.is_loading = false;
                        }
                    });
            }
        },


    },
};
</script>


<template>
    <div class="container mt-5">
        <h1>Create new enrollment</h1>
        <div class="row mt-4">
            <p v-if="is_error" class="error-red">{{ error_text }}</p>
            <p v-if="success_text.length > 0 && !is_error" class="success-text">{{ success_text }}</p>
            <div class="col-4">
                <label for="exampleDataList" class="form-label">Select user's id by email</label>
                <input v-model="user_id" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                <datalist id="datalistOptions">
                    <option v-for="item in users" :value="item.id">{{ item.email }}</option>
                </datalist>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4 mt-3">
                <label for="exampleDataList" class="form-label">Select course's id by title</label>
                <input v-model="course_id" class="form-control" list="datalistCoursesOptions" id="exampleCoursesDataList" placeholder="Type to search...">
                <datalist id="datalistCoursesOptions">
                    <option v-for="item in courses" :value="item.id">{{ item.title }}</option>
                </datalist>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-3">
                <div v-if="(courses.length === 0 && users.length === 0) || is_loading" class="loader"></div>
                <button @click="create_new" v-if="courses.length > 0 && users.length > 0 && !is_loading" type="button" class="btn btn-primary">Create new enrollment</button>
            </div>
        </div>
    </div>
</template>

<style>
    .success-text {
        color: green;
        font-size: 18px;
        font-weight: bold;
    }
    .error-red {
        color: red;
        font-size: 18px;
        font-weight: bold;
    }
    .loader {
        margin: 25px 0 !important;
    }
</style>
