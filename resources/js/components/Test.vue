<script>

const API_ENROLLMENTS = '/api/v1/enrollments'

export default {
    created: function() {
        this.fetch_data();
    },
    data: function() {
        return {
            enrollments: [],
        }
    },
    methods: {
        fetch_data: function () {
            fetch(API_ENROLLMENTS)
                .then(res => res.json())
                .then(json => {
                    this.deals = Object.keys(json.items).map((k) => {
                        return json.items[k];
                    })
                });
        },
    },
};
</script>


<template>
    <div class="container mt-5">
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
