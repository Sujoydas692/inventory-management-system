<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <router-link to="/store-employee" class="btn btn-primary">Add Employee</router-link>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee</li>
                </ol>
            </div>
        <!--<div class="row">-->
            <!--<div class="col-md-2">-->
                <!--<router-link to="/store-employee" class="btn btn-primary">Add Employee</router-link>-->
            <!--</div>-->
        <!--</div>-->
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">

        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="employee in filterSearch" :key="employee.id">
                                <td>{{ employee.name }}</td>
                                <td><img :src="employee.photo" alt="" id="em_photo"></td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ employee.salary }} <b>Tk</b></td>
                                <td>{{ employee.joining_date }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-employee', params:{id: employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                    <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"><font color="#fff">Delete</font></a>
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
                employees: [],
                searchTerm: '',
            }
        },
        computed : {
            filterSearch(){
                return this.employees.filter(employee => {
                    return employee.name.match(this.searchTerm)
                })
            }
        },
        methods: {
            allEmployee(){
                axios.get('/api/employee/')
                    .then(({data}) => (this.employees = data))
                    .catch()
            },
            deleteEmployee(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/api/employee/'+id)
                            .then(() => {
                                this.employees = this.employees.filter(employee => {
                                    return employee.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'employee'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        },
        created(){
            this.allEmployee()
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