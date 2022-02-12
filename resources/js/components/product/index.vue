<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <router-link to="/store-product" class="btn btn-primary">Add Product</router-link>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </div>
        <!--<div class="row">-->
            <!--<div class="col-md-2">-->
                <!--<router-link to="/store-product" class="btn btn-primary">Add Product</router-link>-->
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
                        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Image</th>
                                <th>Product Category</th>
                                <th>Product Supplier</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Root</th>
                                <th width="130px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in filterSearch" :key="product.id">
                                <td>{{ product.product_name }}</td>
                                <td>{{ product.product_code }}</td>
                                <td><img :src="product.image" alt="" id="pr_photo"></td>
                                <td>{{ product.category_name }}</td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.buying_price }} <b>Tk</b></td>
                                <td>{{ product.selling_price }} <b>Tk</b></td>
                                <td>{{ product.root }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-product', params:{id: product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                    <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger"><font color="#fff">Delete</font></a>
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
                products: [],
                searchTerm: '',
            }
        },
        computed : {
            filterSearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            }
        },
        methods: {
            allProduct(){
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()
            },
            deleteProduct(id){
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
                        axios.delete('/api/product/'+id)
                            .then(() => {
                                this.products = this.products.filter(product => {
                                    return product.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'product'})
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
            this.allProduct()
        }
    }
</script>

<style scoped>
#pr_photo{
    height: 60px;
    width: 60px;
    border-radius: 50%;
    border: 2px solid #6777ef;
}
</style>