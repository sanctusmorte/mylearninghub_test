<script>


const API_ENROLLMENTS = '/api/v1/enrollments'

export default {
    created: function() {
        this.fetch_data();
        this.fetch_available_statuses();
    },
    watch: {
        limit() {
            this.page = 1;
            this.fetch_data()
        },
        user_email() {
            this.fetch_data()
        },
        user_name() {
            this.fetch_data()
        },
        course_title() {
            this.fetch_data()
        },
        status() {
            this.page = 1;
            this.fetch_data()
        },
    },
    data: function() {
        return {
            page: 1,
            limit: 20,
            available_statuses: [],
            enrollments: [],
            currentSort: 'id',
            currentSortDir: 'desc',
            is_loading: true,
            user_email: null,
            user_name: null,
            status: null,
            course_title: null,
            timeout: 0,
        }
    },
    methods: {
        changeSort(sort) {
            if (sort === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = sort;
            this.fetch_data();
        },
        fetch_available_statuses: function (needUrl) {
            fetch(API_ENROLLMENTS + '/available-statuses')
                .then(res => res.json())
                .then(json => {
                    this.available_statuses = json.items;
                });
        },
        fetch_data: function (needUrl) {
            if(this.timeout) clearTimeout(this.timeout);

            if (needUrl !== undefined) {
                this.page = new URL(needUrl).searchParams.get("page");
            }

            let urlParams = {
                'page' : this.page,
                'limit' : this.limit,
                'sort_column' : this.currentSort,
                'sort_dir' : this.currentSortDir,
            }

            if (this.status !== null) {
                urlParams.status = this.status;
            }

            if (this.user_name !== null && this.user_name.length > 2) {
                urlParams.user_name = this.user_name;
            }

            if (this.course_title !== null && this.course_title.length > 2) {
                urlParams.course_title = this.course_title;
            }

            if (this.user_email !== null && this.user_email.length > 2) {
                urlParams.user_email = this.user_email;
            }

            this.timeout = setTimeout(function(){

                this.is_loading = true;

                fetch(API_ENROLLMENTS + '?' + new URLSearchParams(urlParams))
                    .then(res => res.json())
                    .then(json => {

                        json.data = Object.keys(json.data).map((k) => {
                            json.data[k].is_edit = 0;
                            return json.data[k];
                        })

                        this.enrollments = json;

                        this.is_loading = false;
                    });
            }.bind(this),1000);
        },
    },
};
</script>


<template>
    <div class="container mt-5">
        <div class="row d-flex">
            <div class="col-4">
                <label for="search_title" class="form-label">Search by course title (min. 3 symbols)</label>
                <input v-model="course_title" id="search_title" type="text" placeholder="Search by course title" class="form-control">
            </div>
            <div class="col-2">
                <label for="select_limit" class="form-label">Select limit</label>
                <select id="select_limit" v-model="limit" class="form-select">
                    <option :value="20">20</option>
                    <option :value="50">50</option>
                    <option :value="100">100</option>
                </select>
            </div>
            <div class="col-2">
                <label for="filter_status" class="form-label">Filter by status</label>
                <select id="filter_status" v-model="status" class="form-select">
                    <option :value="null">All</option>
                    <option v-for="item in available_statuses" :value="item.status">{{ item.status }}</option>
                </select>
            </div>
        </div>
        <div class="row d-flex mt-3">
            <div class="col-4">
                <label for="user_email" class="form-label">Search by user email (min. 3 symbols)</label>
                <input v-model="user_email" id="user_email" type="text" placeholder="Search by user email" class="form-control">
            </div>
            <div class="col-4">
                <label for="user_name" class="form-label">Search by user name (min. 3 symbols)</label>
                <input v-model="user_name" id="user_name" type="text" placeholder="Search by user name" class="form-control">
            </div>
        </div>
        <div class="row mt-5">
                <div v-if="(enrollments.data === undefined || enrollments.data.length < 1) || is_loading" class="loader"></div>
                <div v-if="enrollments.data !== undefined && enrollments.data.length > 0 && !is_loading">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li :class="item.active ? 'active' : ''" v-for="item in enrollments.meta.links">
                                        <a class="page-link" @click="fetch_data(item.url)" v-html="item.label"></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <span>Total count - {{ enrollments.meta.total }}</span>
                        </div>
                    </div>
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th class="thead-clickable" @click="changeSort('id')" scope="col">Id
                                <ion-icon v-if="currentSort === 'id'" :name="currentSortDir === 'desc' ? 'arrow-down-outline' : 'arrow-up-outline'"></ion-icon>
                            </th>
                            <th class="thead-clickable" @click="changeSort('course_title')" scope="col">Course title
                                <ion-icon v-if="currentSort === 'course_title'" :name="currentSortDir === 'desc' ? 'arrow-down-outline' : 'arrow-up-outline'"></ion-icon>
                            </th>
                            <th class="thead-clickable" @click="changeSort('user_name')" scope="col">User name
                                <ion-icon v-if="currentSort === 'user_name'" :name="currentSortDir === 'desc' ? 'arrow-down-outline' : 'arrow-up-outline'"></ion-icon>
                            </th>
                            <th class="thead-clickable" @click="changeSort('user_email')" scope="col">User email
                                <ion-icon v-if="currentSort === 'user_email'" :name="currentSortDir === 'desc' ? 'arrow-down-outline' : 'arrow-up-outline'"></ion-icon>
                            </th>
                            <th class="thead-clickable" @click="changeSort('status')" scope="col">Status
                                <ion-icon v-if="currentSort === 'status'" :name="currentSortDir === 'desc' ? 'arrow-down-outline' : 'arrow-up-outline'"></ion-icon>
                            </th>
                            <th class="thead-clickable" @click="changeSort('status')" scope="col">Editing
                                <ion-icon v-if="currentSort === 'status'" :name="currentSortDir === 'desc' ? 'arrow-down-outline' : 'arrow-up-outline'"></ion-icon>
                            </th>
                            <th scope="col">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="enrollments.data !== undefined" v-for="item in enrollments.data">
                            <td>
                                <span v-text="item.id"></span>
                            </td>
                            <td>
                                <span v-text="item.course.title"></span>
                            </td>
                            <td>
                                <span v-text="item.user.name"></span>
                            </td>
                            <td>
                                <span v-text="item.user.email"></span>
                            </td>
                            <td>
                                <span v-text="item.status"></span>
                            </td>
                            <td>
                                <span v-text="item.is_edit"></span>
                            </td>
                            <td>
                                <ion-icon name="create-outline"></ion-icon>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else-if="!is_loading">Nothing found</div>
        </div>
    </div>
</template>

<style>
.thead-clickable {
    cursor: pointer;
    position: relative;
}

.thead-clickable ion-icon {
    position: absolute;
    right: 6px;
    top: 13px;
}

.pagination {
    margin-bottom: 0;
}

.pagination li {
    cursor: pointer;
}

.thead-clickable:hover {
    background: #e1e1e1;
}
</style>
