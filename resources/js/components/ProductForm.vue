<template>
  <form @submit.prevent="addProduct" class="mb-3">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Product Name" v-model="product.name"
        
      >
    </div>
    <!-- @TODO implement category dropdown -->
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Category" v-model="product.category">
    </div>
    <div class="form-group">
      <textarea class="form-control" placeholder="Description" v-model="product.description">
      </textarea>
    </div>
    <div class="form-group">
      <div class='input-group'>
          <input id='datetimepicker' type='text' class="form-control date time" v-model="product.datetime">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <div class="input-group-addon hidden">
          </div>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-outline-success btn-flat float-right">Submit</button>
    </div>
  </form>
</template>

<script>

let p=window.product;

export default {
  data(){
    return {
      product: {
        id: p.pid,
        name: p.name,
        description: p.description,
        category: p.category,
        datetime: p.datetime,
      },
      product_id: '',
      pagination: {},
      edit: false
    }
  },
  methods: {
    addProduct(){
      if(this.edit === false){
        // Add
        fetch('/api/product', {
          method: 'post',
          headers: { 
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer 5|kRzviKkNqcxrBCEaoVEh2I60NzFbpsSKa5EMg4hr",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify(this.product)
        })
        .then(res => {
          console.log(res.text());
          return res.json();
        })
        .then(data => {
          // @TODO redirect
          alert('Product Created');
        })
        .catch(error => console.log(error));
      } else {
        // Edit
      }
    }
  },
  created() {
  },
}
</script>