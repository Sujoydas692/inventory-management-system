<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <router-link to="/order" class="btn btn-primary">Today Order</router-link>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
            </div>
        <!--<div class="row">-->
            <!--<div class="col-md-2">-->
                <!--<router-link to="/order" class="btn btn-primary">Today Order</router-link>-->
            <!--</div>-->
        <!--</div>-->

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Search Order</h1>
                                    </div>
                                    <!-- Form Start -->
                                    <form class="user" @submit.prevent="searchDate">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlTextarea1"><b>search By Date</b></label>
                                                    <input type="date" class="form-control" id="exampleFormControlTextarea1" required v-model="date">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </form>
                                    <!-- Form End -->
                                    <hr>
                                    <div class="text-center">

                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <!-- Simple Tables -->
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                        <th>Vat</th>
                                        <th>Total</th>
                                        <th>Pay</th>
                                        <th>Due</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="order in orders">
                                        <td>{{order.name}}</td>
                                        <td>{{order.qty}}</td>
                                        <td>{{order.sub_total}} <b>Tk</b></td>
                                        <td>{{order.vat}} %</td>
                                        <td>{{order.total}} <b>Tk</b></td>
                                        <td>{{order.pay}} <b>Tk</b></td>
                                        <td>{{order.due}} <b>Tk</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "search",
        created(){
            if (!User.loggedIn()){
                this.$router.push({name: '/'})
            }
        },
        data(){
            return {
                date: '',
                orders: {}
            }
        },
        methods: {
            searchDate(){
                let data = {date: this.date}
                axios.post('/api/search/order/', data)
                    .then(({data}) => (this.orders = data))
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>