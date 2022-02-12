<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">POS</li>
                </ol>
            </div>

            <div class="row mb-3">
                <!-- Area Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Add Customers</h6>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Add Customer
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="user" @submit.prevent="customerInsert" enctype="multipart/form-data">
                                        <div class="modal-body">

                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label for="exampleFormControlTextarea1"><b>Customer Name</b></label>
                                                            <input type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Your Name" v-model="form.name">
                                                            <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="exampleFormControlTextarea1"><b>Customer Email</b></label>
                                                            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                                                   placeholder="Enter Your Email Address" v-model="form.email">
                                                            <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label for="exampleFormControlTextarea1"><b>Customer Address</b></label>
                                                            <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Address" v-model="form.address">
                                                            <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="exampleFormControlTextarea1"><b>Customer Phone</b></label>
                                                            <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Phone Number" v-model="form.phone">
                                                            <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                            <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img :src="form.photo" alt="" style="height: 40px; width: 40px">
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--<div class="form-group">-->
                                                    <!--<button type="submit" class="btn btn-primary btn-block">Submit</button>-->
                                                <!--</div>-->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                                <div class="table-responsive" style="font-size: 12px;">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th width="143px">Name</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="cart in carts" :key="cart.id">
                                            <td>{{cart.pro_name}}</td>
                                            <td><input type="text" readonly style="width: 30px" :value="cart.pro_quantity">
                                            <button @click.prevent="increment(cart.id)"  class="btn btn-sm btn-success" style="padding: 5px;">+</button>
                                            <button @click.prevent="decrement(cart.id)"  class="btn btn-sm btn-danger" v-if="cart.pro_quantity >= 2" style="padding: 5px;">-</button>
                                                <button class="btn btn-sm btn-danger" v-else="" disabled style="padding: 5px;">-</button>
                                            </td>
                                            <td>{{cart.pro_price}}</td>
                                            <td>{{cart.sub_total}}</td>
                                            <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary"><font color="#fff">X</font></a></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Total Quantity:
                                            <strong>{{qty}}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Sub Total:
                                            <strong>{{subtotal}} Tk</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Vat:
                                            <strong>{{vats.vat}} %</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Total Amount:
                                            <strong>{{subtotal * vats.vat /100 + subtotal}} Tk</strong>
                                        </li>
                                    </ul>
                                    <br>
                                    <form action="" @submit.prevent="orderDone">
                                        <label for="">Customer Name</label>
                                        <select name="" id="" class="form-control" v-model="customer_id">
                                            <option :value="customer.id" v-for="customer in customers">{{customer.name}}</option>
                                        </select>

                                        <label for="">Pay</label>
                                        <input type="text" class="form-control" required v-model="pay">

                                        <label for="">Due</label>
                                        <input type="text" class="form-control" required v-model="due">

                                        <label for="">Pay By</label>
                                        <select name="" id="" class="form-control" v-model="payby">
                                            <option value="HandCash">Hand Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="GiftCard">Gift Card</option>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>

                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                        </div>
                        <!-- Category wise product -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    All Product
                                </button>
                            </li>
                            <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)">
                                    {{category.category_name}}
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <input type="text" v-model="searchTerm" class="form-control" style="width: 550px;" placeholder="Search Product"><br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)" v-if="product.product_quantity >= 1">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 8px; margin-left: -8px;">
                                                    <img :src="product.image" alt="" id="pr_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span class="badge badge-success" v-if="product.product_quantity >= 1">Available {{product.product_quantity}}</span>
                                                        <span class="badge badge-danger" v-else="">Out of Stock</span>

                                                    </div>
                                                </div>
                                            </button>
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)" v-else="" disabled>
                                                <div class="card" style="width: 8.5rem; margin-bottom: 8px; margin-left: -8px;">
                                                    <img :src="product.image" alt="" id="pr_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span class="badge badge-success" v-if="product.product_quantity >= 1">Available {{product.product_quantity}}</span>
                                                        <span class="badge badge-danger" v-else="">Out of Stock</span>

                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                                <input type="text" v-model="getsearchTerm" class="form-control" style="width: 550px;  margin-left: 18px;" placeholder="Search Product"><br>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfilterSearch" :key="getproduct.id">
                                        <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)" v-if="getproduct.product_quantity >= 1">
                                            <div class="card" style="width: 8.5rem; margin-bottom: 8px; margin-left: 18px;">
                                                <img :src="getproduct.image" alt="" id="pr_photo" class="card-img-top">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ getproduct.product_name }}</h6>
                                                    <span class="badge badge-success" v-if="getproduct.product_quantity >= 1">Available {{getproduct.product_quantity}}</span>
                                                    <span class="badge badge-danger" v-else="">Out of Stock</span>

                                                </div>
                                            </div>
                                        </button>
                                        <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)" v-else="" disabled>
                                            <div class="card" style="width: 8.5rem; margin-bottom: 8px; margin-left: 18px;">
                                                <img :src="getproduct.image" alt="" id="pr_photo" class="card-img-top">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ getproduct.product_name }}</h6>
                                                    <span class="badge badge-success" v-if="getproduct.product_quantity >= 1">Available {{getproduct.product_quantity}}</span>
                                                    <span class="badge badge-danger" v-else="">Out of Stock</span>

                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Category wise product -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Notification from "../../helpers/Notification";

    export default {
        name: "pointofsale",
        created(){
            if (!User.loggedIn()){
                this.$router.push({name: '/'})
            }
        },
        created(){
            this.allProduct()
            this.allCategory()
            this.allCustomer()
            this.CartProduct()
            this.vat()
            Reload.$on('AfterAdd', () => {
                this.CartProduct()
            })
        },
        data(){
            return {
                form: {
                    name: null,
                    email: null,
                    phone: null,
                    address: null,
                    photo: null
                },
                customer_id: '',
                pay: '',
                due: '',
                payby: '',
                products: [],
                categories: '',
                getproducts: [],
                searchTerm: '',
                getsearchTerm: '',
                customers: '',
                carts: [],
                vats: '',
                errors: {}
            }
        },
        computed : {
            filterSearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            },
            getfilterSearch(){
                return this.getproducts.filter(getproduct => {
                    return getproduct.product_name.match(this.getsearchTerm)
                })
            },
            qty(){
                let sum = 0
                for (let i = 0; i < this.carts.length; i++){
                    sum += (parseFloat(this.carts[i].pro_quantity))
                }
                return sum
            },
            subtotal(){
                let sum = 0
                for (let i = 0; i < this.carts.length; i++){
                    sum += (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].pro_price))
                }
                return sum
            }
        },
        methods: {
            onFileSelected(event){
                // console.log(event)
                let file = event.target.files[0]
                if (file.size > 1048770){
                    Notification.image_validation()
                } else {
                    let reader = new FileReader()
                    reader.onload = event =>{
                        this.form.photo = event.target.result
                        console.log(event.target.result)
                    }
                    reader.readAsDataURL(file)
                }
            },
            customerInsert(){
                axios.post('/api/customer/', this.form)
                    .then(() => {
                        $('#exampleModalCenter').modal('hide');
                        this.customerInsert()
                        Notification.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
            AddToCart(id){
                axios.get('/api/addToCart/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd')
                        Notification.cart_success()
                    })
                    .catch()
            },
            CartProduct(){
                axios.get('/api/cart/product/')
                    .then(({data}) => (this.carts = data))
                    .catch()
            },
            removeItem(id){
                axios.get('/api/remove/cart/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd')
                        Notification.cart_delete()
                    })
                    .catch()
            },
            increment(id){
                axios.get('/api/increment/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd')
                        Notification.success()
                    })
                    .catch()
            },
            decrement(id){
                axios.get('/api/decrement/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd')
                        Notification.success()
                    })
                    .catch()
            },
            vat(){
                axios.get('/api/vats/')
                    .then(({data}) => (this.vats = data))
                    .catch()
            },
            orderDone(){
                let total = this.subtotal * this.vats.vat /100 + this.subtotal
                let data = {
                    qty: this.qty,
                    subtotal: this.subtotal,
                    customer_id: this.customer_id,
                    payby: this.payby,
                    pay: this.pay,
                    due: this.due,
                    vat: this.vats.vat,
                    total: total
                }

                axios.post('/api/orderdone/', data)
                    .then(() => {
                        Notification.success()
                        this.$router.push({name: 'home'})
                    })
            },

            allProduct(){
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()
            },
            allCategory(){
                axios.get('/api/category/')
                    .then(({data}) => (this.categories = data))
                    .catch()
            },
            allCustomer(){
                axios.get('/api/customer/')
                    .then(({data}) => (this.customers = data))
                    .catch()
            },
            subProduct(id){
                axios.get('/api/getting/product/' + id)
                    .then(({data}) => (this.getproducts = data))
                    .catch()
            }
        }
    }
</script>

<style scoped>
    #pr_photo{
        height: 105px;
        width: 135px;
        border: 1px solid #6777ef;
        /*border-radius: 50%;*/
    }
</style>