import Vue from 'vue'
import axios from 'axios'
import VueSweetalert2 from 'vue-sweetalert2';

Vue.filter('currency', function (money) {
  return accounting.formatMoney(money, "Rp ", 2, ".", ",")
})

Vue.use(VueSweetalert2);

new Vue({
  el: '#od',
  data:{
    product:{
      id: '',
      name: '',
      qty: '',
      price: '',
      description: ''
    },
    cart: {
      product_id: '',
      qty: 1
    },
    customer:{
      name:'',
      address: '',
      phone: ''
    },
    shoppingCart: [],
    submitCart: false,
    submitForm: false,
    errorMessage: '',
    message: ''
  },
  watch: {
    'cart.product_id': function(){
      if(this.cart.product_id){
        this.getProduct()
      }
    }
  },
  mounted() {
    $('#product_id').select2({
      width: '100%'
    }).on('change',() => {
      this.cart.product_id = $('#product_id').val();
    });

    this.getCart()
  },
  methods: {

    getProduct(){
      axios.get(`/api/product/${this.cart.product_id}`)
        .then((response) =>{
          this.product = response.data
        })
    },

    addToCart() {
      this.submitCart = true;
      
      axios.post('/api/cart', this.cart)
      .then((response) => {
          setTimeout(() => {

              this.shoppingCart = response.data
              
              this.cart.product_id = ''
              this.cart.qty = 1
              this.product = {
                  id: '',
                  price: '',
                  name: '',
                  description:''
              }
              $('#product_id').val('')
              this.submitCart = false
          }, 2000)
      })
      .catch((error) => {

      })
    },

    getCart() {
      axios.get('/api/cart')
      .then((response) => {
          this.shoppingCart = response.data
      })
    },
    
    removeCart(id) {
      this.$swal({
          title: 'Are you sure?',
          text: 'You can\'t revert your action',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes Delete it!',
          cancelButtonText: 'No, Keep it!',
          showCloseButton: true,
          showLoaderOnConfirm: true,
          preConfirm: () => {
              return new Promise((resolve) => {
                  setTimeout(() => {
                      resolve()
                  }, 2000)
              })
          },
          allowOutsideClick: () => !this.$swal.isLoading()
          }).then ((result) => {
                if (result.value) {
                  axios.delete(`/api/cart/${id}`)
                  .then ((response) => {
                        this.getCart();
                  })
                  .catch ((error) => {
                        console.log(error);
                  })
              }
            })
    },

    sendOrder() {
      this.errorMessage = ''
      this.message = ''
      if (this.customer.name != '' && this.customer.phone != '' && this.customer.address != '') {
          this.$swal({
              title: 'Are you sure?',
              text: 'You have finished shopping',
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes Finish it!',
              cancelButtonText: 'No, Keep it!',
              showCloseButton: true,
              showLoaderOnConfirm: true,
              preConfirm: () => {
                  return new Promise((resolve) => {
                      setTimeout(() => {
                          resolve()
                      }, 2000)
                  })
              },
              allowOutsideClick: () => !this.$swal.isLoading()
          }).then ((result) => {
              if (result.value) {
                  this.submitForm = true
                  axios.post('/checkout', this.customer)
                  .then((response) => {
                      // console.log(response.data.status);
                      setTimeout(() => {
                          this.getCart();
                          this.message = response.data.message
                          this.status = response.data.status
                          this.customer = {
                              name: '',
                              phone: '',
                              address: ''
                          }
                          this.submitForm = false
                          this.$swal(response.data.status,this.message,this.status == 'success'?'success':'error')
                      }, 1000)
                  })
                  .catch((error) => {
                      console.log(error)
                  })
              }
          })
      } else {
          this.errorMessage = 'Masih ada inputan yang kosong!'
      }
    }
  }
})