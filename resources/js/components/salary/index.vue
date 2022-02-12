<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <router-link to="/given-salary" class="btn btn-primary">Pay Salary</router-link>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Salary</li>
                </ol>
            </div>
        <!--<div class="row">-->
            <!--<div class="col-md-2">-->
                <!--<router-link to="/given-salary" class="btn btn-primary">Pay Salary</router-link>-->
            <!--</div>-->
        <!--</div>-->
        <!--<br>-->
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">

        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Salary List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Month</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="salary in filterSearch" :key="salary.id">
                                <td>{{ salary.salary_month }}</td>
                                <td>
                                    <router-link :to="{name: 'view-salary', params:{id: salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    </div>
</template>

<script>
    export default {
        name: "index",
        created(){
            if (!User.loggedIn()){
                this.$router.push({name: '/'})
            }
        },
        data(){
            return {
                salaries: [],
                searchTerm: '',
            }
        },
        computed : {
            filterSearch(){
                return this.salaries.filter(salary => {
                    return salary.salary_month.match(this.searchTerm)
                })
            }
        },
        methods: {
            allSalary(){
                axios.get('/api/salary/')
                    .then(({data}) => (this.salaries = data))
                    .catch()
            }
        },
        created(){
            this.allSalary()
        }
    }
</script>

<style scoped>
    #em_photo{
        height: 50px;
        width: 50px;
        border-radius: 50%;
    }
</style>